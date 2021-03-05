<?php

// arquivo que contem as regras de negócio pra manipular o banco

namespace Locations\V1\Rest\Local;

use Laminas\Db\TableGateway\TableGateway;

class LocalMapper
{
    // precisa relacionar o mapeamento com uma tabela do banco,
    // utilizar um TableGateway
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
}
