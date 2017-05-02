<?php
if(bp_current_component()=='events' && bp_current_action()=='create'){ wp_deregister_script('googlemaps'); acf_form_head(); }

if(isset($_POST["user"]) && isset($_POST["password"])){
  $user = get_user_by('login', $_POST["user"]);
  if(!$user) $user = get_user_by('email', $_POST["user"]);    
  if ($user && wp_check_password($_POST["password"], $user->data->user_pass, $user->ID)){
    wp_login($_POST["user"],$_POST["password"]);
    wp_set_current_user($user->ID, $user->user_login );
    wp_set_auth_cookie($user->ID); 
    header("Location: ".home_url());  
  }
  else
    $login_error="Wrong username or password.";
}
?>
<?php get_template_part('templates/head'); ?>        
<body <?php body_class(); ?>>
  <div id="site">

  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'roots'); ?>
    </div>
  <![endif]-->

  <?php
    do_action('get_header');
    // Use Bootstrap's navbar if enabled in config.php
    if (current_theme_supports('bootstrap-top-navbar')) {
      get_template_part('templates/header-top-navbar');
    } else {
      get_template_part('templates/header');
    }
  ?>

  <div id="main">
    <div class="container">
      <?php include roots_template_path(); ?>
    </div>
  </div>

  <div id="site-footer">
    <?php get_template_part('templates/footer'); ?>
  </div>
  
  <?php 
  if(get_current_user_id()!=0 && !isset($_COOKIE["login_user"])){
    $user_info = get_userdata(get_current_user_id());
                                                         ?>
    <script type="text/javascript">
      setCookie("login_user", 1, 7);
      
      var email="<?php echo $user_info->user_email; ?>"; 
      
      dataLayer.push({
        'identify': email
      });
      
      /*var leady = leady || [];
      _leady.push(['identify', email]);  */
      
      var leady = leady || [];
      _leady.push(['identify', 'novak@example.com']);
      
    </script>
    <?php
  }                                                             
  elseif(get_current_user_id()==0 && isset($_COOKIE["login_user"])){ ?>
    <script type="text/javascript">
      setCookie("login_user", "", -7);
    </script>
  <?php } ?>
  </div>
</body>
</html>
