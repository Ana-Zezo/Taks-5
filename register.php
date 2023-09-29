<?php
require_once "./inc/header.php";
require_once "./core/helper.php"
    ?>
<div class="container  my-5 w-50">
    <div class="row ">
        <?php
        keySession("request_error");
        keyAndValueSession("register_error", "name");
        keyAndValueSession("register_error", "email");
        keyAndValueSession("register_error", "password");
        ?>
        <h2 class="text-center my-5 text-primary">Register</h2>
        <form action="controller/RegisterController.php" method="POST">
            <div class="mb-3 w-50 mx-auto">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="userName" name="name" placeholder="User Name...">
            </div>
            <div class="mb-3 w-50 mx-auto">
                <label for="emailAddress" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Email Address...">

            </div>
            <div class="mb-5 w-50 mx-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password..." class="form-control" id="password">
            </div>
            <div class="mb-3 w-50 mx-auto">
                <button type="submit" class="btn btn-primary w-50 mb-5 mx-auto d-inline-block">Submit</button>
                <a href="index.php" type="submit" class="btn btn-secondary mb-5 mx-auto d-inline-block">Already Have
                    Account</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once "./inc/footer.php";
?>