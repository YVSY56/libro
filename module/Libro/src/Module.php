<?php
    namespace Libro;
    use Zend\Mvc\ModuleRouteListener;
    use Zend\Mvc\MvcEvent;

    class Module{
    public function onBootstrap(MvcEvent $e){
        $serviceManager = $e->getApplication()->getServiceManager();
        $dbAdapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($dbAdapter);

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig(){
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
  }
?>