<x-pauth::guest-layout>
    <!-- Session Status -->
    <x-twcompo::auth-session-status class="mb-4" :status="session('status')"/>

    <!--    <bs-test title="asdasdasd"> 1111</bs-test>-->
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <x-twcompo::input-label for="phone" value="Телефон"/>
        <x-twcompo::phone-input id="phone" class="block mt-1 w-full" type="phone" name="phone" value="+7" required autofocus
                       autocomplete="username"/>

        <!-- Email Address -->
        <div>
            <x-twcompo::input-label for="email" :value="__('Email')"/>
            <x-twcompo::text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autofocus autocomplete="email"/>
            <x-twcompo::input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-twcompo::input-label for="password" value="Пароль"/>

            <x-twcompo::text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>

            <x-twcompo::input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        {{--        <div class="block mt-4">--}}
        {{--            <label for="remember_me" class="inline-flex items-center">--}}
        {{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
        {{--                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Запомнить') }}</span>--}}
        {{--            </label>--}}
        {{--        </div>--}}

        <div class="flex items-center justify-end mt-4">


            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}">
                    {{ __('Забыли пароль') }}
                </a>
            @endif

            {{--            <x-twcompo::primary-button class="ml-3">--}}
            {{--                {{ __('Войти') }}--}}
            {{--            </x-primary-button>--}}
        </div>

        <div class="mt-2">
            <button type="submit" class="bg-gray-700 text-white font-medium py-2 px-4 w-full rounded hover:bg-gray-600">
                Войти
            </button>
        </div>

        @if (Route::has('login'))
            @if (Route::has('register'))
                <div class="mt-4 w-full">
                    <a href="{{ route('register') }}"
                       class="bg-gray-200 text-black font-medium py-2 px-4 block text-center w-full rounded hover:bg-gray-300">Зарегистрироваться</a>
                </div>
            @endif
        @endif
    </form>

    <div class="my-4 flex items-center justify-between">
        <span class="border-b w-1/5 md:w-1/4"></span>
        <a href="#" class="text-xs text-gray-500 uppercase">или войти через</a>
        <span class="border-b w-1/5 md:w-1/4"></span>
    </div>


    <div class="grid grid-cols-2 gap-2">
        <x-twcompo::oauth.oauth-login-button provider="vkontakte"></x-twcompo::oauth.oauth-login-button>
        <x-twcompo::oauth.oauth-login-button provider="mailru"></x-twcompo::oauth.oauth-login-button>
        <x-twcompo::oauth.oauth-login-button provider="yandex"></x-twcompo::oauth.oauth-login-button>
        <x-twcompo::oauth.oauth-login-button provider="google"></x-twcompo::oauth.oauth-login-button>
    </div>

</x-pauth::guest-layout>
