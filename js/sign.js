$(document).ready(function () {
    $("#signUpForm").submit(function (e) {
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post("signHandler.php", formValues,
            function (data) {
                $("#flashes").html(data);
            });
    });

    $("#signInForm").submit(function (e) {
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post("signHandler.php", formValues,
            function (data) {
                $(location).attr("href", "index.php");
            });
    });

    $("#signOut").click(function (e) {
        e.preventDefault();
        $.post("signHandler.php", "signOut=true",
            function (data) {
                $(location).attr("href", "index.php");
            });
    });
});