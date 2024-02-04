<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div class="auth-box card border-3 rounded shadow">
        <div class="card-header">
            <div class="auth-title py-3 text-light">
                ورود به نرم افزار مدیریت دندانپزشکی لبخند
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="row mb-3">
                    <x-input-label for="username" :value="__('auth.Username')" class="col-md-3 col-form-label text-light p-0"/>
                    <div class="col-md-9">
                        <x-text-input id="username" type="username" name="username" :value="old('username')" required
                                      autofocus
                                      autocomplete="username"/>
                    </div>
                    <x-input-error :messages="$errors->get('username')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="row mb-3">
                    <x-input-label for="password" :value="__('auth.Password')" class="col-md-3 col-form-label text-light"/>
                    <div class="col-md-9">
                        <x-text-input id="password" class="block mt-1 w-full"
                                      type="password"
                                      name="password"
                                      required autocomplete="current-password"/>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <x-primary-button class="ml-3">
                            {{ __('auth.Log in') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>

    </div>

</x-guest-layout>
