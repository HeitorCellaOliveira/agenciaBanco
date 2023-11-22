<?php
if(!isset($_SESSION)) {
    session_start();
}

session_destroy();

header('Location: index.html', true, 301);
?>