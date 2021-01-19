<?php require_once "include/head.php" ?>

<body class="login-body">

<div class="container login-container">
    <div class="row">
        <div class="col"></div>
        <div class="col-sm-12 col-md-8">
            <div class="card login-card">
                <div class="card-block">
                    <img src="assets/hotel4_.png" class="img-fluid login-img">
                    <form class="login-form" action="include/login_process.php" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                   name="username"
                                   placeholder="User name">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control"
                                   name="password"
                                   placeholder="Password">
                        </div>
                        <button type="submit"
                                class="btn btn-primary btn-lg btn-block login-btn"
                                name="action_type" value="login_customer">Log in as customer</button>
                        <button type="submit" class="btn btn-primary btn-lg btn-block login-btn"
                                name="action_type" value="login_owner">Log in as hotel owner</button>
                        <!--
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox">  Remember me <a href="#"> Need Help?</a>
                            </label>
                        </div>
                        -->
                    </form>
                </div>
            </div>
            <a href="register.php" class="create-new-account">Create New Account</a>
        </div>
        <div class="col"></div>
    </div>
</div>

<?php include "include/body_end_scripts.php" ?>
</body>

</html>