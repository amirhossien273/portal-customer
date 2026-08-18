<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MarketingComparisonController extends Controller
{
    public function index(): View
    {
        return view('marketing.compare-index', [
            'comparisons' => config('site_comparisons.pages'),
        ]);
    }

    public function competitor(string $competitor): View
    {
        $comparison = config("site_comparisons.competitors.{$competitor}");

        abort_unless(is_array($comparison), 404);

        return view('marketing.compare-competitor', [
            'comparison' => $comparison,
            'comparisons' => config('site_comparisons.pages'),
        ]);
    }

    public function best(): View
    {
        return view('marketing.best-transport-software', [
            'comparisons' => config('site_comparisons.pages'),
        ]);
    }
}
