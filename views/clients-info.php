<!DOCTYPE html>
<?php
// if(!isset($_SESSION["user"]))
//     exit;
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin khách hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


<body>
    <nav class="site-header sticky-top py-1">
        <div class="container d-flex flex-column flex-md-row justify-content-between">
            <a class="py-2 d-none d-md-inline-block" id="home" href="#">Trang chủ</a>
            <a class="py-2 d-none d-md-inline-block" id="products" href="#">Danh mục sản phẩm</a>
            <a class="py-2 d-none d-md-inline-block" id="clients" href="#">Khách hàng</a>
            <a class="py-2 d-none d-md-inline-block" id="carts" href="#">Đơn hàng</a>
            <?php
            include "../config/dbconnection.php";
            firstStep();
            echo '<a class="py-2 d-none d-md-inline-block" href="#">' . $_SESSION["user"] . '</a>'
            ?>
        </div>
    </nav>
    <?php
    $sql = "SELECT * FROM khachhang WHERE MSKH=\"" . $_GET["id"] . "\";";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        if ($row["TenCongTy"] == NULL)
            $company = "Không có";
        else $company = $row["TenCongTy"];

        if ($row["SoFax"] == NULL)
            $FAX = "Không có";
        else $FAX = $row["SoFax"];

        echo '<div class="clients-info">
        <div class="clientsImg">
            <img class="climg" src="../imgs/profile.jpg" alt="">
        </div>
        <div class="clientsInfo">
            <hr>
            <p><h3 style="font-weight: bolder;">Tải khoản khách hàng:</h3>
            <h5>' . $row["HoTenKH"] . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Tên công ty:</h3>
            <h5>' . $company . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Số điện thoại:</h3>
            <h5>' . $row["SoDienThoai"] . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Số FAX:</h3>
            <h5>' . $FAX . '</h5>
            <hr>
            <p><h3 style="font-weight: bolder;">Địa chỉ:</h3>';
        $sql2 = "SELECT * FROM DiaChiKH WHERE MSKH=\"" . $_GET["id"] . "\";";
        $result2 = $conn->query($sql2);
        if ($result2->num_rows > 0) {
            $count = 1;
            while ($row = $result2->fetch_assoc()) {
                echo '<h6>Địa chỉ ' . $count . ': ' . $row["DiaChi"] . '';
                $count += 1;
            }
        }
        echo '<hr>
        </div>
    </div>';
    } else {
        echo "<h1 style=\"text-align:center\";>Không tồn tại khách hàng này</h1>";
    }
    ?>

    <div id="footerDiv"></div>

</body>



<script type="text/javascript">
    $("#footerDiv").load("footer.php");
    $(document).ready(function() {
        $("#content").load('views/products.php');
        $('#clients').css({
            'color': '#fff'
        });
        $('#home').css({
            'color': '#999',
            'transition': 'ease-in-out color .15s'
        });
        $('#products').css({
            'color': '#999',
            'transition': 'ease-in-out color .15s'
        });
        $('#carts').css({
            'color': '#999',
            'transition': 'ease-in-out color .15s'
        });
    })
    $("#home").on('click', function() {
        $.ajax({
            type: "POST",
            url: "home.php",
            data: {
                outsource: "outside"
            }
        })
        window.location.href = "../main.php";
    })
    $("#products").on('click', function() {
        $.ajax({
            type: "POST",
            url: "products.php",
            data: {
                outsource: "outside"
            }
        })
        window.location.href = "../main.php";
    })
    $("#clients").on('click', function() {
        $.ajax({
            type: "POST",
            url: "clients.php",
            data: {
                outsource: "outside"
            }
        })
        window.location.href = "../main.php";
    })
    $("#carts").on('click', function() {
        $.ajax({
            type: "POST",
            url: "carts.php",
            data: {
                outsource: "outside"
            }
        })
        window.location.href = "../main.php";
    })

</script>

</html>