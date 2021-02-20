<?php
session_start();
echo 'please wait some time...';
session_destroy();
header("location:/forum");
?>