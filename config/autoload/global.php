<?php
//Configuración para conectarnos a MySQL con PDO
return array
(
    'service_manager'=>array(
        'factories'=>array(
            'Zend\Db\Adapter'=>'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
    'db'=>array(
        'username'=>'root',
        'password'=>'',
        'driver'=>'Pdo',
        'dsn'=>'mysql:dbname=libro;host:localhost',
        'driver_options'=>array(
            PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES \'utf8\''
        ),
    ),       
);