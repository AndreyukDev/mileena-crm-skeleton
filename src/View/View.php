<?php

namespace Mileena\CrmSkeleton\View;

use Mileena\Web\WebApp;

class View extends \Mileena\Web\View
{
    public static function getView(): View
    {
        if (!self::$view) {
            self::$view = new self(
                WebApp::getInstance()->config->get('app.view_dir').'templates/'
            );
        }

        return self::$view;
    }
}
