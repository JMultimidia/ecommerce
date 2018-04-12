<?php
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \JMultimidia\Page;
use \JMultimidia\PageAdmin;
use \JMultimidia\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();
	$page->setTpl("index");

});

$app->get('/admin', function() {

	User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("index");
});

$app->get('/admin/login', function() {
	$page = new PageAdmin([//diferente porque não vamos usar header e footer padrão
		"header"=>false,
		"footer"=>false
	]);
	$page->setTpl("login");//não tem header nem footer padrão. precisamos desabilitar isso no construtor
});

$app->post('/admin/login', function() {
	User::login($_POST["login"], $_POST["password"]);
	header("Location: /admin");
	exit;
});

$app->get('/admin/logout', function() {
	User::logout();
	header("Location: /admin/login");
	exit;
});

$app->run();

?>