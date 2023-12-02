<?php

namespace Unibrick\PAuth\Http\Controllers\Auth;

use App\Actions\Logout;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{

    public function register(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ]);
//
//        if ($validator->fails()) {
//            return $this->sendError('Validation Error.', $validator->errors());
//        }
//
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->sendResponse(true, [
            'access_token' => $user->createToken('MyApp')->accessToken,
            'user' => $user,
        ], 'Пользователь успешно зарегистрирован');
    }


    /**
     * На этот роут можно попасть только с с токеном.
     * @param Logout $logout
     * @return JsonResponse
     */
    public function logout(Logout $logout)
    {
        $logout->handle(Auth::user());
        return $this->sendResponse(true, null, 'Выход из системы');
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {

            /** @var User $user */
            $user = User::find(Auth::user()->id);

            $token = $user->createToken('appToken')->accessToken; //PersonalAccessTokenResult

            return $this->sendResponse(true, [
                'access_token' => $token,
                'user' => $user,
            ], 'Вход выполнен успешно');

        } else {
            return $this->sendError('Пользователь не опознан. Проверьте правильность ввода логина и пароля', [], 401);
        }
    }

    protected function sendResponse(bool $success, mixed $result, string $message, int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => $success,
            'data' => $result,
            'message' => $message,
        ], $code, [], JSON_UNESCAPED_UNICODE);
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
