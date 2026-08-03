<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingTransportModeController extends Controller
{
    public function show(string $mode): View
    {
        $modes = config('site_transport_modes', []);

        abort_unless(isset($modes[$mode]), 404);

        return view('marketing.transport-mode-detail', [
            'slug' => $mode,
            'mode' => $modes[$mode],
            'relatedModes' => collect($modes)->except($mode)->take(3),
            'title' => $modes[$mode]['seo_title'],
            'description' => $modes[$mode]['meta_description'],
        ]);
    }
}
