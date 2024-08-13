<?php


namespace App\Repositories\AttributeSpec;


use App\Repositories\BaseRepository;

class AttributeSpecRepository extends BaseRepository implements AttributeSpecRepositoryInterface
{

    public function getModel()
    {
        return \App\Models\Attribute_spec::class;
    }

    /**
     * @param $attrID
     * @param $sortField
     * @param $sortOrder
     * @return mixed
     */
    public function orderByAttributeID($attrID, $sortField, $sortOrder)
    {
        return $this->orderBy($sortField, $sortOrder)->where('attribute_id', '=', $attrID);
    }

    /**
     * @param $attrID
     * @return mixed
     */
    public function getByAttributeID($attrID)
    {
        $query = $this->model->query();
        $query->where('attribute_id', '=', $attrID);
        return $query->get();
    }

    /**
     * @param $attrID
     * @param $searchKey
     * @param $perPage
     * @param $sortFields
     * @param $sortOrder
     * @return mixed
     */
    public function searchMultipleByAttributeID($attrID, $searchKey, $perPage, $sortFields, $sortOrder) {
        $query = $this->model->query();

        foreach ($this->model->getFillable() as $field) {
            $query->orWhere($field, 'like', '%' . $searchKey . '%');
        }
        $query->where('attribute_id', '=', $attrID);
        $query->orderBy($sortFields, $sortOrder);

        return $query->paginate($perPage);
    }
}
