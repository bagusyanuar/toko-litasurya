<?php


namespace App\Http\Controllers\Mobile;

use App\Commons\JWT\JWTAuth;
use App\Domain\Mobile\DTOLogin;
use App\Http\Controllers\CustomController;
use App\Models\User;
use App\Services\Mobile\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends CustomController
{
    /** @var AuthService $service */
    private $service;

    /** @var DTOLogin $dtoLogin */
    private $dtoLogin;

    public function __construct()
    {
        parent::__construct();
        $this->service = new AuthService();
        $this->dtoLogin = new DTOLogin();
    }

    public function login()
    {
        $jsonData = $this->requestFromJSON();
        $this->dtoLogin->hydrateForm($jsonData);
        $response = $this->service->login($this->dtoLogin);
        return $this->toJSON($response);
    }

    public function getUserData()
    {
        $user = User::with('sales')->find(Auth::id());
        return response()->json([
            'success' => true,
            'message' => 'User profile',
            'data' => $user,
        ]);
    }
}
