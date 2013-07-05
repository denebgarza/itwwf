/*
  Asynchronously loads the Facebook javascript SDK and listens for
  login and logout events.
*/
window.fbAsyncInit = function() {
  FB.init({
    appId      : '340210976048840', // App ID
    channelUrl : '//localhost/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });
  
  FB.Event.subscribe('auth.login', function(response) {
    window.location.reload();
  });
  
  FB.Canvas.setSize({ width: 640, height: 480 });
};

// Load the SDK asynchronously
(function(d){
 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
 if (d.getElementById(id)) {return;}
 js = d.createElement('script'); js.id = id; js.async = true;
 js.src = "//connect.facebook.net/en_US/all.js";
 ref.parentNode.insertBefore(js, ref);
}(document));