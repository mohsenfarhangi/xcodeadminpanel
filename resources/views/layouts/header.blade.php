<!--Header-->
<div class="main-header">
    <div class="top-header">
        <div class="logo-wrp">
            <img src="{{\Illuminate\Support\Facades\Vite::asset('resources/media/img/logo.jpg')}}" alt="">
        </div>
        <div class="left-side">
            <div class="action-wrp clearfix">
                <ul class="action-nav">
                    <li>
                        <a href="#">
                            تغییر کلمه عبور
                        </a>
                    </li>
                    <li>
                        <a href="{{route('logout')}}">
                            خروج
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-100" style="float: left;"></div>
            <div class="additional-wrp clearfix">
                <div class="profile">
                    کاربر:
                    <a href="#">
                        {{auth()->user()->username}}
                    </a>
                </div>
                <div class="current-time">
                    {{jalaliWithFormat('%A, %d %B %Y')}}
                </div>
            </div>
        </div>
    </div>
    <div class="navigation-container">
        @include("layouts.navigation")
    </div>
</div>
