<?php
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Saxulum\DoctrineMongoDbOdm\Provider\DoctrineMongoDbOdmProvider;


    
$app->register(new Silex\Provider\ServiceControllerServiceProvider());


AnnotationDriver::registerAnnotationClasses();

$app->register(new DoctrineMongoDbProvider, array(
    "mongodb.options" => array(
        "server" => "mongodb://localhost:27017",
        "options" => array(
            "username" => "",
            "password" => "",
            "db" => "test"
        ),
    ),
));

$app->register(new DoctrineMongoDbOdmProvider, array(
    "mongodbodm.proxies_dir" => "/Proxies",
    "mongodbodm.hydrator_dir" => "/Hydrator",
    "mongodbodm.dm.options" => array(
        "database" => "test",
        "mappings" => array(
                "type" => "annotation",
                "namespace" => "/Documents",
                "resources_namespace" => "/Documents",
        ),
    ),
));
