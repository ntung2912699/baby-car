<?php


namespace App\Repositories\ProductModel;


use App\Repositories\BaseRepository;

class ProductModelRepository extends BaseRepository implements ProductModelRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\ProductModel::class;
    }

    /**
     * @param $producerID
     * @param $sortField
     * @param $sortOrder
     * @return mixed
     */
    public function orderByProducerID($producerID, $sortField, $sortOrder)
    {
        return $this->orderBy($sortField, $sortOrder)->where('producer_id', '=', $producerID);
    }

    /**
     * @param $producerID
     * @return mixed
     */
    public function getByProducerID($producerID)
    {
        $query = $this->model->query();
        $query->where('producer_id', '=', $producerID);
        return $query->get();
    }

    /**
     * @param $producerID
     * @param $searchKey
     * @param $perPage
     * @param $sortFields
     * @param $sortOrder
     * @return mixed
     */
    public function searchMultipleByProducerID($producerID, $searchKey, $perPage, $sortFields, $sortOrder) {
        $query = $this->model->query();

        foreach ($this->model->getFillable() as $field) {
            $query->orWhere($field, 'like', '%' . $searchKey . '%');
        }
        $query->where('producer_id', '=', $producerID);
        $query->orderBy($sortFields, $sortOrder);

        return $query->paginate($perPage);
    }
}
