<?php

namespace App\View\Components;

use App\Http\Core\Adapters\Theme;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        Theme::addHtmlAttribute('html','direction','rtl');
        Theme::addHtmlAttribute('html','dir','rtl');
        Theme::addHtmlAttribute('html','style','direction:rtl');
        Theme::addHtmlClass('body','header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled');

        return view(config('theme.general.KT_THEME_LAYOUT_DIR').'._front-layout');
    }
}
