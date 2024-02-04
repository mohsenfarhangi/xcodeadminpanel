<nav class="main-nav">
    <ul>
        <li>
            <x-nav-link :href="route('dentist.create')" :active="request()->routeIs('dentist.create')">
                ایجاد دندانپزشک
            </x-nav-link>
        </li>
        <li>
            <x-nav-link href="#">
                تشکیل پرونده
            </x-nav-link>
        </li>
        <li>
            <x-nav-link href="#">
                پرونده بیمار
            </x-nav-link>
        </li>
        <li>
            <x-nav-link href="#">
                پرونده دندانپزشکی
            </x-nav-link>
        </li>
    </ul>
</nav>
