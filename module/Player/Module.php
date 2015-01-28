<?php
namespace Player;
// Add these import statements:
use Player\Model\Player;
use Player\Model\PlayerTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }


    // OBS denna metod avkommenterades då ska köra sorting and pagination med zend!

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Player\Model\PlayerTable' =>  function($sm) {
                    $tableGateway = $sm->get('PlayerTableGateway');
                    $table = new PlayerTable($tableGateway);
                    return $table;
                },
                'PlayerTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Player());
                    return new TableGateway('bearstats', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }


    // Add this method:

/*
public function getServiceConfig()
 {
     return array(
         'factories' => array(
             'Player\Model\PlayerTable' =>  function($sm) {
                 $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                 $table = new PlayerTable($dbAdapter);
                 return $table;
             },
         ),
     );
 }
*/

}