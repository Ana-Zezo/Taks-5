<?php
session_start();
require_once "../core/helper.php";

$tasks = readFromJsonFile("../data/task.json");
foreach ($tasks as $key => $task) {
    if ($task["id"] == $_GET["id"] && $_SESSION["auth"]["id"] == $task["user_id"]) {
        unset($tasks[$key]);
    }
}
file_put_contents("../data/task.json", json_encode($tasks, JSON_PRETTY_PRINT));
$_SESSION["success_delete"] = "Successful Delete";
redirect("../profile.php");
die;