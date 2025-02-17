<?php


namespace App\Commons\Traits\Eloquent;


use App\Commons\Response\ServiceResponse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait Finder
{
    /**
     * @param $id
     * @param string $message
     * @return Model|ServiceResponse
     */
    public static function findByID($id, $message = 'Data not found!')
    {
        try {
            return self::findOrFail($id);
        }catch (ModelNotFoundException $e) {
            return ServiceResponse::notFound($message);
        }
    }
}
