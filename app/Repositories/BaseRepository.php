<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Support\Facades\Storage;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    //lấy model tương ứng
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * @param $file
     * @param $source
     * @return mixed
     */
    public function upload($file, $source)
    {
        $image_name = md5(rand(1000,10000));
        $ext = strtolower($file->getClientOriginalExtension());
        $image_full_name = $image_name.'.'.$ext;
        $uploade_path = $source;
        $image_url = $uploade_path.$image_full_name;
        $file->move($uploade_path,$image_full_name);
        return $image_url;
    }

    /**
     * @param $file
     * @return string
     */
    public function uploadFileToGoogleDrive($file) {
        $filePath = $file->getClientOriginalName();
        Storage::disk('google')->put($filePath, file_get_contents($file));
        // Lấy URL của ảnh
        return Storage::disk('google')->url($filePath);
    }

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    /**
     * @param $sortField
     * @param $sortOrder
     * @return mixed
     */
    public function orderBy($sortField, $sortOrder) {
        return $this->model->orderBy($sortField, $sortOrder);
    }

    /**
     * @return mixed
     */
    public function countTotal() {
        return $this->model->count();
    }

    /**
     * @param $searchKey
     * @param $perPage
     * @param $sortFields
     * @param $sortOrder
     * @return mixed
     */
    public function searchMultipleColumn($searchKey, $perPage, $sortFields, $sortOrder) {
        $query = $this->model->query();

        foreach ($this->model->getFillable() as $field) {
            $query->orWhere($field, 'like', '%' . $searchKey . '%');
        }

        $query->orderBy($sortFields, $sortOrder);


        return $query->paginate($perPage);
    }
}
