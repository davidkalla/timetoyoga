<?php if(get_current_user_id()!=0){ ?>

<div id="send-to-friends">
  <div class="container">
    <div class="title">Invite your favorite teacher!</div>
    <form action="#" onsubmit="return sendToFriends(this);">
      <div class="body">
        <input type="text" placeholder="Enter teacher's email" class="text" /><input type="submit" class="submit" value="Send" />
        <div class="clear"></div>
      </div>
    </form>
  </div> 
</div> 

<script type="text/javascript">
  var ajaxUrl = "<?php echo admin_url('admin-ajax.php', null); ?>"; 
  
  function sendToFriends(form){
    email=$('.text', form).val();
    if(isEmail(email)===true){
      $.post(ajaxUrl, {
        action:"sendToFriends_ajax",
        email: email
      }).success(function(posts){
        alert(posts);  
        
        dataLayer.push({
          'invitation': email
        });
        
        var leady = leady || [];
        leady.push(['invitation', email]);
      });  
    }
    else alert('Please enter a valid email address');
    return false;
  }  
  
  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
</script>     

<?php } ?> 
        