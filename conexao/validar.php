<?php
session_start();

if (isset($_SESSION['loginUser'])) {
    $login = $_SESSION['loginUser'];
} else {
    session_destroy();
    header("location: /jadminlte/index.php?sem-autorizacao");
    die();
}
?>
