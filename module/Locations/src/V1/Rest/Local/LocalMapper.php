<?php

// arquivo que contem as regras de negócio pra manipular o banco

namespace Locations\V1\Rest\Local;

use Laminas\Db\TableGateway\TableGateway;
use Laminas\ApiTools\Configuration\Exception\RuntimeException;

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
    
    public function fetch($id) 
    {
        $id = (int) $id;
        
        // verificar se local existe
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->current();
        
        if (!$row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }
        
        return $row;        
    }
    
    public function save(LocalEntity $local)
    {
        $data = [
            'name' => $local->name,
            'type_id' => $local->type_id,
        ];
        
        $id = (int) $local->id;
        
        if ($id === 0) { 
            // add
            $this->tableGateway->insert($data);
            return;
        }
        // edit
        
        try { // verificar se ja existe no banco
            $this->fetch($id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Cannot update local with identifier %d; does not exist',
                $id
            ));
        }
        
        $this->tableGateway->update($data, ['id' => $id]);  
    }
}
