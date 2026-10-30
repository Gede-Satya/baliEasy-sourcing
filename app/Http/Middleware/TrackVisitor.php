<?php

namespace App\Http\Middleware;

use App\Models\PageView;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request and record visitor analytics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET responses for HTML pages
        if (! $request->isMethod('GET')) {
            return $response;
        }

        // Only 2xx responses
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            return $response;
        }

        $path = trim($request->path(), '/');

        // Ignore admin, livewire, storage, health checks, or static files
        if (
            str_starts_with($path, 'admin') ||
            str_starts_with($path, 'livewire') ||
            str_starts_with($path, 'storage') ||
            $path === 'up' ||
            preg_match('/\.(ico|css|js|png|jpg|jpeg|svg|webp|gif|woff|woff2|ttf|map|json)$/i', $path)
        ) {
            return $response;
        }

        try {
            $this->recordVisit($request, $path);
        } catch (\Throwable $e) {
            // Silently catch so tracking never breaks user experience
            report($e);
        }

        return $response;
    }

    protected function recordVisit(Request $request, string $path): void
    {
        $ip = $request->ip() ?? '127.0.0.1';
        $ipHash = hash('sha256', $ip . config('app.key', 'balieasy'));
        $sessionId = session()->getId();

        // Prevent rapid refresh spamming (skip if visited exact same path within 15 seconds)
        $recentVisit = PageView::where('ip_hash', $ipHash)
            ->where('path', '/' . $path)
            ->where('created_at', '>=', Carbon::now()->subSeconds(15))
            ->exists();

        if ($recentVisit) {
            return;
        }

        $userAgent = $request->userAgent() ?? '';
        $device = $this->detectDevice($userAgent);
        $browser = $this->detectBrowser($userAgent);
        $platform = $this->detectPlatform($userAgent);

        $referer = $request->headers->get('referer');
        $cleanReferer = null;
        if ($referer) {
            $host = parse_url($referer, PHP_URL_HOST);
            $appHost = parse_url(config('app.url'), PHP_URL_HOST);
            if ($host && $host !== $appHost && $host !== 'localhost' && $host !== '127.0.0.1') {
                $cleanReferer = $host;
            }
        }

        $pageTitle = $this->resolvePageTitle('/' . $path);

        PageView::create([
            'session_id' => $sessionId,
            'ip_hash' => $ipHash,
            'path' => '/' . $path,
            'url' => $request->fullUrl(),
            'page_title' => $pageTitle,
            'referer' => $cleanReferer,
            'device' => $device,
            'browser' => $browser,
            'platform' => $platform,
            'locale' => app()->getLocale(),
            'created_at' => Carbon::now(),
        ]);
    }

    protected function detectDevice(string $ua): string
    {
        if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) {
            return 'Tablet';
        }

        if (preg_match('/(mobi|iphone|ipod|blackberry|opera mini|iemobile|mobile)/i', $ua)) {
            return 'Mobile';
        }

        return 'Desktop';
    }

    protected function detectBrowser(string $ua): string
    {
        if (preg_match('/Edg/i', $ua)) {
            return 'Microsoft Edge';
        }
        if (preg_match('/Chrome/i', $ua) && ! preg_match('/OPR/i', $ua)) {
            return 'Chrome';
        }
        if (preg_match('/Safari/i', $ua) && ! preg_match('/Chrome/i', $ua)) {
            return 'Safari';
        }
        if (preg_match('/Firefox/i', $ua)) {
            return 'Firefox';
        }
        if (preg_match('/OPR|Opera/i', $ua)) {
            return 'Opera';
        }

        return 'Other';
    }

    protected function detectPlatform(string $ua): string
    {
        if (preg_match('/windows|win32/i', $ua)) {
            return 'Windows';
        }
        if (preg_match('/macintosh|mac os x/i', $ua)) {
            return 'macOS';
        }
        if (preg_match('/iphone|ipad|ipod/i', $ua)) {
            return 'iOS';
        }
        if (preg_match('/android/i', $ua)) {
            return 'Android';
        }
        if (preg_match('/linux/i', $ua)) {
            return 'Linux';
        }

        return 'Other';
    }

    protected function resolvePageTitle(string $path): string
    {
        if ($path === '/' || $path === '') {
            return 'Beranda (Home)';
        }
        if ($path === '/about') {
            return 'Tentang Kami (About Us)';
        }
        if ($path === '/categories') {
            return 'Katalog Kategori';
        }
        if (str_starts_with($path, '/categories/')) {
            $slug = substr($path, strlen('/categories/'));
            return 'Kategori: ' . ucwords(str_replace('-', ' ', $slug));
        }
        if ($path === '/where-to-stay-and-eat') {
            return 'Where to Stay & Eat';
        }
        if ($path === '/contact') {
            return 'Hubungi Kami (Contact)';
        }

        return ucwords(trim($path, '/'));
    }
}

