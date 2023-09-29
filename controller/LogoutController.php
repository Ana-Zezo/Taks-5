<?php
session_start();
require_once "../core/helper.php";
session_unset();
session_destroy();
redirect("../index.php");
die;