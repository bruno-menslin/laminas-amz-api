<?php
namespace Locations;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Locations\V1\Rest\Local\LocalMapper;
use Locations\V1\Rest\Local\LocalEntity;
use Locations\V1\Rpc\LocalType\LocalTypeEntity;

class Module implements ApiToolsProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'LocalTableGateway' => function($container) {
                    $dbAdapter = $container->get('laminas-amz-project');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new LocalEntity());
                    return new TableGateway('locations', $dbAdapter, null, $resultSetPrototype);
                },
                        
                'LocalTypeTableGateway' => function($container) {
                    $dbAdapter = $container->get('laminas-amz-project');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new LocalTypeEntity());
                    return new TableGateway('local_type', $dbAdapter, null, $resultSetPrototype);
                },
                        
                LocalMapper::class => function($container) {
                    return new LocalMapper($container->get('LocalTableGateway'), $container->get('LocalTypeTableGateway'));
                },
            ],
        ];
    }

    public function getAutoloaderConfig()
    {
        return [
            'Laminas\ApiTools\Autoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src',
                ],
            ],
        ];
    }
}
