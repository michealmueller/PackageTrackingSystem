<?php
/**
 * Created by PhpStorm.
 * User: micheal
 * Date: 11/30/13
 * Time: 12:58 PM
 */

    session_start();
    session_destroy();
    header('Location: ../index.php');

?>