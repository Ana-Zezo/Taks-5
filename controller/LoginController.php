<?php

session_start();
require_once "../core/helper.php";

if (checkRequest("POST")) {
    $error = [];
    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }

    // Validation Email
    if (requiredVal($email)) {
        $error["email"] = "Email Is Required";
    } elseif (emailVal($email)) {
        $error["email"] = "Email Is Invalid";
    }

    // Validation Password
    if (requiredVal($email)) {
        $error["password"] = "Password Is Required";
    }

    if (empty($error)) {
        $users = readFromJsonFile("../data/user.json");
        if ($users == null) {
            $_SESSION["Data_errors"] = "Data Is Deleted Now";
            redirect("../index.php");
            die;
        } else {
            foreach ($users as $key => $user) {
                if ($user["email"] == $email && password_verify($password, $user["password"])) {
                    $_SESSION["auth"] = $user;
                    redirect("../profile.php");
                    die;
                } elseif ($user["email"] == $email) {
                    $_SESSION["Password_errors"] = "Password Incorrect";
                    redirect("../index.php");
                    die;
                }
            }
            $_SESSION["no_create"] = "Email And Password Incorrect";
            redirect("../index.php");
            die;
        }

    } else {
        $_SESSION["login_errors"] = $error;
        redirect("../index.php");
        die;
    }

} else {
    $_SESSION["request_error"] = "Invalid Request";
    redirect("../index.php");
    die;
}