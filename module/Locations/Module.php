<?php
namespace Locations;

use Laminas\ApiTools\Provider\ApiToolsProviderInterface;
use Laminas\Db\ResultSet\ResultSet;
use Locations\V1\Rest\Local\LocalEntity;
use Laminas\Db\TableGateway\TableGateway;
use Locations\V1\Rest\Local\LocalMapper;

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
                        
                LocalMapper::class => function($container) {
                    return new LocalMapper($container->get('LocalTableGateway'));
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
