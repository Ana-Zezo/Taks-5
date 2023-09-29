<?php


session_start();
require_once "../core/helper.php";

$id = $_GET["id"];
$tasks = readFromJsonFile("../data/task.json");
foreach ($tasks as $key => $value) {
    if ($value["id"] == $id && $value["user_id"] == $_SESSION["auth"]["id"]) {
        unset($tasks[$key]);
    }
}

file_put_contents("../data/task.json", json_encode($tasks, JSON_PRETTY_PRINT));
$_SESSION["success_delete"] = "Task Deleted Successful";
redirect("../profile.php");
die;