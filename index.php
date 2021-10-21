<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="https://freenice.net/wp-content/uploads/2021/03/hinh-anh-cuon-sach-mo-dep.jpg">

  <title>Đăng nhập</title>
  <!-- CSS Bootstrap -->
  <link href="asset/css/bootstrap.min.css" rel="stylesheet">
  <link href="asset/css/index.css" rel="stylesheet">
  <!-- Jquery -->

</head>
<?php
if(session_id() === '') session_start();
if(isset($_SESSION["user"]))
  header("Location: main.php");
?>

<body class="text-center" onload="check()">
  <form class="form-signin" method="POST" action="config/login.php">
    <img class="mb-4" src="https://cafeandbooks.files.wordpress.com/2015/07/dscn4570.jpg" alt="" width="72" height="72">

    <h1 class="h3 mb-3 font-weight-normal">Đăng nhập</h1>
    <input type="text" name="inputName" class="form-control" placeholder="Họ và tên" autofocus="" oninvalid="this.setCustomValidity('Vui lòng nhập tên người dùng')" oninput="this.setCustomValidity('')" required/>

    <input type="password" name="inputPassword" class="form-control" placeholder="Mật khẩu" required oninvalid="this.setCustomValidity('Vui lòng nhập mật khẩu')" oninput="this.setCustomValidity('')" />

    <div id="error" style="color: red;"></div>
    <div id="ok" style="color: green"></div>
    
    <button class="btn btn-lg btn-primary btn-block" id="btn_login" type="submit">Đăng nhập</button>
    <div class="regisDiv border" style="font-weight:bolder;width:100px;margin:auto;margin-top: 20px;padding:10px">
    <a href="register.php" >Đăng ký</a>
    </div>
  </form>

</body>
<script type="text/javascript">
  function check() {
    var href = window.location.href;
    var truehref = href.split("?")[1];
    if (truehref == "id=3") {
      $("#error").html("Không tồn tại tài khoản");
    }
    if (truehref == "id=2") {
      $("#error").html("Sai mật khẩu"); 
    }

  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</html>