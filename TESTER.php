<?php 
include 'functions/console.php';
$console = new Console;
$randomize = rand(1000*10000, 1000*20000);
$console->log($randomize); 

?>