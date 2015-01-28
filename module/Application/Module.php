<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

//use Zend\ModuleManager\Feature\ConfigProviderInterface;
//use Zend\ModuleManager\Feature\BootstrapListenerInterface;
//use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
//use Zend\Http\Request as HttpRequest;
//use Zend\Http\Response as HttpResponse;

class Module // implements ConfigProviderInterface, BootstrapListenerInterface
{
    public function onBootstrap(MvcEvent $e)
    {

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);



        /*
        //Nytt sätt att få event och servicemanager sen vi införde Authentication
        $application = $event->getTarget();
        $serviceManager = $application->getServiceManager();

        $application   //Denna bootstrappar applikation till sista stund vilket vi vill då authentication
            ->getEventManager()
            ->attach(MvcEvent::EVENT_DISPATCH, function (MvcEvent $event) use ($serviceManager){
                $request = $event->getRequest();
                $response = $event->getResponse();

                if ( ! ($request instanceof HttpRequest && $response instanceof HttpResponse) )
                {
                    return; //we're not in HTTP context - cli application ?
                }
                    

            

        //Nedan del är den delen som visar auth popupen
        $authAdapter = $serviceManager->get('AuthenticationAdapter');
        $authAdapter->setRequest($request);
        $authAdapter->setResponse($response);

        $result = $authAdapter->authenticate();

        if ($result->isValid()){
            return; // All is ok
        }

        $response->setContent('Access denied');
        $response->setStatusCode(HttpResponse::STATUS_CODE_401);

        $event->setResult($response); //short-circuit to application and end

        return FALSE; //stop event propagation
        });
        */
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
