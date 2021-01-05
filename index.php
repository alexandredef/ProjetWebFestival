<?php
require 'includes/flight/Flight.php';
require 'includes/Smarty/Smarty.class.php';

$smarty = new Smarty();

require 'includes/pdo.php';

Flight::set('db', $db);

Flight::register('view', 'Smarty', array(), function($smarty){
    $smarty->template_dir = './templates/';
    $smarty->compile_dir = './templates_c/';
    $smarty->config_dir = './config/';
    $smarty->cache_dir = './cache/';
});

Flight::map('render', function($template, $data){
    Flight::view()->assign($data);
    Flight::view()->display($template);
}); 

require 'fonctions.php';

Flight::start();

?>