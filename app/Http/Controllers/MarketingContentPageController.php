<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MarketingContentPageController extends Controller
{
    public function show(Request $request): View
    {
        $group = (string) $request->route('contentGroup');
        $slug = (string) $request->route('contentSlug');
        $page = config("site_content_pages.{$group}.{$slug}");
        $depth = config("site_content_depth.{$group}.{$slug}");

        abort_unless(is_array($page) && is_array($depth), 404);

        $page['depth'] = $depth;

        return view('marketing.content-page', [
            'group' => $group,
            'slug' => $slug,
            'page' => $page,
            'title' => $page['title'],
            'description' => $page['description'],
            'canonical' => route($page['route']),
            'image' => asset('assets/images/marketing/'.$page['image']),
            'imageAlt' => $page['image_alt'],
            'imageWidth' => $page['image_width'] ?? 1536,
            'imageHeight' => $page['image_height'] ?? 1024,
        ]);
    }
}
