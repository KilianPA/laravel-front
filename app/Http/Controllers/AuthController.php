<?php

namespace App\Http\Controllers;

use App\Utils\ApiClient;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index () {
        return view('auth.login-form');
    }

    public function login (Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $response = $this->clientApi->request('post', 'auth/login', ['form_params' => ['email' => $email, 'password' => $password]]);
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            if ($data['token']) {
                Session::put('bearer_token', $data['token']);
            }
            return redirect()->to('/');
        } else {
            return view('auth.login-form', ['response' => $response]);
        }
    }
}
