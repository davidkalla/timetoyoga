

    <div class="search-form">
      <form action="<?php echo get_permalink(); ?>" method="get">
        <div class="label">Search for</div>
        <input class="input" type="text" name="q" placeholder="keyword" <?php if(isset($_GET["q"]) && $_GET["q"]!="") echo ' value="'.$_GET["q"].'"'; ?>/>
        <div class="label">in</div>
        <select name="in">
          <option value="all">All</option>
          <option value="name"<?php if(isset($_GET["in"]) && $_GET["in"]=="name") echo ' selected'; ?>>Name</option>
          <option value="location"<?php if(isset($_GET["in"]) && $_GET["in"]=="location") echo ' selected'; ?>>Location</option>
          <option value="type"<?php if(isset($_GET["in"]) && $_GET["in"]=="type") echo ' selected'; ?>>Yoga Type</option>
        </select>
        <input type="submit" class="btn" value="Go">
        <div class="clear"></div>   
      </form>
    </div>  
