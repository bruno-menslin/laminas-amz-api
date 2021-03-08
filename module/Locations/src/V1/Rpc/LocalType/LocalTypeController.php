<?php
namespace Locations\V1\Rpc\LocalType;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\ContentNegotiation\ViewModel;

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
        
        $content = $request->getContent();
        $data = json_decode($content);
        
        switch ($request->getMethod()) {
            case "POST":
                
                $data = [
                    'name' => $data->name,
                ];

                $this->tableGateway->insert($data);
                return;
                
                break;
            case "PATCH":
                $method = "PATCH";
                break;
        }
    }
}
