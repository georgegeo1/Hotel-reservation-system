<?php
include ("include/reg_customer.php");
include ("include/head.php");
?>

<body class="login-body">
<div class="container login-container">

    <div class="row">
        <div class="col"></div>
        <div class="col-sm-12 col-md-8">
            <div class="card login-card">
                <div class="card-block">
                    <form class="login-form" action="" method="POST">
                        <div class="form-group">
                            <input type="text" class="form-control" name="firstName" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lastName" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="emailInput" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="username" class="form-control" name="Username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="passwordInput" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <input id="num1" class="sum" type="text" name="num1" value="<?php echo rand(1,30) ?>" readonly="readonly" size="2"/> +
                            <input id="num2" class="sum" type="text" name="num2" value="<?php echo rand(1,30) ?>" readonly="readonly" size="2"/> =
                            <input id="captcha" class="captcha" type="text" name="captcha" maxlength="2" />

                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <button type="submit" class="btn btn-primary btn-lg btn-block login-btn" name="register" value="Submit Button">Register</button>
                            </div>

                            <div class= "col-xs-12 col-sm-6 col-md-6">
                                <button class="btn btn-primary btn-lg btn-block login-btn" name="cancel" id="cancel">Cancel</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

    <?php include "include/body_end_scripts.php" ?>
</div> <!-- end container -->
</body>

</html>