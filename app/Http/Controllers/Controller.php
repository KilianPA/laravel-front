<?php

namespace App\Http\Controllers;

use App\Utils\ApiClient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $clientApi;

    public function __construct()
    {
        $client = new ApiClient();
        $this->clientApi = $client->getClient();
    }

    public function authorized()
    {
        session()->put('bearer_token', null);
        redirect()->to('login');
    }
}
