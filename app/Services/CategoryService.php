<?php


namespace App\Services;


use App\Domain\ServiceResponse;
use App\Domain\Web\Category\CategoryFilter;
use App\Domain\Web\Category\CategoryRequest;
use App\Models\Category;
use App\UseCase\Web\CategoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Ramsey\Uuid\Uuid;

class CategoryService implements CategoryInterface
{

    /**
     * @inheritDoc
     */
    public function getDataCategories(CategoryFilter $filter): ServiceResponse
    {
        // TODO: Implement getDataCategories() method.
        $response = new ServiceResponse();
        try {
            $query = Category::with([]);
            if ($filter->getParam() !== '') {
                $query->where('name', 'LIKE', '%' . $filter->getParam() . '%');
            }
            $offset = ($filter->getPage() - 1) * $filter->getPerPage();
            $totalRows = $query->count();
            $data = $query->offset($offset)
                ->limit($filter->getPerPage())
                ->get();
            $response->setMessage('successfully load data category')
                ->setData($data)
                ->setMeta([
                    'page' => $filter->getPage(),
                    'per_page' => $filter->getPerPage(),
                    'total_rows' => $totalRows
                ]);
        } catch (\Exception $e) {
            $response->setSuccess(false)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function createNewCategory(CategoryRequest $categoryRequest): ServiceResponse
    {
        // TODO: Implement createNewCategory() method.
        $response = new ServiceResponse();
        DB::beginTransaction();
        try {
            $path = 'static/image/category';
            $file = $categoryRequest->getFile();
            $imageName = null;
            $storage_path = public_path($path);
            if (!File::exists($storage_path)) {
                File::makeDirectory($storage_path, 0755, true);
            }

            if ($file instanceof UploadedFile) {
                $extension = $file->getClientOriginalExtension();
                $image = Uuid::uuid4()->toString() . '.' . $extension;
                $imageName = '/' . $path . '/' . $image;
                $targetPath = $storage_path . '/' . $image;
                $tempPath = $file->getRealPath();
                File::move($tempPath, $targetPath);
            }
            $data = [
                'name' => $categoryRequest->getName(),
                'image' => $imageName
            ];
            Category::create($data);
            $response->setMessage('successfully create new category');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response->setSuccess(false)
                ->setMessage($e->getMessage());
        }
        return $response;
    }

    /**
     * @inheritDoc
     */
    public function deleteCategory($id): ServiceResponse
    {
        // TODO: Implement deleteCategory() method.
        $response = new ServiceResponse();
        try {
            Category::destroy($id);
            $response->setMessage('successfully create new category');
        }catch (\Exception $e) {
            $response->setSuccess(false)
                ->setMessage($e->getMessage());
        }
        return $response;
    }
}
