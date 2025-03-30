<?php


namespace App\Http\Controllers;


use App\Commons\Response\APIResponse;
use App\Commons\Response\ServiceResponse;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    /** @var Request $request */
    protected $request;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
    }

    public function requestFromJSON()
    {
        return $this->request->json()->all();
    }

    public function queryAll()
    {
        return $this->request->query();
    }

    public function toJSON(ServiceResponse $serviceResponse)
    {
        return APIResponse::toJSONResponse(
            $serviceResponse->getStatus(),
            $serviceResponse->getMessage(),
            $serviceResponse->getData(),
            $serviceResponse->getMeta()
        );
    }
}
