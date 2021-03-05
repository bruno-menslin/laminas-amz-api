<?php
namespace Locations\V1\Rest\Local;

class LocalEntity
{
    public $id;
    public $name;
    public $type_id;
    public $type_name;
    
    public function exchangeArray(array $data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;        
        $this->type_id = (!empty($data['type_id'])) ? $data['type_id'] : null;
        $this->type_name = (!empty($data['type_name'])) ? $data['type_name'] : null;
    }
    
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type_id' => $this->type_id,
            'type_name' => $this->type_name,
        ];
    }    
}
