<?php
include "../config/dbconnection.php";
firstStep();


if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']))
    header("location:../main.php");
else {
    $_SESSION["show"] = "home";
    echo '<div class="home">
    <img src="imgs/wallpaper.jpg" style="width: 100%;">
    </div>';
}
