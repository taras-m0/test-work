<?php
/**
 * User: ttt
 * Date: 23.06.2017
 * Time: 7:31
 */
require_once (__DIR__ . '/controller.php');

$controller = new controller(
	new PDO( 'mysql:dbname={db_name};host=127.0.0.1', '{user}', '{password}' )
);

if(array_key_exists('action', $_GET )){
	// если аякс, то запускаем действия из контроллера
	try	{
		print json_encode( $controller->{$_GET[ 'action' ]}( json_decode( trim( file_get_contents('php://input') ) )) );
	}catch (Exception $e){
		print json_encode(array('error' => $e->getMessage()));
	}
}else{
	// иначе выводим стартовую страницу
	extract( $controller->index(), EXTR_SKIP);
	include ( __DIR__ . '/view.php');
}
