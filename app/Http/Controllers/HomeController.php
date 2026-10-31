<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HowItWorksStep;
use App\Models\NewsletterSubscriber;
use App\Models\Partner;
use App\Models\Quotation;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Switch application language between EN and ID.
     */
    public function changeLocale(string $locale): RedirectResponse
    {
        if (in_array($locale, ['en', 'id'], true)) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }

    /**
     * Show the homepage with all curated data.
     */
    public function index(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->orderBy('sort_order')->take(4)->get();
        $steps = HowItWorksStep::orderBy('sort_order')->take(4)->get();
        $services = Service::active()->orderBy('sort_order')->take(4)->get();
        $partners = Partner::active()->featured()->orderBy('sort_order')->take(2)->get();

        return view('home', compact('settings', 'categories', 'steps', 'services', 'partners'));
    }

    /**
     * Show the dedicated About Us page.
     */
    public function about(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->orderBy('sort_order')->take(4)->get();
        $services = Service::active()->orderBy('sort_order')->get();

        return view('about', compact('settings', 'categories', 'services'));
    }

    /**
     * Show the dedicated Categories list page.
     */
    public function categories(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()
            ->rootOnly()
            ->with([
                'children' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
                'products' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
            ])
            ->orderBy('sort_order')
            ->get();

        return view('categories.index', compact('settings', 'categories'));
    }

    /**
     * Show a specific category detail with its products.
     */
    public function showCategory(string $slug): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->rootOnly()->orderBy('sort_order')->get();
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->with([
                'parent',
                'children' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order'),
            ])
            ->firstOrFail();

        $catIds = collect([$category->id])->merge($category->children->pluck('id'))->unique();
        $products = \App\Models\Product::whereIn('category_id', $catIds)->where('is_active', true)->orderBy('sort_order')->get();
        $otherCategories = Category::where('id', '!=', $category->id)->where('is_active', true)->rootOnly()->take(3)->get();

        return view('categories.show', compact('settings', 'categories', 'category', 'products', 'otherCategories'));
    }

    /**
     * Show the dedicated Where to Stay and Where to Eat page.
     */
    public function stayEat(Request $request): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->orderBy('sort_order')->take(4)->get();

        $type = $request->query('type');
        $area = $request->query('area');

        $query = Partner::active()->orderBy('sort_order');
        if (in_array($type, ['stay', 'eat'], true)) {
            $query->where('type', $type);
        }
        if (!empty($area)) {
            $query->where('area', 'like', "%{$area}%");
        }

        $partners = $query->get();
        $stays = Partner::active()->stay()->orderBy('sort_order')->get();
        $eats = Partner::active()->eat()->orderBy('sort_order')->get();

        return view('stay-eat.index', compact('settings', 'categories', 'partners', 'stays', 'eats', 'type', 'area'));
    }

    /**
     * Show the dedicated Contact page.
     */
    public function contact(): View
    {
        $settings = Setting::all()->pluck('value', 'key');
        $categories = Category::active()->orderBy('sort_order')->get();

        return view('contact', compact('settings', 'categories'));
    }

    /**
     * Handle RFQ (Quotation) form submission.
     */
    public function submitRfq(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'company' => ['nullable', 'string', 'max:255'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:100'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'quantity' => ['nullable', 'string', 'max:100'],
            'target_date' => ['nullable', 'date'],
            'description' => ['required', 'string', 'max:3000'],
        ]);

        $validated['ip_address'] = $request->ip();
        $validated['status'] = Quotation::STATUS_NEW;

        $quotation = Quotation::create($validated);

        return redirect()->to(url()->previous() . '#rfq-success')
            ->with('rfq_success', "Thank you, {$quotation->name}. Your RFQ reference is {$quotation->reference_no}. Our sourcing team will respond within 48 hours.");
    }

    /**
     * Handle Newsletter subscription.
     */
    public function subscribeNewsletter(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        NewsletterSubscriber::firstOrCreate(
            ['email' => strtolower(trim($validated['email']))],
            ['is_active' => true]
        );

        return redirect()->to(url()->previous() . '#newsletter')
            ->with('newsletter_success', 'Thank you for subscribing to Bali Easy Sourcing updates.');
    }
}

