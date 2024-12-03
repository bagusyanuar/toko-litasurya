<?php


namespace App\Services\Web;


use App\Domain\MetaPagination;
use App\Domain\ServiceResponse;
use App\Domain\ServiceResponseWithMetaPagination;
use App\Domain\Web\Item\ItemFilter;
use App\Domain\Web\Item\ItemRequest;
use App\Helpers\FileUpload\FileUpload;
use App\Helpers\FileUpload\FileUploadRequest;
use App\Models\Item;
use App\Usecase\Web\ItemInterface;
use Illuminate\Support\Facades\DB;

class ItemService implements ItemInterface
{
    private $targetPathImage = 'static/image/item';
    /**
     * @inheritDoc
     */
    public function getDataItems(ItemFilter $filter): ServiceResponseWithMetaPagination
    {
        // TODO: Implement getDataItems() method.
        $response = new ServiceResponseWithMetaPagination();
        try {
            $query = Item::with(['category']);
            if ($filter->getParam() !== '') {
                $query->where('name', 'LIKE', "%{$filter->getParam()}%");
            }
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $totalRows = $query->count();
            $data = $query->offset($offset)
                ->limit($filter->getPerPage())
                ->get();
            $metaPagination = new MetaPagination($filter->getPage(), $filter->getPerPage(), $totalRows);
            $response->setMessage('successfully retrieve data items')
                ->setData($data)
                ->setMeta($metaPagination);
        }catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function createNewItem(ItemRequest $itemRequest): ServiceResponse
    {
        // TODO: Implement createNewItem() method.
        $response = new ServiceResponse();
        DB::beginTransaction();
        try {
            $file = $itemRequest->getFile();
            $imageName = null;
            if ($file) {
                $fileUploadService = new FileUpload();
                $fileUploadRequest = new FileUploadRequest($this->targetPathImage, $file);
                $fileUploadResponse = $fileUploadService->upload($fileUploadRequest);

                if (!$fileUploadResponse->isSuccess()) {
                    DB::rollBack();
                    return $response->setSuccess(false)
                        ->setCode(500)
                        ->setMessage($fileUploadResponse->getMessage());
                }
                $imageName = $fileUploadResponse->getFileName();
            }
            $data = [
                'category_id' => $itemRequest->getCategoryID(),
                'name' => $itemRequest->getName(),
                'image' => $imageName,
                'description' => $itemRequest->getDescription(),
            ];
            Item::create($data);
            $response->setMessage('successfully create new item')->setCode(201);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function getItemByID($id): ServiceResponse
    {
        // TODO: Implement getItemByID() method.
        $response = new ServiceResponse();
        try {
            $data = Item::with(['category'])
                ->where('id', '=', $id)
                ->first();
            if (!$data) {
                return $response->setSuccess(false)
                    ->setCode(404)
                    ->setMessage('item not found');
            }
            $response->setMessage('successfully get data item')
                ->setData($data);
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function updateItem(Item $item, ItemRequest $itemRequest): ServiceResponse
    {
        // TODO: Implement updateItem() method.
        $response = new ServiceResponse();
        try {
            $file = $itemRequest->getFile();
            $imageName = null;
            $data = [
                'category_id' => $itemRequest->getCategoryID(),
                'name' => $itemRequest->getName(),
                'description' => $itemRequest->getDescription(),
            ];
            if ($file) {
                $fileUploadService = new FileUpload();
                $fileUploadRequest = new FileUploadRequest($this->targetPathImage, $file);
                $fileUploadResponse = $fileUploadService->upload($fileUploadRequest);

                if (!$fileUploadResponse->isSuccess()) {
                    return $response->setSuccess(false)
                        ->setCode(500)
                        ->setMessage($fileUploadResponse->getMessage());
                }
                $imageName = $fileUploadResponse->getFileName();
                $data['image'] = $imageName;
            }
            $item->update($data);
            $response->setMessage('successfully update data item');
        }catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function deleteItem(Item $item): ServiceResponse
    {
        // TODO: Implement deleteItem() method.
        $response = new ServiceResponse();
        try {
            $item->delete();
            $response->setMessage('successfully delete item');
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setCode(500)
                ->setMessage($e->getMessage());
        }
        return $response;
    }
}
