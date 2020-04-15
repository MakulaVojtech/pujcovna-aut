$(document).ready(function () {

 
    const handler = "handlers/profileHandler.php";
    
    $("#password").submit(function (e) {
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post(handler, formValues,
            function (data) {
                $("#flashes").append(data);
            });
    });

    $("#email").change(function (e) { 
        e.preventDefault();
        let formValues = $(this).serialize();
        $.post(handler, formValues,
            function (data) {
                $("#flashes").append(data);
            });
    });
});