<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng Sách Tân Hiệp</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="asset/css/main.css">
    <link rel="icon" href="imgs/icon.jfif" sizes="16x16">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


<body>
    <div class='clientsDivz'>
    <form id='formClients' action="admin/fastReg.php" method="POST">
        <div class='form-row'>

            <div class='form-group col-md-6'>
                <label for='htInput' id='labelHt'>Họ và tên</label>
                <input type='text' name="name" class='form-control' id='htInput' placeholder='Ví dụ: Trần Thị Cúc Loan' required oninvalid="this.setCustomValidity('Vui lòng nhập tên người dùng')" oninput="this.setCustomValidity('')">
            </div>
            <div class='form-group col-md-6'>
                <label for='phoneInput' id='labelPhone'>Số điện thoại</label>
                <input type='number' name="phone" class='form-control' id='phoneInput' min='0' placeholder='Ví dụ: 0914764104' oninvalid="this.setCustomValidity('Vui lòng nhập số điện thoại')" oninput="this.setCustomValidity('')" required>
            </div>
            <div class='form-group col-md-6'>
                <label for='phoneInput' id='labelPhone'>Mật khẩu</label>
                <input type='number' name="pass" class='form-control' id='pasInput' min='0' placeholder='' oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu')" oninput="this.setCustomValidity('')" required>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='companyInput'>Tên công ty</label>
                <input type='text' name="company" class='form-control' id='companyInput' placeholder='Ví dụ: Công ty cổ phần SunLight'>
            </div>
            <div class='form-group col-md-6'>
                <label for='faxInput'>Số FAX</label>
                <input type='number' name="FAX" class='form-control' id='faxInput' min='0' placeholder='Ví dụ: 24567889'>
            </div>
        </div>
        <div class='form-row'>
            <div class='form-group col-md-6'>
                <label for='addressInput1' id='checkAdd'>Địa chỉ 1</label>
                <input type='text' name="add1" class='form-control' id='addressInput1' required oninvalid="this.setCustomValidity('Vui lòng nhập địa chỉ')" oninput="this.setCustomValidity('')">
            </div>
        </div>


       <button type="submit" class="btn btn-success">Hoàn Thành</button>
       <input type="button" value="Trở về" class="btn btn-info">
       
    </form>
</div>
</script>
</body>
</html>

