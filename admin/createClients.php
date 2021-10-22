<?php
include "../config/dbconnection.php";
firstStep();


if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]))
    header("location:../main.php");
else 
    echo "<div class='clientsDiv'>
    <form id='formClients'>
        <div class='form-row'>

            <div class='form-group col-md-6'>
                <label for='htInput' id='labelHt'>Họ và tên</label>
                <input type='text' class='form-control' id='htInput' placeholder='Ví dụ: Trần Thị Cúc Loan' required>
            </div>
            <div class='form-group col-md-6'>
                <label for='phoneInput' id='labelPhone'>Số điện thoại</label>
                <input type='number' class='form-control' id='phoneInput' min='0' placeholder='Ví dụ: 0914764104' required>
            </div>
            <div class='form-group col-md-6'>
            <label for='phoneInput' id='labelPhone'>Mật khẩu</label>
            <input type='text' class='form-control' id='passInput' required>
        </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='companyInput'>Tên công ty</label>
                <input type='text' class='form-control' id='companyInput' placeholder='Ví dụ: Công ty cổ phần SunLight'>
            </div>
            <div class='form-group col-md-6'>
                <label for='faxInput'>Số FAX</label>
                <input type='number' class='form-control' id='faxInput' min='0' placeholder='Ví dụ: 24567889'>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='addressInput1' id='checkAdd'>Địa chỉ 1</label>
                <input type='text' class='form-control' id='addressInput1'>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='addressInput2'>Địa chỉ 2</label>
                <input type='text' class='form-control' id='addressInput2'>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='addressInput3'>Địa chỉ 3</label>
                <input type='text' class='form-control' id='addressInput3'>
            </div>
        </div>

        <input type='button' id='btnCreate' class='btn btn-primary' value='Hoàn Thành'></button>
    </form>
</div>";


echo '<script>
$("#btnCreate").on("click", function() {
    var name = $("#htInput").val();
    var company = $("#companyInput").val();
    var phone = $("#phoneInput").val();
    var FAX = $("#faxInput").val();
    var add1 = $("#addressInput1").val();
    var pass=$("#passInput").val()

    $.ajax({
        type: "POST",
        url: "admin/process.php",
        data: {
            action: "clientAdd",
            name: name,
            company: company,
            phone: phone,
            FAX: FAX,
            add1: add1,
            pass:pass
        }
    }).done(function(response) {
        if (response == "1") {
            $("#labelHt").html("Họ và tên (***********)");
            $("#labelHt").css({
                "color": "red"
            })
            $("#labelPhone").html("Số điện thoại (***********)");
            $("#labelPhone").css({
                "color": "red"
            });
        }
        if (response == "2") {
            $("#labelHt").html("Họ và tên (***********)");
            $("#labelHt").css({
                "color": "red"
            })
            $("#labelPhone").html("Số điện thoại");
            $("#labelPhone").css({
                "color": "black"
            });
        }
        if (response == "3") {
            $("#labelPhone").html("Số điện thoại (***********)");
            $("#labelPhone").css({
                "color": "red"
            });
            $("#labelHt").html("Họ và tên");
            $("#labelHt").css({
                "color": "black"
            });
        }
        if (response == "4") {
            $("#checkAdd").html("Địa chỉ 1 (Nhập ít nhất 1 địa chỉ)");
            $("#checkAdd").css({
                "color": "red"
            });
            $("#labelHt").html("Họ và tên");
            $("#labelHt").css({
                "color": "black"
            });
            $("#labelPhone").html("Số điện thoại");
            $("#labelPhone").css({
                "color": "black"
            });
        }
        if (response == "5") {
            $("#checkAdd").html("Địa chỉ 1");
            $("#checkAdd").css({
                "color": "black"
            });
            $("#labelHt").html("Họ và tên");
            $("#labelHt").css({
                "color": "black"
            });
            $("#labelPhone").html("Số điện thoại");
            $("#labelPhone").css({
                "color": "black"
            });
            alert("Tạo khách hàng mới thành công !");
            $("#content").load("views/clients.php");
        }
        if (response == "6") {
            $("#checkAdd").html("Địa chỉ 1");
            $("#checkAdd").css({
                "color": "black"
            });
            $("#labelHt").html("Họ và tên");
            $("#labelHt").css({
                "color": "black"
            });
            $("#labelPhone").html("Số điện thoại");
            $("#labelPhone").css({
                "color": "black"
            });
            alert("Số điện thoại này đã được đăng ký hoặc Số điện thoại quá dài");
        }
        if (response == "7") {
            $("#checkAdd").html("Địa chỉ 1");
            $("#checkAdd").css({
                "color": "black"
            });
            $("#labelHt").html("Họ và tên");
            $("#labelHt").css({
                "color": "black"
            });
            $("#labelPhone").html("Số điện thoại");
            $("#labelPhone").css({
                "color": "black"
            });
            alert("Lỗi thêm địa chỉ".response);
        }
    })


})
</script>';
