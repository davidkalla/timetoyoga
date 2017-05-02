<?php
/*
Template Name: Login
*/
?>

<?php

  if(isset($_POST["register_name"]) && isset($_POST["register_password"]) && isset($_POST["register_email"])){
    if (filter_var($_POST["register_email"], FILTER_VALIDATE_EMAIL)) {
      
      $userdata = array(
        'user_login'  =>  $_POST["register_name"],
        'user_email'    =>  $_POST["register_email"],
        'user_pass'   => $_POST["register_password"]  // When creating an user, `user_pass` is expected.
      );
      
      $user_id = wp_insert_user( $userdata ) ;
      
      //On success
      if ( ! is_wp_error( $user_id ) ) {
        $user=get_userdata( $user_id );
        $error="Your user account was created. Your login is: ". $user->user_login;
        $message=$_POST["register_email"].' was registered on Time to Yoga '. $user->user_login.'. ';
        $message.='Your password: '. $_POST["register_password"].'. ';       
        $headers = 'From: TimeToYoga.com <info@timetoyoga.com>' . "\r\n";
        wp_mail($_POST["register_email"],'TimeToYoga register'.$user->user_login, $message,$headers);
        $succes=1;
        unset($_POST);
      }
      else {
        foreach($user_id->errors as $value){
          $error=$value[0];
        }
      }
    }
    else $error='E-mai ('.$_POST["register_email"].') is not valid.';
  }
?>
  
<div class="row">
  <div class="col-sm-3"></div>
  <div class="col-sm-6 login-form">
    <div class="body">
      <?php if(get_current_user_id()==0) { ?>
      <div class="title"><b>Sign in</b> or <b>Register</b> with Email, Facebook, Twitter or Google+</div>
      <div class="links">
        <div style="display:none"><?php echo do_shortcode('[miniorange_social_login]'); ?></div>
        <span class="login-button mail" onclick="$('#mail-login').toggle();"><i class="fa fa-envelope"></i>SIGN IN WITH EMAIL</span>
        <div id="mail-login" class="mail-login"<?php if(isset($login_error)) echo ' style="display:block;"';?>>
          <?php if(isset($login_error)) echo '<div class="error">'.$login_error.'</div>'; ?>
          <form action="<?php echo get_permalink(); ?>" method="post">
            <input id="login-username" class="input" type="text" name="user" placeholder="Username" />
            <input id="login-password" class="input" type="password" name="password" placeholder="Password" />
            <input id="login-submit" type="submit" class="submit" value="login" >
          </form>
        </div>
        <a class="login-button facebook" onclick="moOpenIdLogin('facebook');"><i class="fa fa-facebook"></i>SIGN IN WITH FACEBOOK</a>
        <a class="login-button google" onclick="moOpenIdLogin('google');"><i class="fa fa-google-plus"></i>SIGN IN WITH Google</a>
        <a class="login-button twitter" onclick="moOpenIdLogin('twitter');"><i class="fa fa-twitter"></i>SIGN IN WITH Twitter</a>
      </div>
      <div class="after">
        <div class="started">Get started</div>
        <a  onclick="$('#register-form').toggle();">Create a new account</a>
        <?php if($error!="") echo '<div class="error">'.$error.'</div>'; ?>
        <form id="register-form" class="mail-login" action="<?php echo get_permalink(); ?>" method="post" <?php if($error!="") echo 'style="display:block;"'; ?>>
          <input class="input" type="text" name="register_name" placeholder="Username" <?php if(isset($_POST["register_name"])) echo ' value="'.$_POST["register_name"].'"'; ?> />
          <input class="input" type="text" name="register_email"  placeholder="E-mail" <?php if(isset($_POST["register_email"])) echo ' value="'.$_POST["register_email"].'"'; ?> />
          <input class="input" type="password" name="register_password" value=""  placeholder="Password" />
          <div id="reg-sub"></div>
        </form>
        
        <script type="text/javascript">$( "#reg-sub" ).append( '<input type="submit" class="submit" value="Register" />' );</script>
      </div>
      <?php } else { ?>
        <div class="title">You are already signed.</div>
        <div><?php echo do_shortcode('[miniorange_social_login]'); ?></div>
      <?php } ?>
    </div>
  </div>                           
  <div class="col-sm-3"></div>
</div>
