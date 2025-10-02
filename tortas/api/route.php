<?php
include('api.php');
$api = new Api();

$option = $_GET['option'];

if($option=='list')
{
    $data = $api->list();
}

if($option=='insert')
{
    $data = $api->insert();
}

//echo 'hola soy la api de tortas'; 

header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>