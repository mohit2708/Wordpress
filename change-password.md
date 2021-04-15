https://codepen.io/Sohail05/pen/yOpeBm
![changePassword](https://github.com/mohit2708/Wordpress/blob/wordpress-codeing/img/changepassword.PNG)
```php
<?php
/* Template Name: Change Password */ 
if (!is_user_logged_in()){ wp_redirect( home_url('login') ); }
get_header(); ?>
<?php 
if( $_POST['submitpassword'] )
{
    $passdata = $_POST;
    unset($_POST,$passdata['submitpassword']);

    $user = wp_get_current_user(); //trace($user);
    $x = wp_check_password( $passdata['curr_pass'], $user->user_pass, $user->data->ID );

    if($x)
    {
        if( !empty($passdata['new_pass']) && !empty($passdata['con_pass']))
        {
            if($passdata['new_pass'] == $passdata['con_pass'])
            {
                $udata['ID'] = $user->data->ID;
                $udata['user_pass'] = $passdata['new_pass'];
                $uid = wp_update_user( $udata );
                if($uid) 
                {
                    $successmsg = "<strong>Success!</strong> The password has been updated successfully";
                    unset($passdata);
                } else {
                    $errrormsg = "<strong>Error!</strong> Sorry! Failed to update your account details.";
                }
            }
            else
            {
                $errrormsg = "<strong>Error!</strong> Confirm password doesn't match with new password";
            }
        }
        else
        {
            $errrormsg = "<strong>Error!</strong> Please enter new password and confirm password";
        }
    } 
    else 
    {
        $errrormsg = "<strong>Error!</strong> Old Password doesn't match the existing password";
    }
}

?>

<div class="container">
<style type="text/css">
  fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 3px 3px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
    .field-icon {
  float: right;
  margin-right: 5px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}

</style>

<div class="row">
   <div class="col-sm-4"></div>
   <div class="col-sm-4">
      <?php 
         if(isset($errrormsg)){ ?>
      <div class="alert alert-danger alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <?php echo $errrormsg; ?>
      </div>
      <?php } 
         if(isset($successmsg)){ ?>
      <div class="alert alert-success alert-dismissible">
         <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
         <?php echo $successmsg; ?>
      </div>
      <?php } ?>
      <form name="frmChange" method="post" action="">
         <fieldset class="scheduler-border">
            <legend class="scheduler-border">Change Password</legend>
            <div class="centered">
               <label>Current Password</label>
               <div class="form-group pass_show"> 
                  <input type="password" value="" name="curr_pass" id="curr_pass" class="form-control" placeholder="Current Password" required="required">
                  <span toggle="#curr_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span> 
               </div>
               <label>New Password</label>
               <div class="form-group pass_show"> 
                  <input type="password" value="" name="new_pass" id="new_pass" class="form-control" placeholder="New Password"> 
                  <span toggle="#new_pass" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
               </div>
               <label>Confirm Password</label>
               <div class="form-group pass_show"> 
                  <input type="password" value="" name="con_pass" id="con_pass" class="form-control" placeholder="Confirm Password">
                  <span toggle="#con_pass" class="fa fa-fw fa-eye field-icon toggle-password2"></span> 

               </div>
               <input type="submit" class="btn btn-success" name="submitpassword" id="submitpassword" value="Submit">
            </div>
         </fieldset>
      </form>
   </div>
   <div class="col-sm-4"></div>
</div>

  
<?php get_footer(); ?>

<script type="text/javascript">
  $(".toggle-password, .toggle-password1, .toggle-password2").click(function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});  

</script>
```
