<?php

require_once 'Loader.php';
require_once "Debug.php";

$db = Db::getDb();
debug($db);