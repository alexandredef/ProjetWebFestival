<img id="logo" src="images/logo.png"/>
<?php
session_start();

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
<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap');
body {
    background-image: url("images/wallpaper.png");
    font-family: 'Roboto', sans-serif;
    color: white;
}

form {
    background-color: #c9ced4;
    padding: 15px;
    margin-left: auto;
    margin-right: auto;
    width: 175px;
    text-align: center;
    border: 4mm ridge rgba(74, 63, 171, .6);
}

#logo {
    display: block;
    margin-left: auto;
    margin-right: auto;
}
</style>