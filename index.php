<?php
require_once "./inc/header.php";
require_once "./core/helper.php";
?>
<div class="container  my-5 w-50">
    <div class="row ">
        <?php
        keySession("success_register", "success");
        keyAndValueSession("login_errors", "email");
        keyAndValueSession("login_errors", "password");
        keySession("request_error");
        keySession("Data_errors");
        keySession("no_create");
        keySession("Password_errors");
        ?>
        <h2 class="text-center my-5 text-primary">Login</h2>
        <form action="controller/LoginController.php" method="POST">
            <div class="mb-3 w-50 mx-auto">
                <label for="emailAddress" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="Email Address...">
            </div>
            <div class="mb-5 w-50 mx-auto">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Password..." class="form-control" id="password">
            </div>
            <div class="mb-3 w-50 mx-auto">
                <button type="submit" class="btn btn-primary w-50 mb-5 mx-auto d-inline-block"
                    href="./controller/LoginController.php">Send</button>
                <a href="register.php" type="submit" class="btn btn-secondary mb-5 mx-auto d-inline-block">Create
                    Account</a>
            </div>
        </form>
    </div>
</div>
<?php
require_once "./inc/footer.php";
?>