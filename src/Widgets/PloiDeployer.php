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
    public function component()
        {
            $config = PloiConfig::all();

            return VueComponent::render('ploi-deployer-component', [
                'title' => 'Deploy to Production',
                'hasConfig' => !empty($config['api_key']),
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
