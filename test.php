<?php
use tutoSilex\Documents\Article;

$app = new Silex\Application();


require '/app/app.php';


        $article = new Article();
        $article->setTitle("First integration Silex Mongo !");
        $article->setContent("Hello guys, this is so funny !!");
        $app['mongodbodm.dm']->persist($article);
        $app['mongodbodm.dm']->flush();

$app->run();