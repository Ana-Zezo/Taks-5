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
    if (empty($error)) {
        $tasks = readFromJsonFile("../data/task.json");
        if ($tasks == NULL) {
            $data = [
                "id" => 1,
                "task-name" => $name,
                "user_id" => $_SESSION["auth"]["id"]
            ];
            $tasks[] = $data;
            file_put_contents("../data/task.json", json_encode($tasks, JSON_PRETTY_PRINT));
            $_SESSION["success_create"] = "Task Created Successful";
            redirect("../create.php");
            die;
        } else {
            $id = end($tasks)["id"] + 1;
            $tasks = readFromJsonFile("../data/task.json");
            $data = [
                "id" => $id,
                "task-name" => $name,
                "user_id" => $_SESSION["auth"]["id"]
            ];
            $tasks[] = $data;
            file_put_contents("../data/task.json", json_encode($tasks, JSON_PRETTY_PRINT));
            $_SESSION["success_create"] = "Task Created Successful";
            redirect("../create.php");
            die;
        }

    } else {
        $_SESSION["create_errors"] = $error;
        redirect("../create.php");
        die;
    }

} else {
    $_SESSION["request_error"] = "Invalid Request";
    redirect("../create.php");
    die;
}