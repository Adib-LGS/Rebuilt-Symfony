<?php

$name  = isset($_GET['name']) ? $_GET['name'] : 'Wolrd';

header('Content-Type: text/html; charset=utf-8');

printf('Hello %s', htmlspecialchars($name, ENT_QUOTES));