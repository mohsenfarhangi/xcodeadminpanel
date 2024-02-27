<?php

namespace App\Http\Core\Adapters;


use App\Http\Core\Theme\Menu;
use App\Http\Core\Theme\Util;

/**
 * Adapter class to make the Metronic core lib compatible with the Laravel functions
 *
 * Class Util
 *
 * @package App\Core\Adapters
 */
class Bootstrap extends \App\Http\Core\Theme\Bootstrap
{
    protected static $quickmenu;

    public static function run()
    {
        parent::run();

        if (isRTL()) {
            // RTL html attributes
            Theme::addHtmlAttribute('html', 'dir', 'rtl');
            Theme::addHtmlAttribute('html', 'direction', 'rtl');
            Theme::addHtmlAttribute('html', 'style', 'direction:rtl;');
        }
        self::initAsideMenu();
        self::initQuickMenu();
    }

    protected static function initAsideMenu()
    {
        self::$menu = new MainMenu(Theme::getOption('menu', 'main'), Theme::getPagePath());

        if (Theme::getOption('layout', 'aside/menu-icons-display') === false) {
            self::$menu->displayIcons(false);
        }

        self::$menu->setIconType(Theme::getOption('layout', 'aside/menu-icon'));
    }

    protected static function initQuickMenu()
    {
        self::$quickmenu = new Menu(Theme::getOption('menu', 'quick'), Theme::getPagePath());

        if (Theme::getOption('layout', 'aside/menu-icons-display') === false) {
            self::$quickmenu->displayIcons(false);
        }

        self::$quickmenu->setIconType(Theme::getOption('layout', 'aside/menu-icon'));
    }

    public static function getQuickMenu()
    {
        return self::$quickmenu;
    }

    public static function getBreadcrumb()
    {
        $options = array(
            'skip-active' => false
        );

        return self::getAsideMenu()->getBreadcrumb($options);
    }
}
