<?php

namespace App\View\Components;

use App\Http\Core\Adapters\Theme;
use Illuminate\View\Component;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render()
    {
        Theme::addHtmlAttribute('body', 'class', 'auth-bg bgi-size-cover bgi-position-center bgi-no-repeat');

        return view(config('theme.general.KT_THEME_LAYOUT_DIR').'._auth');
    }
}
