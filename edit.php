<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
isLogin("./index.php");
if (isset($_GET["id"])) {
    $tasks = readFromJsonFile("./data/task.json");
    if ($tasks != null) {
        foreach ($tasks as $key => $task) {
            if ($task["id"] == $_GET["id"] && $task["user_id"] == $_SESSION["auth"]["id"]) {
                $$data = $task;
                break;
            }
        }
        if (!isset($data)) {
            $_SESSION["not_exist"] = "Task No Exist";
            redirect("./profile.php");
            die;
        }
    }
} else {
    $_SESSION["not_exist"] = "Task No Exist";
    redirect("./profile.php");
    die;
}


?>

<div class="container">
    <div class="row my-5">
        <form action="./controller/UpdateController.php" class="form-group" method="POST">
            <label for="text" class="form-label">Task</label>
            <input type="text" name="name" id="text" class="form-control w-25" value="<?= $data['task-name'] ?>">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            <input type="submit" class="btn btn-success mt-3">
            <a href="profile.php" class="btn btn-primary mx-5 mt-3">profile</a>
        </form>
    </div>
</div>

<?php
require_once "./inc/footer.php";
?>