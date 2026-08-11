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
        $page = config('site_module_pages.'.$module);

        abort_if($module !== 'crm' && ! is_array($page), 404);

        return view($view, [
            'slug' => $module,
            'module' => $modules[$module],
            'relatedModules' => collect($modules)->except($module)->take(3),
            'title' => $modules[$module]['seo_title'],
            'description' => $modules[$module]['meta_description'],
            'canonical' => route('site.modules.show', ['module' => $module]),
            'image' => asset('assets/images/marketing/modules/'.$module.'-hero.webp'),
            'imageAlt' => 'نمای ماژول '.$modules[$module]['name'].' نرم‌افزار سپند',
            'imageWidth' => 1536,
            'imageHeight' => 1024,
            'page' => $page,
        ]);
    }
}
