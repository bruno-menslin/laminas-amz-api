<?php
namespace Locations\V1\Rest\Local;

use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\Rest\AbstractResourceListener;
use Locations\V1\Rest\Local\LocalEntity;

class LocalResource extends AbstractResourceListener
{
    protected $mapper;
    
    public function __construct($mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) // POST localhost/local
    {
        $local = new LocalEntity();
        $local->id = null;
        $local->name = $data->name;
        $local->type_id = $data->type_id;
        return $this->mapper->save($local);
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) // DELETE localhost/local/1
    {
        if ($this->mapper->delete($id)) {
            return true;
        }
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) // GET localhost/local/1
    {
        return $this->mapper->fetch($id);
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) // GET localhost/local
    {
        return $this->mapper->fetchAll();
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {        
        $local = new LocalEntity();
        $local->id = $id;
        $local->name = $data->name;
        $local->type_id = $data->type_id;
        return $this->mapper->save($local);
    }

    /**
     * Patch (partial in-place update) a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patchList($data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for collections');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data) // PUT localhost/local/1
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
