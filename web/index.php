<?php
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Saxulum\DoctrineMongoDb\Provider\DoctrineMongoDbProvider;
use Saxulum\DoctrineMongoDbOdm\Provider\DoctrineMongoDbOdmProvider;
use Symfony\Component\HttpFoundation\Response;
use tutoSilex\Documents\Article;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/Documents/Article.php';

$app = new Silex\Application();

$app['debug'] = true;

AnnotationDriver::registerAnnotationClasses();

$app->register(new DoctrineMongoDbProvider, array(
    "mongodb.options" => array(
        "server" => "mongodb://localhost:27017",
        "options" => array(
            "username" => "root",
            "password" => "root",
            "db" => "test"
        ),
    ),
));

$app->register(new DoctrineMongoDbOdmProvider, array(
    "mongodbodm.proxies_dir" => __DIR__."../var/proxies",
    "mongodbodm.hydrator_dir" => __DIR__."../var/hydrator",
    "mongodbodm.dm.options" => array(
        "database" => "test",
        "mappings" => array(
            array(
                "type" => "annotation",
                "namespace" => "tutoSilex\Documents",
                "path" => __DIR__."/../src/Documents",
            ),
        )
    ),
));

###########################################

$app->get('/', function () use ($app){
    $article = new Article();
    $article->setTitle("First integration Silex Mongo !");
    $article->setContent("Hello guys, this is so funny !!");
    $app['mongodbodm.dm']->persist($article);
    $app['mongodbodm.dm']->flush();

    return new Response('Done');
});


$app->run();