<?php
session_start();

if (isset($_SESSION['loginUser']) && isset($_SESSION['idPerfilUser'])) {
    $login = $_SESSION['loginUser'];
} else {
    session_destroy();
    header("location: /jadminlte/principal.php?sem-autorizacao");
    die();
}
?>
