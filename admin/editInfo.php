<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin khách hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/main.css">
    <link rel="icon" href="../imgs/icon.jfif" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<?php
include "../config/dbconnection.php";
firstStep(); ?>

<body>
    <div class='clientsDivz'>
        <form id='formClients' action="process.php?action=editInfo" method="POST">
            <?php $sql = "SELECT * FROM KHACHHANG WHERE MSKH='" . $_SESSION["iduser"] . "'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

            ?>
            <div class='form-row'>
                <div class='form-group col-md-6'>
                    <label for='phoneInput' id='labelPhone'>Số điện thoại</label>
                    <input type='number' class='form-control' id='phoneInput' min='0' value='<?= $row["SoDienThoai"] ?>' disabled>
                    <input type="button" onclick="enable('phoneInput')" class="btn btn-danger" value="Sửa" />
                </div>
                <div class='form-group col-md-6'>
                    <label for='phoneInput' id='labelPhone'>Mật khẩu</label>
                    <input type='text' class='form-control' id='passInput' value='<?= $row["Pass"] ?>' disabled>
                    <input type="button" onclick="enable('passInput')" class="btn btn-danger" value="Sửa" />
                </div>
            </div>
            <div class='form-row'>
                <div class='form-group col-md-6'>
                    <label for='companyInput'>Tên công ty</label>
                    <input type='text' class='form-control' id='companyInput' value='<?= $row["TenCongTy"] ?>' disabled>
                    <input type="button" onclick="enable('companyInput')" class="btn btn-danger" value="Sửa" />
                </div>
                <div class='form-group col-md-6'>
                    <label for='faxInput'>Số FAX</label>
                    <input type='number' class='form-control' id='faxInput' min='0' value='<?= $row["SoFax"] ?>' disabled>
                    <input type="button" onclick="enable('faxInput')" class="btn btn-danger" value="Sửa" />
                </div>
            </div>
            <div class='form-row'>
                <div class='form-group col-md-6' id="address">
                    <label for='addressInput1' id='checkAdd'>Thêm địa chỉ mới</label>
                    <input type='text' class='form-control' id="addInput" disabled>
                    <input type="button" onclick="enable('addInput')" class="btn btn-danger" value="Sửa" />
                </div>

            </div>

            <input type='button' id='btnCreate' class='btn btn-primary' value='Hoàn Thành'></button>
        </form>
        <form action="../main.php">
            <button type="submit" class="btn btn-info" style="margin-top :20px;">Quay lại</button>
        </form>
    </div>

    <script>
        function enable(id) {
            $("#" + id).prop('disabled', false);
        }

        $("#btnCreate").on("click",function(){
            var sdt = $("#phoneInput").val();
            var pass = $("#passInput").val();
            var company = $("#companyInput").val();
            var fax = $("#faxInput").val();
            var address = $("#addInput").val();
            $.ajax({
                type: "POST",
                url: "process.php",
                data: {
                    action: "upClients",
                    sdt: sdt,
                    pass: pass,
                    company: company,
                    fax: fax,
                    address: address
                }
            }).done(function(response) {
                if(response=="1"){
                    alert("Thay đổi thành công");
                window.location="../main.php";}
                else alert(response);
            })
        })        
    </script>
</body>

</html>