
$(document).ready(function() {
    $('.readmore').css( "display", "none" )
});

$('#abtreadmore').click(function() {
    $('.readmore').css( "display", "block" );
    $( "#abtreadmore" ).hide();
});
$('#abtreadless').click(function() {
    $('.readmore').css( "display", "none" );
    $( "#abtreadmore" ).css( "display", "inline-block" );
});
