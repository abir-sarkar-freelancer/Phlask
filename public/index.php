<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Phlask\Core\App;
use Phlask\Core\Request;
use Phlask\Core\Template;
use Phlask\Core\Helper;

// Set the views path
Template::setViewsPath(__DIR__ . '/../src/Views/');

$app = new App();

$app->get('/', function(Request $request) {
    return Template::make('home.php', [
        'title' => 'Welcome to Phlask',
        'cssFile' => Helper::css('styles.css'),
        'jsFile' => Helper::js('app.js'),
        'logoImage' => Helper::image('logo.png')
    ]);
});

$app->run();