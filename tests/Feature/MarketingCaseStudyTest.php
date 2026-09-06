<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class MarketingCaseStudyTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['app.url' => 'https://sepandcrm.ir', 'marketing.site_url' => 'https://sepandcrm.ir']);
        URL::forceRootUrl('https://sepandcrm.ir');
        URL::forceScheme('https');
    }

    public function test_real_snapshot_case_study_is_transparent_and_indexable(): void
    {
        $path = '/customers/case-studies/operational-control-snapshot';

        $this->get($path)
            ->assertOk()
            ->assertSee('از داده پراکنده تا صف اقدام؛ یک تصویر واقعی از عملیات سپند', false)
            ->assertSee('۶۹۹', false)
            ->assertSee('Snapshot مقطعی است', false)
            ->assertSee('live/operations-dashboard.png', false)
            ->assertSee('"@type":"Article"', false)
            ->assertSee('<link rel="canonical" href="https://sepandcrm.ir'.$path.'">', false);

        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();
        $this->assertSame(1, substr_count($sitemap, '<loc>https://sepandcrm.ir'.$path.'</loc>'));
    }
}
