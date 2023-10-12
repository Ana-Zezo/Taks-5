<?php

session_start();
require_once "../core/helper.php";
if (checkRequest("POST")) {
    dd($_POST);
    $name = sanitize($_POST["name"]);
    $error = [];
    if (requiredVal($name)) {
        $error["name"] = "Required";
    } elseif (minVal($name, 3)) {
        $error["name"] = "Task Less Than 3";
    } elseif (maxVal($name, 25)) {
        $error["name"] = "Task Less Than 25";
    }
    if (empty($error)) {
        $tasks = readFromJsonFile("../data/task.json");
        dd($_GET);

        foreach ($tasks as $task) {
            if ($task["id"] == $_GET["id"] && $task["user_id"] == $_SESSION["auth"]["id"]) {
                $task["task-name"] = $name;
            }
            $update[] = $task;
        }
        file_put_contents("../data/task.json", json_encode($update, JSON_PRETTY_PRINT));
        $_SESSION["success_error"] = "Task Update Successfully";
        redirect("../edit.php?id=" . $_GET["id"]);
        die;
    } else {
        $_SESSION['errors'] = $error;
        redirect("../edit.php?id=" . $_GET['id']);
        die();
    }

} else {
    $_SESSION["request_error"] = "Invalid Request";
    redirect("../edit.php?id=" . $_GET['id']);
    die;
}