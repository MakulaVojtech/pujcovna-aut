$(document).ready(function () {
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