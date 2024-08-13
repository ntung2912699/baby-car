<?php


namespace App\Repositories;


interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param int $perPage
     * @return mixed
     */
    public function paginate($perPage = 15);

    /**
     * @param $sortField
     * @param $sortOrder
     * @return mixed
     */
    public function orderBy($sortField, $sortOrder);

    /**
     * @return mixed
     */
    public function countTotal();

    /**
     * @param $searchKey
     * @param $perPage
     * @param $sortFields
     * @param $sortOrder
     * @return mixed
     */
    public function searchMultipleColumn($searchKey, $perPage, $sortFields, $sortOrder);
}
