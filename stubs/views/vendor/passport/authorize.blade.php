<x-pauth::guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="font-medium text-center mb-2">
                Подтвердите вход в приложение
            </div>
            <div class="card-body">
                <!-- Introduction -->
                <div class="text-center mb-2"><strong>{{ $client->name }}</strong></div>

                <!-- Scope List -->
                @if (count($scopes) > 0)
                    <div class="scopes">
                        <p><strong>Приложение получит доступ к:</strong></p>

                        <ul>
                            @foreach ($scopes as $scope)
                                <li>{{ $scope->description }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="buttons flex space-x-4 mt-10 items-center justify-center">
                    <!-- Authorize Button -->
                    <form method="post" action="{{ route('passport.authorizations.approve') }}">
                        @csrf

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                        <x-twcompo::primary-button class="ml-3">Подтвердить</x-twcompo::primary-button>
                    </form>

                    <!-- Cancel Button -->
                    <form method="post" action="{{ route('passport.authorizations.deny') }}">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" name="state" value="{{ $request->state }}">
                        <input type="hidden" name="client_id" value="{{ $client->getKey() }}">
                        <input type="hidden" name="auth_token" value="{{ $authToken }}">
                        <x-twcompo::secondary-button type="submit" class="ml-3">Отмена</x-twcompo::secondary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-pauth::guest-layout>
