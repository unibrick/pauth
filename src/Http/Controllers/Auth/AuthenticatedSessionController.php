<?php

namespace Unibrick\PAuth\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{


    public function create()
    {
        return Auth::check() ? redirect('/') : view('pauth::screens.login');
    }

    public function store(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            /** @var User $user */
            $user = User::find(Auth::user()->id);

            $token = $user->createToken('appToken')->accessToken;

            if ($request->wantsJson()) {

                return $this->sendResponse(true, [
                    'access_token' => $token,
                    'user' => $user,
                ], 'Вход выполнен успешно');

            }
            //$request->session()->regenerate();

            return redirect()->intended('/');


        } else {
            return redirect('login')->withErrors(['password' => 'Пользователь не опознан']);
        }
    }

    public function destroy(Request $request)
    {
        // todo kafka
        // если выход инициирован на сервере аутентификации,
        // необходимо разослать уведомления о выходе другим приложениям

        // запрос может прийти от других приложений раньше,
        // чем будет осуществлён выход на сервере аутентификации -
        // к этому моменту юзера уже может не быть.
        Auth::user()?->tokens()->delete();

        Session::flush();

        Auth::logout();

        if ($this->isExternalCall($request)) {
            return redirect()->back();
        }

        return redirect('/');
    }

    private function isExternalCall(Request $request):bool
    {
        $referer = parse_url(url()->previous())['host'];
        $appHost = parse_url(config('app.url'))['host'];

        return $referer !== $appHost;
    }

    protected function sendResponse(bool $success, mixed $result, string $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    protected function sendError(string $message, array $errorMessages = [], int $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
