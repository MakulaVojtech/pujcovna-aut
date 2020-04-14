$(function () {
    let handler = "handlers/adminHandler.php";

    $(".deleteCar").click(function (e) {
        e.preventDefault();
        let id = $(this).attr("value");
        $.get(handler, {
            deleteCar: id
        }).done(function (data) {
            if (data == true) {
                location.reload();
            } else {
                $("#flashes").append(data);
            }
        });
    });

    $("#carFormModal form").submit(function (e) {
        e.preventDefault();
        var fd = new FormData();
        var file = $('#imageInput')[0].files[0];
        var name = $('#nameInput').val();
        var pricePerDay = $("#priceInput").val();
        var  carForm = $("#hiddenInput").val();
        fd.append('image',file);
        fd.append('name',name);
        fd.append("pricePerDay", pricePerDay);
        fd.append("carForm", carForm);
        $.ajax({
            url: handler,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
                if(data == true){
                    location.reload();
                }else{
                    $("#flashes").append(data);
                }
            },
        });
    });





    //modals
    //open new empty form
    $(".fa-plus").click(function (e) {
        e.preventDefault();
        let modalId = $(this).attr("href");
        $(modalId + " h2").html("Přidat vozidlo")
        $(modalId).removeClass("close");
        $("#modalOverlay").removeClass("close");
    });

    //open new update form
    $(".updateCar").click(function (e) {
        e.preventDefault();
        let modalId = $(this).attr("href");
        let carId = $(this).attr("value");
        $.getJSON("handlers/adminHandler.php", {
                carUpdateForm: carId
            },
            function (data) {
                $(modalId + " h2").html("Upravit vozidlo")
                $("#nameInput").val(data.name);
                $("#priceInput").val(data.pricePerDay);
                $("#hiddenInput").val("update");
                $(modalId).removeClass("close");
                $("#modalOverlay").removeClass("close");
            }
        );
    });

    //close modals
    function closeModals() {
        $(".modal input").val("");
        $(".modal #hiddenInput").val("insert");
        $(".modal input[type='submit']").val("Odeslat");
        $(".modal").addClass("close");
        $("#modalOverlay").addClass("close");
    }
    //by icon
    $(".fa-times").click(closeModals)
    //by overlay
    $(".modalOverlay").click(closeModals)
    //by esc button
    $(window).keydown(function (e) {
        if (e.key == "Escape") {
            closeModals();
        }
    });
    //modals end
});