<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function __construct()
    {
    }

    public function auth(Request $request) {

        $credentials = [
            "email" => $request->get("email"),
            "password" => $request->get("password")
        ];

        if (! $token = app("auth")->attempt($credentials)) {
            return response()->json(["status" => false, 'error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            "status" => true,
            'token' => $token,
        ]);
    }

    public function logout() {
        // Remove token
        app("auth")->invalidate(true);
    }

}
