$(document).ready(function() {

    $("#all").addClass("portfolio-active");

    $(".governments-org-list").hide();
    $(".banks-list").hide();
    $(".hospitals-list").hide();
    $(".schools-list").hide();
    $(".municipality-list").hide();
    $(".hotels-list").hide();
    

    $("#test").css("background-color", "#2980b9");
    
 
    $('#all').click(function(){

        $("#all").addClass("portfolio-active");
        $("#government").removeClass("portfolio-active");
        $("#bank-finance").removeClass("portfolio-active");
        $("#hospitals").removeClass("portfolio-active");
        $("#schools").removeClass("portfolio-active");
        $("#municipality").removeClass("portfolio-active");
        $("#hotels").removeClass("portfolio-active");

        $(".all-list").show();
        $(".governments-org-list").hide();
        $(".banks-list").hide();
        $(".hospitals-list").hide();
        $(".schools-list").hide();
        $(".municipality-list").hide();
        $(".hotels-list").hide();

    //  $("#test").css("background-color", "#2980b9");
    //  $(".personal-information").css("background-color", "coral");
    //  $(".work-info").show();
    //  $(".personal-details").hide();
 });
 $('#government').click(function(){
    $("#government").addClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").removeClass("portfolio-active");
    $("#hospitals").removeClass("portfolio-active");
    $("#schools").removeClass("portfolio-active");
    $("#municipality").removeClass("portfolio-active");
    $("#hotels").removeClass("portfolio-active");
    
    $(".all-list").hide();
    $(".governments-org-list").show();
    $(".banks-list").hide();
    $(".hospitals-list").hide();
    $(".schools-list").hide();
    $(".municipality-list").hide();
    $(".hotels-list").hide();
 });

 $('#bank-finance').click(function(){

    $("#government").removeClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").addClass("portfolio-active");
    $("#hospitals").removeClass("portfolio-active");
    $("#schools").removeClass("portfolio-active");
    $("#municipality").removeClass("portfolio-active");
    $("#hotels").removeClass("portfolio-active");

    $(".all-list").hide();
    $(".governments-org-list").hide();
    $(".banks-list").show();
    $(".hospitals-list").hide();
    $(".schools-list").hide();
    $(".municipality-list").hide();
    $(".hotels-list").hide();
 });
 $('#hospitals').click(function(){

    $("#government").removeClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").removeClass("portfolio-active");
    $("#hospitals").addClass("portfolio-active");
    $("#schools").removeClass("portfolio-active");
    $("#municipality").removeClass("portfolio-active");
    $("#hotels").removeClass("portfolio-active");

    $(".all-list").hide();
    $(".governments-org-list").hide();
    $(".banks-list").hide();
    $(".hospitals-list").show();
    $(".schools-list").hide();
    $(".municipality-list").hide();
    $(".hotels-list").hide();
 });

 $('#schools').click(function(){

    $("#government").removeClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").removeClass("portfolio-active");
    $("#hospitals").removeClass("portfolio-active");
    $("#schools").addClass("portfolio-active");
    $("#municipality").removeClass("portfolio-active");
    $("#hotels").removeClass("portfolio-active");

    $(".all-list").hide();
    $(".governments-org-list").hide();
    $(".banks-list").hide();
    $(".hospitals-list").hide();
    $(".schools-list").show();
    $(".municipality-list").hide();
    $(".hotels-list").hide();
 });
 $('#municipality').click(function(){

    $("#government").removeClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").removeClass("portfolio-active");
    $("#hospitals").removeClass("portfolio-active");
    $("#schools").removeClass("portfolio-active");
    $("#municipality").addClass("portfolio-active");
    $("#hotels").removeClass("portfolio-active");

    $(".all-list").hide();
    $(".governments-org-list").hide();
    $(".banks-list").hide();
    $(".hospitals-list").hide();
    $(".schools-list").hide();
    $(".municipality-list").show();
    $(".hotels-list").hide();
 });
 $('#hotels').click(function(){

    $("#government").removeClass("portfolio-active");
    $("#all").removeClass("portfolio-active");
    $("#bank-finance").removeClass("portfolio-active");
    $("#hospitals").removeClass("portfolio-active");
    $("#schools").removeClass("portfolio-active");
    $("#municipality").removeClass("portfolio-active");
    $("#hotels").addClass("portfolio-active");

    $(".all-list").hide();
    $(".governments-org-list").hide();
    $(".banks-list").hide();
    $(".hospitals-list").hide();
    $(".schools-list").hide();
    $(".municipality-list").hide();
    $(".hotels-list").show();
 });

});