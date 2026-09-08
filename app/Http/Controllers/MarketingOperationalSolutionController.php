<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingOperationalSolutionController extends Controller
{
    public function show(string $solution): View
    {
        $page = config('site_operational_landing_pages.'.$solution);

        abort_unless(is_array($page), 404);

        return view('marketing.operational-solutions.show', [
            'slug' => $solution,
            'page' => $page,
            'title' => $page['title'],
            'description' => $page['description'],
            'canonical' => route($page['route']),
            'image' => asset('assets/images/marketing/'.$page['image']),
            'imageAlt' => $page['image_alt'],
            'imageWidth' => $page['image_width'],
            'imageHeight' => $page['image_height'],
        ]);
    }
}
