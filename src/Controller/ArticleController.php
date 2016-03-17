<?php


namespace tutoSilex\Controller;

use Silex\Application;
use tutoSilex\Documents\Article;

class ArticleController{


	public function indexAction(Application $app) {

        $article = new Article();
        $article->setTitle("First integration Silex Mongo !");
        $article->setContent("Hello guys, this is so funny !!");
        $app['mongodbodm.dm']->persist($article);
        $app['mongodbodm.dm']->flush();
        

    }


}
