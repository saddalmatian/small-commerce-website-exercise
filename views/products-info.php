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
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../asset/css/main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


<body>
    <?php
    include "../config/dbconnection.php";
    firstStep();
    if ($_SESSION["role"] == "NV") {
        echo '<nav class="site-header sticky-top py-1">
                <div class="container d-flex flex-column flex-md-row justify-content-between">
                    <a class="py-2 d-none d-md-inline-block" id="home" href="#">Trang chủ</a>
                    <a class="py-2 d-none d-md-inline-block" id="products" href="#">Danh mục sản phẩm</a>
                    <a class="py-2 d-none d-md-inline-block" id="clients" href="#">Khách hàng</a>';
        echo '<a class="py-2 d-none d-md-inline-block" id="carts" href="#">' . $_SESSION["user"] . '</a>
                </div>
            </nav>';
    }
    if ($_SESSION["role"] == "KH") {
        echo '<nav class="site-header sticky-top py-1">
                <div class="container d-flex flex-column flex-md-row justify-content-between">
                    <a class="py-2 d-none d-md-inline-block" id="home" href="#">Trang chủ</a>
                    <a class="py-2 d-none d-md-inline-block" id="products" href="#">Danh mục sản phẩm</a>
                    <a class="py-2 d-none d-md-inline-block" id="carts" href="#">Đơn hàng</a>';
        echo '<a class="py-2 d-none d-md-inline-block" id="personal" href="#">' . $_SESSION["user"] . '</a>
                </div>
            </nav>';
    }

    ?>
    <?php
    if (!isset($_GET["id"]))
        header("location:../main.php");

    if ($_SESSION["role"] == "KH") {
        $sql = "SELECT * FROM HANGHOA,HINHHANGHOA,LOAIHANGHOA WHERE HANGHOA.MSHH=HINHHANGHOA.MSHH and HANGHOA.MALOAIHANG=LOAIHANGHOA.MALOAIHANG and HANGHOA.MSHH=\"" . $_GET["id"] . "\";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo
            '<div class="product-info">
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-6"><img class="card-img" src="../imgs/' . $row["mahinh"] . '" /></div>
                    <div class="col-md-6">
                        <div class="small mb-1">ID: ' . $row["MSHH"] . '</div>
                        <h1 class="display-5 fw-bolder">' . $row["TenHH"] . '</h1>
                        <div class="fs-5 mb-5">
                            <span class="text-decoration-line-through">' . $row["Gia"] . 'Đ</span>
                        </div>
                        <p class="lead">' . $row["QuyCach"] . '</p>
                        <div class="d-flex">
                            <input onclick="addToCart(\'' . $row["MSHH"] . '\')" class="btn btn-outline-dark flex-shrink-0" type="button" value="Thêm vào giỏ hàng" />
                                <i class="bi-cart-fill me-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>';
        } else {
            echo "<h1 style=\"text-align:center\";>Không tồn tại mặt hàng này</h1>";
        }
    }

    if ($_SESSION["role"] == "NV") {
        $sql = "SELECT * FROM HANGHOA,HINHHANGHOA,LOAIHANGHOA WHERE HANGHOA.MSHH=HINHHANGHOA.MSHH and HANGHOA.MALOAIHANG=LOAIHANGHOA.MALOAIHANG and HANGHOA.MSHH=\"" . $_GET["id"] . "\";";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo
            '<div class="product-info">
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img" src="../imgs/' . $row["mahinh"] . '" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">ID: ' . $row["MSHH"] . '</div>
                    <input class="display-5 fw-bolder" id="ten'.$row["MSHH"].'" value="'.$row["TenHH"].'" style="width:100%;"/>
                    <div class="fs-5 mb-5">
                    <input class="display-5 fw-bolder" id="gia'.$row["MSHH"].'" value="'.$row["Gia"].'";"/>Đ
                    </div>
                    <textarea id="qc'.$row["MSHH"].'" rows="5" cols="60"/>
                    '.$row["QuyCach"].'
                    </textarea>
                    <div class="d-flex">
                            <input class="btn btn-danger id="btnDel" onclick="delProd(\''.$row["MSHH"].'\')" flex-shrink-0" type="button" value="Xóa sản phẩm" />
                            <input class="btn btn-success id="btnUp" onclick="upProd(\''.$row["MSHH"].'\')" flex-shrink-0" type="button" value="Sửa sản phẩm" />
                            </div>
                </div>
            </div>
        </div>
    </section>
</div>';
        }
    }
    ?>
    <div id="footerDiv"></div>
</body>
<script type="text/javascript">
    function delProd(productID) {
        $.ajax({
            type: "POST",
            url: "../admin/process.php",
            data: {
                action: "delProd",
                productID: productID
            }
        }).done(function(response) {
            if (response == "1"){
                alert("Xóa thành công");
            window.location="../main.php";
            }
            if (response == "2"){
                alert("Có lỗi trong khi xóa");
            window.location="../main.php";
            }
        })
    }

    function upProd(productID) {
        var name=$("#ten"+productID).val();
        var price=$('#gia'+productID).val();
        var qualify=$('#qc'+productID).val();
        $.ajax({
            type: "POST",
            url: "../admin/process.php",
            data: {
                action: "upProd",
                productID: productID,
                name:name,
                price:price,
                qualify:qualify
            }
        }).done(function(response) {
            if (response == "1"){
                alert("Sửa thành công");
            window.location="../main.php";
            }
            if (response == "2"){
                alert("Có lỗi trong khi sửa");
            window.location="../main.php";
            }
        })
    }


    $("#footerDiv").load("footer.php");
    $(document).ready(function() {
        $("#content").load('views/products.php');
        $('#products').css({
            'color': '#fff'
        });
        $('#home').css({
            'color': '#999',
            'transition': 'ease-in-out color .15s'
        });
        $('#clients').css({
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