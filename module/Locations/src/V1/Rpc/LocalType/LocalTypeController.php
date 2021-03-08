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
                $data = [
                    'name' => $content->name
                ];

                try {
                    $this->fetch($id);
                } catch (RuntimeException $e) {
                    throw new RuntimeException(sprintf(
                        'Cannot update local type with identifier %d; does not exist',
                        $id
                    ));
                }
                    
                return $this->tableGateway->update($data, ['id' => $id]);                
                break;
            case "GET":
                return $this->fetchAll();
        }
    }
    
    public function fetch($id)
    {
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
    
    public function fetchAll()
    {
        $select = $this->tableGateway->getSql()->select();
        $select->columns(['id', 'name']); 

    	$result = $this->tableGateway->selectWith($select);

    	return $result->toArray();
    }
}
