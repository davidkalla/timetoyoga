function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x === c_name) {
            return unescape(y);
        }
    }
}

function resizeBanners(){
  width=$('.slideshow').width();
  height= width/1200*340;
  $('.slideshow').css('height',height+'px');
}

$(document).ready(function(){
  $('.showMenu').click(function() {
    if($(this).hasClass('active')){
      $(this).removeClass('active');
      $("#menu-main .top-menu").slideToggle(700);
    }
    else{
      $(this).addClass('active');
      $("#menu-main .top-menu").slideToggle(700);
    }
  });
});

function retreatsColumn(){
  if($('body').width()<976){
    $(".retreats-column").append($(".retreats-column-content").html());
    $(".retreats-column-content").html('');
    
    $(".main-informations-top").append($(".main-informations").html());
    $(".main-informations").html('');
  }
  else{
    $(".retreats-column-content").append($(".retreats-column").html());
    $(".retreats-column").html('');
    
    $(".main-informations").append($(".main-informations-top").html());
    $(".main-informations-top").html('');
  }
}


/* Resize Youtube Videos */

// Find all YouTube videos
var $allVideos = $("iframe[src^='//www.youtube.com']"),

    // The element that is fluid width
    $fluidEl = $("body");

// Figure out and save aspect ratio for each video
$allVideos.each(function() {

  $(this)
    .data('aspectRatio', this.height / this.width)

    // and remove the hard coded width/height
    .removeAttr('height')
    .removeAttr('width');

});

// When the window is resized
$(window).resize(function() {

  var newWidth = $fluidEl.width();

  // Resize all videos according to their own aspect ratio
  $allVideos.each(function() {

    var $el = $(this);
    $el
      .width(newWidth)
      .height(newWidth * $el.data('aspectRatio'));

  });

// Kick off one resize to fix all videos on page load
}).resize();

function resizeFooter(){
  height=$('#site-footer').innerHeight();
  $('#site').css('padding-bottom',height+'px');
}

$(document).ready(function(){
  resizeFooter();
});

$(window).resize(function() {
  resizeFooter();
});