<?php

namespace Locations\V1\Rpc\LocalType;

class LocalTypeEntity
{
    public $id;
    public $name;
    
    public function exchangeArray(array $data)
    {
        $this->id = (!empty($data['id'])) ? $data['id'] : null;
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
    }
    
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }    
}
