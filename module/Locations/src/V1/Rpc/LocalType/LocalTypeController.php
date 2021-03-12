<?php
namespace Locations\V1\Rpc\LocalType;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\Configuration\Exception\RuntimeException;

class LocalTypeController extends AbstractActionController
{
    protected $tableGateway;
    
    public function __construct($tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function localTypeAction()
    {
        $request = $this->getRequest();
        $content = json_decode($request->getContent());
        
        switch ($request->getMethod()) {
            case "POST":
                
                $data = [
                    'name' => $content->name
                ];
                
                return $this->tableGateway->insert($data);                                
                break;
            
            case "PATCH":                
                $id = (int) $content->id;      
                
                try {
                    $oldType = $this->fetch($id);
                } catch (RuntimeException $e) {
                    throw new RuntimeException(sprintf(
                        'Cannot update local type with identifier %d; does not exist',
                        $id
                    ));
                }
                
                if ($oldType['name'] === $content->name) {
                    return true; // para a execução
                }
                
                $data = [
                    'name' => $content->name
                ];
                                    
                return $this->tableGateway->update($data, ['id' => $id]);                
                break;
                
            case "GET":
                
                $id = (int) $content->id;
                
                if ($id === 0) {
                    return $this->fetchAll();    
                } else {
                    return $this->fetch($id);
                }
                
                break;
            
            case "DELETE":
                $id = (int) $content->id;
                
                $this->checkDelete($id);
                        
                return $this->tableGateway->delete(['id' => $id]);
                break;
        }
    }
    
    public function fetch($id)
    {
        $rowset = $this->tableGateway->select(['id' => $id]);
        $row = $rowset->toArray();
        if (!$row) {
            throw new RuntimeException(sprintf(
                'Could not find row with identifier %d',
                $id
            ));
        }
        return $row[0];
    }
    
    public function fetchAll()
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(['id', 'name']); 

    	$result = $this->tableGateway->selectWith($select);

    	return $result->toArray();
    }
    
    public function checkDelete($id)
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(['id']); 
        $select->join('locations', 'local_type.id = locations.type_id');    
        $select->where("type_id = {$id}");
    	$rowset = $this->tableGateway->selectWith($select);
        
        if (!empty($rowset->toArray())) {
            throw new RuntimeException(sprintf('There are places linked to this type'));
        }
    }
}
