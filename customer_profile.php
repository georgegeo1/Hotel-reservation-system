<!DOCTYPE html>
<html>
<head>
<?php
session_start();
include ("include/head.php");
include ("include/functions.php");
include ("include/edit_customer_profile.php");
?>
<?php include "include/customer_navbar.php"; ?>
</head>

   <div class="container">


  	<hr>
	<div class="row">

      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>

        <form class="form-horizontal" action="" method="POST">
          <div class="form-group">
            <label class="col-lg-3 control-label">First name:</label>
            <div class="col-lg-8">
              <input name="FirstName" class="form-control" value="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Last name:</label>
            <div class="col-lg-8">
              <input name="LastName" class="form-control" value="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input name="Email" class="form-control" value="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Username:</label>
            <div class="col-lg-8">
                <input name="Username" class="form-control" value="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Phone Number:</label>
            <div class="col-md-8">
              <input name="Phone" class="form-control" value="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">Old Password:</label>
            <div class="col-md-8">
              <input name="OldPassword" class="form-control" value="" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label">New Password:</label>
            <div class="col-md-8">
              <input name="NewPassword" class="form-control" value="" type="password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <input class="btn btn-primary"  name="submit" type="submit" value="Submit">
              <span></span>
              <input class="btn btn-primary" value="Cancel" type="reset" name="cancel">
            </div>
          </div>
        </form>
      </div>



<?php include "include/body_end_scripts.php" ?>
<?php include "include/customer_search_end_scripts.php" ?>

        </html>
