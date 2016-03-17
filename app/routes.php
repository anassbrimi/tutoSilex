<?php

$app->match('/', "tutoSilex\Controller\ArticleController::indexAction")->bind('home');