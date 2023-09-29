<?php

session_start();
require_once "../core/helper.php";
if (checkRequest("POST")) {
    $error = [];
    $name = sanitize($_POST["task-name"]);

    if (requiredVal($name)) {
        $error["task-name"] = "Task Is Required";
    } elseif (minVal($name, 3)) {
        $error["task-name"] = "Task Is Less Than 3";
    } elseif (maxVal($name, 25)) {
        $error["task-name"] = "Task Is Less Than 25";
    }

    if (isset($_POST["id"])) {
        // 
    }
} else {
    $_SESSION["request_error"] = "Invalid Request";
    redirect("../edit.php");
    die;
}