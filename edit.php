<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
if (!isset($_SESSION["auth"])) {
    redirect("./index.php");
    die;
}

$tasks = readFromJsonFile("./data/task.json");
foreach ($tasks as $task) {
    if ($task["id"] == $_GET["id"] && $task["user_id"] == $_SESSION["auth"]["id"]) {
        $myData = $task;
    }
}
if (!$myData) {
    $_SESSION['not_found'] = "Not Found";
    redirect("profile.php");
    die;
}
?>

<div class="container">
    <div class="row my-5">
        <?php
        keySession("request_error");
        keyAndValueSession("edit_error", "name");
        ?>
        <form action="./controller/UpdateController.php?id=<?= $myData["id"] ?>" class="form-group" method="POST">
            <label for="text" class="form-label">Task</label>
            <input type="text" name="name" id="text" class="form-control w-25" value="<?= $myData["task-name"] ?>">
            <input type="submit" class="btn btn-success mt-3">
            <a href="profile.php" class="btn btn-primary mx-5 mt-3">profile</a>
        </form>
    </div>
</div>

<?php
require_once "./inc/footer.php";
?>