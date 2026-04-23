<?php
require 'app/config/config.php';
require 'app/core/Database.php';
$db = new Database();
$db->query("SELECT * FROM tours");
var_dump(count($db->resultSet()));
