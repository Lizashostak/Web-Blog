<?php

require_once 'functions/functions.php';
my_session_start('secure');
session_destroy();
header("location: index.php");
die;


