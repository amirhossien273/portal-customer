<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingCaseStudyController extends Controller
{
    public function show(string $caseStudy): View
    {
        $page = config('site_case_studies.'.$caseStudy);

        abort_unless(is_array($page), 404);

        return view('marketing.case-studies.show', [
            'page' => $page,
            'title' => $page['title'],
            'description' => $page['description'],
            'canonical' => route('case-studies.show', ['caseStudy' => $caseStudy]),
            'image' => asset('assets/images/marketing/'.$page['image']),
            'imageAlt' => $page['image_alt'],
            'imageWidth' => $page['image_width'],
            'imageHeight' => $page['image_height'],
        ]);
    }
}
