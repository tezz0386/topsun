$(document).ready(function() {
  
//    $(".personal-details").hide();
   $(".work-info").show();
   $("#test").css("background-color", "#2980b9");
   

   $('#test').click(function(){
    $("#test").css("background-color", "#2980b9");
    $(".personal-information").css("background-color", "coral");
    $(".work-info").show();
    $(".personal-details").hide();
});
   $(".personal-information").click( function() {
    $(".personal-information").css("background-color", "#2980b9");
    $("#test").css("background-color", "coral");
    $(".work-info").hide();
    $(".personal-details").show();
    // $('.overlay').hide();
    console.log('hello')
   });

   $('#test1').click(function(){
    $("#test").css("background-color", "#2980b9");
    $(".personal-information").css("background-color", "coral");
    $(".work-info").show();
    $(".personal-details").hide();
});
 
});

