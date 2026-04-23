<?php
if (!session_id()) {
    session_start();
}

require_once '../app/config/config.php';
require_once '../app/core/Database.php';
require_once '../app/core/BaseModel.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';
require_once '../app/helpers/Formatter.php';

$app = new App();
?>