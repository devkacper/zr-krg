<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthorizationRequest;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    /**
     * User authorization to the API.
     *
     * @param AuthorizationRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function authenticate(AuthorizationRequest $request)
    {
        $credentials = $request->safe()->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response([
                'message' => __('api_response.authorization.failed'),
            ], 401);
        }

        return response([
            'message' => __('api_response.authorization.success'),
            'api_token' => request()->token
        ], 200);
    }
}
