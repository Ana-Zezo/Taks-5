<?php

session_start();
require_once "../core/helper.php";
// First Step Call Function checkRequest to Get Method Type POST
if (checkRequest("POST")) {
    // Create Array To يسجل فيها الارور
    $error = [];

    // بعمل sanitize للداتا اللى جاى من الفورم وبخذنها بستخدام key and Value
    foreach ($_POST as $key => $value) {
        $$key = sanitize($value);
    }

    // علشان افحص الداتا اللى جايه بالنسبة لاول مدخل هو name
    if (requiredVal($name)) {
        $error["name"] = "Name Is Required";
    } elseif (minVal($name, 3)) {
        $error["name"] = "Name Must Be Greater Than 3";
    } elseif (maxVal($name, 25)) {
        $error["name"] = "Name Must Be Less Than 25";
    }
    // علشان افحص الداتا اللى جايه بالنسبة لاول مدخل هو Password

    if (requiredVal($password)) {
        $error["password"] = "Password Is Required";
    } elseif (minVal($password, 3)) {
        $error["password"] = "Password Must Be Greater Than 3";
    } elseif (maxVal($password, 20)) {
        $error["password"] = "Password Must Be Less Than 20";
    }

    // علشان افحص email 
    if (requiredVal($email)) {
        $error["email"] = "Email Is Required";
    } elseif (emailVal($email)) {
        $error["email"] = "Email Is Invalid";
    }
    $users = readFromJsonFile("../data/user.json");
    if ($users != null) {
        foreach ($users as $user) {
            if ($user["email"] == $email) {
                $error["email"] = "Email is Exists";
            }
        }
    }




    if (empty($error)) {
        $users = json_decode(file_get_contents("../data/user.json"), true);
        if ($users == null) {
            $data = [
                'id' => 1,
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $users[] = $data;
            file_put_contents("../data/user.json", json_encode($users, JSON_PRETTY_PRINT));
            $_SESSION["success_register"] = "Success Register Please,Login ";
            redirect("../index.php");
            die;
        } else {
            $myId = end($users)["id"] + 1;
            $data = [
                'id' => $myId,
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];
            $users[] = $data;
            file_put_contents("../data/user.json", json_encode($users, JSON_PRETTY_PRINT));
            $_SESSION["success_register"] = "Success Register Please,Login ";
            redirect("../index.php");
            die;
        }
    } else {
        $_SESSION["register_error"] = $error;
        redirect("../register.php");
        die;
    }



} else {
    // لو جاى من النوع get عاوزك تعملى شيشن اسمها request_error وضيف فيها Invalid Request وبعديها روح على نفس المكان اللى جاى منه وموت السيشن بتعاتك
    $_SESSION["request_error"] = "Invalid Request";
    redirect("../register.php");
    die;
}