<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class MarketingModuleController extends Controller
{
    public function show(string $module): View
    {
        $modules = config('site_modules', []);

        abort_unless(isset($modules[$module]), 404);

        $view = $module === 'crm'
            ? 'marketing.module-crm'
            : 'marketing.module-detail';

        return view($view, [
            'slug' => $module,
            'module' => $modules[$module],
            'relatedModules' => collect($modules)->except($module)->take(3),
            'title' => $modules[$module]['seo_title'],
            'description' => $modules[$module]['meta_description'],
        ]);
    }
}
