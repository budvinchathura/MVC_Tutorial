<?php
include "Model.php";
include "View.php";
include "Controller.php";

$model = new Model();
$controller = new Controller($model);
$view = new View($controller,$model);

echo $view->output();
?>