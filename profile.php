<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
if (!isset($_SESSION["auth"])) {
    redirect("./index.php");
    die;
}

$tasks = readFromJsonFile("./data/task.json");
if ($tasks != null) {
    foreach ($tasks as $task) {
        if ($task["user_id"] == $_SESSION["auth"]["id"]) {
            $data[] = $task;
        }
    }
    if (!isset($data)) {
        $_SESSION["first_task"] = "Create First Task";
    }
}
?>
<div class="container my-5">
    <?php
    keySession("first_task", "info");
    keySession("request_error");
    keySession("request_error");
    keyAndValueSession("errors", "name")
        ?>
    <div class="row col-12 d-flex">
        <div class="col-4">
            <div class="card" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">Name :
                        <?= $_SESSION["auth"]["name"] ?>
                    </h5>
                    <p class="card-text">Email :
                        <?= $_SESSION["auth"]["email"] ?>
                    </p>
                    <a href="./controller/LogoutController.php" class="btn btn-danger my-3">Logout</a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <a href="create.php" class="btn btn-success mb-3">Create Task</a>
            <table class="table">
                <?php
                if (isset($data)) {
                    ?>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $task) {
                            ?>
                    <tr>

                        <th scope="row">
                            <?= $task["id"] ?>
                        </th>
                        <td>
                            <?= $task["task-name"] ?>
                        </td>
                        <td class="mx-auto">
                            <a href="./edit.php?id=<?= $task["id"] ?>" class="btn btn-info ">Edit</a>
                            <a href="./controller/DeleteController.php?id=<?= $task["id"] ?>"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                        ?>
                </tbody>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
require_once "./inc/footer.php";
?>