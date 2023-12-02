<x-pauth::guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{--        <!-- Name -->--}}
        {{--        <div>--}}
        {{--            <x-twcompo::input-label for="name" :value="__('Name')" />--}}
        {{--            <x-twcompo::text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
        {{--            <x-twcompo::input-error :messages="$errors->get('name')" class="mt-2" />--}}
        {{--        </div>--}}

        <!-- Email Address -->
        <div class="mt-4">
            <x-twcompo::input-label for="email" :value="__('Email')"/>
            <x-twcompo::text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                          autocomplete="username"/>
            <x-twcompo::input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-twcompo::input-label zz value="Пароль"/>

            <x-twcompo::text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password"/>

            <x-twcompo::input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-twcompo::input-label for="password_confirmation" value="Подтверждение пароля"/>

            <x-twcompo::text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password"/>

            <x-twcompo::input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        {{--        <div class="flex items-center justify-end mt-4">--}}
        {{--            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">--}}
        {{--                Уже зарегистрированы?--}}
        {{--            </a>--}}
        {{--           <x-twcompo::primary-button class="ml-4">Регистрация</x-primary-button>--}}
        {{--        </div>--}}

        <div class="mt-8">
            <button type="submit" class="bg-gray-700 text-white font-medium py-2 px-4 w-full rounded hover:bg-gray-600">
                Регистрация
            </button>
        </div>
        <div class="mt-4 w-full">
            <a href="{{ route('login') }}"
               class="bg-gray-0 text-black font-medium py-2 px-4 block text-center w-full rounded hover:bg-gray-100">Уже
                зарегистрированы?</a>
        </div>

    </form>
</x-pauth::guest-layout>
