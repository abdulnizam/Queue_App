$(document).ready(function(){
$(".btn-group > .btn").focus(function(){
    $(this).addClass("active").siblings().removeClass("active");
});

});