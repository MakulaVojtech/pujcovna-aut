$(function () {
    $(".navDiv").hover(function () {
        console.log(1)
            $("#administraceDiv").slideDown();
        },
        function(){
            $("#administraceDiv").slideUp();
        }
    );
   
});
