<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
isLogin("./index.php");
keySession("request_error");
keySession("success_create", "success");
keyAndValueSession("create_errors", "task-name");

?>
<div class="container">
    <div class="row my-5">
        <form action="./controller/CreateController.php" class="form-group" method="POST">
            <label for="text" class="form-label">Task</label>
            <input type="text" name="task-name" id="text" class="form-control w-25">
            <input type="submit" class="btn btn-success mt-3">
            <a href="profile.php" class="btn btn-primary mx-5 mt-3">profile</a>
        </form>
    </div>
</div>
<?php
require_once "./inc/footer.php";
?>