<?php

namespace Savelend\PloiDeployer\Widgets;

use Statamic\Widgets\Widget;
use Savelend\PloiDeployer\Facades\PloiConfig;

class PloiDeployer extends Widget
{

    protected static $handle = 'ploi_deployer';

    /**
     * The HTML that should be shown in the widget
     *
     * @return string|\Illuminate\View\View
     */
    public function html()
    {
        $config = PloiConfig::all();

        return view('savelend.ploi-deployer::widgets.ploi-deployer', [
            'title' => 'Deploy to Production',
            'hasConfig' => isset($config['api_key']) && !empty($config['api_key']),
        ]);
    }

    /**
     * The widget's title
     */
    static function title()
    {
        return 'Ploi Deployer';
    }

    /**
     * The widget's description
     */
    static function description()
    {
        return 'Deploy your site to production with Ploi';
    }
}
