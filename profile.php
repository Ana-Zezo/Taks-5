<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
isLogin("./index.php");

$tasks = readFromJsonFile("./data/task.json");
$myTasks = [];
if ($tasks != null) {
    foreach ($tasks as $task) {
        $myTasks[] = $task;
    }
}
keySession("not_exist");
?>
<div class="container my-5">
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
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (@$myTasks != null) {
                        foreach ($myTasks as $value) { ?>
                            <tr>
                                <th scope="row">
                                    <?= $value["id"]; ?>
                                </th>
                                <td>
                                    <?= $value["task-name"]; ?>
                                </td>
                                <td class="mx-auto">
                                    <a href="./edit.php?id=<?= $value["id"] ?>" class="btn btn-info ">Edit</a>
                                    <a href="./controller/DeleteController.php?id=<?= $value["id"] ?>"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php }
                    } else {
                        $myTasks = [];
                        $_SESSION["Empty_Data"] = "Create The First Task";
                        keySession("Empty_Data", "info");
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
require_once "./inc/footer.php";
?>