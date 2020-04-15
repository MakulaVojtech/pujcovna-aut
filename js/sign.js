$(document).ready(function () {
/*
    const emailREGEX = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;
    $("#emailInput").keyDown(function(e){
        e.preventDefault();
        let email = $(this).val();
        if(!email.match(emailREGEX)){
            $("#flashes").html("<p class='error'>Zadejte prosím platný email.</p>");
        }
    });

    const  passREGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    $("#passwordInput").keyDown(function(e){
        e.preventDefault();
        let email = $(this).val();
        if(!email.match(emailREGEX)){
            $("#flashes").html("<p class='error'>Heslo musí obsahovat alespoň osm znaků z toho jedno VELKÉ a jedno malé písmeno a jedno číslo</p>");
        }
    });
*/
    $("#signUpForm").submit(function (e) {
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post("handlers/signHandler.php", formValues,
            function (data) {
                if (data == true) {
                    $(location).attr("href", "index.php");
                } else {
                    $("#flashes").append(data);
                }
            });
    });

    $("#signInForm").submit(function (e) {
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post("handlers/signHandler.php", formValues,
            function (data) {
                if (data == true) {
                    $(location).attr("href", "index.php");
                } else {
                    $("#flashes").append(data);
                }
            });
    });

    $("#signOut").click(function (e) {
        e.preventDefault();
        $.post("handlers/signHandler.php", "signOut=true",
            function (data) {
                $(location).attr("href", "index.php");
            });
    });
});