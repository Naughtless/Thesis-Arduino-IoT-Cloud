<?php

require_once __DIR__.'/../routes/controllers.php';

$controller = check();
$controller->invoke();



