<?php

$bdd = new PDO('mysql:host=localhost; dbname=emmaksst; charset=UTF8', 'root', '' );
session_start();
$rollnumber = $_SESSION['rollnumber'];
$connected = $bdd->prepare( "UPDATE users SET connected = 0 WHERE rollnumber = '$rollnumber'" );
$connected->execute( array() );

session_destroy();
header( 'location:home' );
