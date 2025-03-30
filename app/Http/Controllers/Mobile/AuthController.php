<?php


namespace App\Http\Controllers\Mobile;


use App\Domain\Mobile\DTOLogin;
use App\Http\Controllers\CustomController;
use App\Services\Mobile\AuthService;

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
}
