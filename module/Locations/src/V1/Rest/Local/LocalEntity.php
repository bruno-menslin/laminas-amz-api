<?php
namespace Locations\V1\Rest\Local;

class LocalEntity
{
    public $id;
    public $name;
    public $type_id;
    
    public function exchangeArray(array $data)
    {
        $this->id = $data('id');
        $this->name = $data('name');
        $this->type_id = $data('type_id');
    }
    
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type_id' => $this->type_id,
        ];
    }    
}
