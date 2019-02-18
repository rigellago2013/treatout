<?php

session_start();

include 'library/config.php';
include 'classes/transportation.php';
include 'classes/places.php';
include 'classes/user.php';

$places = new Places($connection);
$transportation = new Transportation($connection);
$users = new User($connection);

$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
$place = (isset($_GET['place']) && $_GET['place'] != '') ? $_GET['place'] : '';

?>
<!DOCTYPE html>
<html>
    <head>
         <link rel="icon" href="assets/treatout.png">
        <title> TreatOut </title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <meta http-equiv="cache-control" content="no-cache">
        <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
        <link rel="stylesheet" type="text/css" href="index.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"> </script>
        <script src="index.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
        <!-- Header -->
        <header id="header">
            <a class="logo" href="index.php">TreatOut</a>

            <nav>
                <a href="#menu">Menu</a>
            </nav>
        </header>

        <!-- Nav -->
        <nav id="menu">
            <ul class="links">

           <?php  
           if(isset($_SESSION['id'])) {

              echo "<li> <a href='index.php?mod=profile&id=".$_SESSION['id']."'>".$_SESSION['name']."'s profile   </a></li>";
           } 
           ?>
            <li> <a href="index.php">Home </a></li>
            <li> <a href="index.php?mod=about-us">About Us</a></li>
            <li> <a href="index.php?mod=contact-us">Contact Us</a> </li>
            <?php 
                if(isset($_SESSION['login'])) {
                    echo "<li> <a href='index.php?mod=addplace'>Add a place</a> </li>
                        <li> <a href='index.php?mod=search'>Search</a> </li>
                        <li> <a href='index.php?mod=places&service=tourist+spot'>Tourist spots</a> </li>
                         <li> <a href='index.php?mod=places&service=restaurant'>Restaurant</a> </li>
                          <li> <a href='logout.php'>Logout</a> </li>";
                } else if(!isset($_SESSION['login'])) {
                    echo "  <li> <a href='index.php?mod=register'>Register</a> </li>
                        <li> <a href='index.php?mod=login'>Client login</a> </li>
                         <li> <a href='./admin/index.php?mod=login'>Admin login</a> </li>
                        ";
                }
            ?>
            </ul>
        </nav>
        <!-- Body  -->
        <section id="mainContainer">
        <?php
            switch($module){
                case '':
                    require_once 'modules/client/home/home.php';
                    break;
                case 'search':
                    require_once 'modules/client/search/search.php';
                    break;
                case 'about-us':
                    require_once 'modules/client/about-us/about-us.php';
                    break;
                case 'terminal':
                    require_once 'modules/client/terminals/index.php';
                    break;
                case 'contact-us':
                    require_once 'modules/client/contact-us/contact-us.php';
                break;
                   case 'register':
                require_once 'modules/client/register/index.php';
                break;
                case 'login':
                  require_once 'modules/client/login/index.php';
                break;
                case 'searchvalue':
                  require_once 'modules/client/login/index.php';
                break;
                case 'verify':
                    require_once 'modules/client/profile/profile.php';
                break;
                  case 'addplace':
                    require_once 'modules/client/addplace/index.php';
                break;
                case 'profile':
                  require_once 'modules/client/profile/profile.php';
                break;
                case 'places':
                    if($place != '' ){
                        require_once 'modules/client/place/place.php';
                    }else {
                        require_once 'modules/client/places/places.php';
                    }
                    break;
                default: 
                        require_once 'modules/client/home/home.php';
                        break;
            }
        ?>
        </section>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/breakpoints.min.js"></script>
        <script src="assets/js/util.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
