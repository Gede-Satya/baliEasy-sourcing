<?php

namespace Database\Seeders;

use App\Models\PageView;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorAnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        if (PageView::count() > 0) {
            return;
        }

        $pages = [
            '/' => 'Beranda (Home)',
            '/about' => 'Tentang Kami (About Us)',
            '/categories' => 'Katalog Kategori',
            '/categories/solid-wood' => 'Kategori: Solid Wood',
            '/categories/natural-rattan' => 'Kategori: Natural Rattan',
            '/where-to-stay-and-eat' => 'Where to Stay & Eat',
            '/contact' => 'Hubungi Kami (Contact)',
        ];

        $devices = ['Desktop', 'Desktop', 'Mobile', 'Mobile', 'Mobile', 'Tablet'];
        $browsers = ['Chrome', 'Chrome', 'Safari', 'Safari', 'Microsoft Edge', 'Firefox'];
        $platforms = ['Windows', 'macOS', 'iOS', 'Android', 'Windows'];
        $referers = [null, null, 'google.com', 'instagram.com', 'facebook.com', 'pinterest.com', 'linkedin.com'];

        $records = [];
        $now = Carbon::now();

        // Generate data for past 14 days
        for ($daysAgo = 14; $daysAgo >= 0; $daysAgo--) {
            $date = $now->copy()->subDays($daysAgo);
            // More traffic recently
            $dailyCount = rand(15, 45) + (14 - $daysAgo) * 2;

            for ($i = 0; $i < $dailyCount; $i++) {
                $path = array_rand($pages);
                $pageTitle = $pages[$path];
                $time = $date->copy()->setTime(rand(7, 23), rand(0, 59), rand(0, 59));
                $visitorIp = '192.168.' . rand(1, 20) . '.' . rand(1, 100);

                $records[] = [
                    'session_id' => md5($visitorIp . $date->format('Y-m-d')),
                    'ip_hash' => hash('sha256', $visitorIp),
                    'path' => $path,
                    'url' => url($path),
                    'page_title' => $pageTitle,
                    'referer' => $referers[array_rand($referers)],
                    'device' => $devices[array_rand($devices)],
                    'browser' => $browsers[array_rand($browsers)],
                    'platform' => $platforms[array_rand($platforms)],
                    'locale' => rand(0, 1) ? 'en' : 'id',
                    'created_at' => $time,
                ];
            }
        }

        foreach (array_chunk($records, 100) as $chunk) {
            PageView::insert($chunk);
        }
    }
}
