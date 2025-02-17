<?php

session_start();

$_SESSION['name'] = 'Alexandre';

$names = ['Arthur', 'Eu'];

var_dump($names);
