<?php

if (!function_exists("pageTitle")) {
    function pageTitle()
    {
        $scriptName = $_SERVER["SCRIPT_NAME"];
        $stringToArray = explode("/", $scriptName);
        $sortedPathFile = end($stringToArray);
        $sparated = explode(".", $sortedPathFile);
        $title = $sparated[0];
        if ($title == "index") {
            $title = "Login";
        } else
            $title = ucfirst($title);
        return $title;
    }
}


if (!function_exists("redirect")) {
    function redirect($path)
    {
        return header("location:$path");
    }
}

if (!function_exists("sanitize")) {
    function sanitize($input)
    {
        return trim(htmlspecialchars(htmlentities($input)));
    }
}

if (!function_exists("checkRequest")) {
    function checkRequest($method)
    {
        if ($_SERVER["REQUEST_METHOD"] == $method) {
            return true;
        } else
            return false;
    }
}

if (!function_exists("requiredVal")) {
    function requiredVal($input)
    {
        if (empty($input))
            return true;
        else
            return false;
    }
}

if (!function_exists("emailVal")) {
    function emailVal($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return true;
        else
            return false;
    }
}

if (!function_exists("minVal")) {
    function minVal($input, $len)
    {
        if (strlen($input) < $len)
            return true;
        else
            return false;
    }
}
if (!function_exists("maxVal")) {
    function maxVal($input, $len)
    {
        if (strlen($input) > $len)
            return 1;
        else
            return 0;
    }
}

if (!function_exists("readFromJsonFile")) {
    function readFromJsonFile($path)
    {
        return json_decode(file_get_contents($path), true);
    }
}


if (!function_exists("keySession")) {
    function keySession($key, $type = "danger")
    {
        if (isset($_SESSION[$key])) {
            echo "<div class=\"alert alert-$type\">";
            echo $_SESSION[$key];
            unset($_SESSION[$key]);
            echo "</div>";
        }
    }
}

if (!function_exists("keyAndValueSession")) {
    function keyAndValueSession($key, $value = null, $type = "danger")
    {
        if (isset($_SESSION[$key][$value])) {
            echo "<div class=\"alert alert-$type\">";
            echo $_SESSION[$key][$value];
            unset($_SESSION[$key][$value]);
            echo "</div>";
        }
    }
}

if (!function_exists("isLogin")) {
    function isLogin($path)
    {
        if (!isset($_SESSION["auth"])) {
            redirect($path);
            die;
        }
    }
}


function dd(...$args)
{
    echo "<pre>";
    foreach ($args as $arg) {
        print_r($arg);
    }
    echo "</pre>";
}