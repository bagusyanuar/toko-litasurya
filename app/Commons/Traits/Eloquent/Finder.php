<?php


namespace App\Commons\Traits\Eloquent;


use App\Commons\Response\ServiceResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Finder
{

    /**
     * @param $class
     * @param $id
     * @param string $templateMessage
     * @return ServiceResponse
     */
    public static function getOneByID($class, $id, $templateMessage = 'item')
    {
        try {
            /** @var Model $model */
            $model = app($class);
            $data = $model::find($id);
            if (!$data) {
                return ServiceResponse::notFound("{$templateMessage} not found");
            }
            return ServiceResponse::statusOK("successfully get {$templateMessage}", $data);
        } catch (\Exception $e) {
            return ServiceResponse::notFound($e->getMessage());
        }
    }
}
