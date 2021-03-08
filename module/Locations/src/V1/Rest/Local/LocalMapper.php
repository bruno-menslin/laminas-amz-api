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
    protected $typeTableGateway;
    
    public function __construct(TableGateway $tableGateway, TableGateway $typeTableGateway)
    {
        $this->tableGateway = $tableGateway;
        $this->typeTableGateway = $typeTableGateway;
    }
    
    public function fetchAll()
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(['id', 'name', 'type_id']); 
        $select->join('local_type', 'local_type.id = locations.type_id', ['type_name' => 'name']);

    	return $this->tableGateway->selectWith($select);
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
    
    public function fetchType($id)
    {
        $rowset = $this->typeTableGateway->select(['id' => $id]);
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
        $data = [];        
        $id = (int) $local->id;
        
        try { 
            $this->fetchType($local->type_id);
        } catch (RuntimeException $e) {
            throw new RuntimeException(sprintf(
                'Local type with identifier %d; does not exist',
                $local->type_id
            ));
        }
        
        if ($id === 0) { 
            // add   
            if ($local->name === null) {
                throw new RuntimeException(sprintf('Cannot create local without name'));
            } else if ($local->type_id === null) {
                throw new RuntimeException(sprintf('Cannot create local without local_type'));
            }
            
            $data['name'] = $local->name;
            $data['type_id'] = $local->type_id;            
            return $this->tableGateway->insert($data);        
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
                
        $oldLocal = $this->fetch($id);        
        if ($local->name !== $oldLocal->name && $local->name !== null) {
            $data['name'] = $local->name;
        }        
        if ($local->type_id != $oldLocal->type_id && $local->type_id !== null) {
            $data['type_id'] = $local->type_id;
        }
        
        if (empty($data)) {
            throw new RuntimeException(sprintf('Nothing to update'));
        }
                
        return $this->tableGateway->update($data, ['id' => $id]);  
    }
    
    public function delete($id)
    {
        return $this->tableGateway->delete(['id' => (int) $id]);
    }
}
