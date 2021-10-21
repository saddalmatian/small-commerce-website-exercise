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
<?php
            include "config/dbconnection.php";
            firstStep();          
            if($_SESSION["role"]=="NV"){
                echo'<nav class="site-header sticky-top py-1">
                <div class="container d-flex flex-column flex-md-row justify-content-between">
                    <a class="py-2 d-none d-md-inline-block" id="home" href="#">Trang chủ</a>
                    <a class="py-2 d-none d-md-inline-block" id="products" href="#">Danh mục sản phẩm</a>
                    <a class="py-2 d-none d-md-inline-block" id="clients" href="#">Khách hàng</a>
                    <a class="py-2 d-none d-md-inline-block" id="carts" href="#">' . $_SESSION["user"] . '</a>
                </div>
            </nav>';}
            else if($_SESSION["role"]=="KH"){
                echo'<nav class="site-header sticky-top py-1">
                <div class="container d-flex flex-column flex-md-row justify-content-between">
                    <a class="py-2 d-none d-md-inline-block" id="home" href="#">Trang chủ</a>
                    <a class="py-2 d-none d-md-inline-block" id="products" href="#">Danh mục sản phẩm</a>
                    <a class="py-2 d-none d-md-inline-block" id="carts" href="#">Đơn hàng</a>';

                echo '<a class="py-2 d-none d-md-inline-block" href="#" id="personal">' . $_SESSION["user"] . '</a>
                </div>
            </nav>';
            }

?>
    <div id="content">
        <?php
        if (!isset($_SESSION["show"]))
            $_SESSION["show"] = "home";

        if ($_SESSION["show"] == "home") {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                $("#home").css({"color": "#fff"});
                $("#content").load("views/home.php");
            })
            setTimeout(() => {
                $("#footerDiv").load("views/footer.php");
            }, 1000);
            </script>
                  ';
        }
        if ($_SESSION["show"] == "products") {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                $("#products").css({"color": "#fff"});
                $("#content").load("views/products.php");
            })
            setTimeout(() => {
                $("#footerDiv").load("views/footer.php");
            }, 1000);
            </script>
                  ';
        }
        if ($_SESSION["show"] == "clients") {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                $("#clients").css({"color": "#fff"});
                $("#content").load("views/clients.php");
            })
            setTimeout(() => {
                $("#footerDiv").load("views/footer.php");
            }, 1000);
            </script>
                  ';
        }
        if ($_SESSION["show"] == "carts") {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                $("#carts").css({"color": "#fff"});
                $("#content").load("views/carts.php");
            })
            setTimeout(() => {
                $("#footerDiv").load("views/footer.php");
            }, 1000);
            </script>
                  ';
        }
        if ($_SESSION["show"] == "personal") {
            echo '<script type="text/javascript">
            $(document).ready(function() {
                $("#personal").css({"color": "#fff"});
                $("#content").load("views/personal.php");
            })
            setTimeout(() => {
                $("#footerDiv").load("views/footer.php");
            }, 1000);
            </script>
                  ';
        }
        ?>

    </div>

    <div id="footerDiv">

    </div>
</body>

<script type="text/javascript">
    $("#home").on('click', function() {
        $(document).ready(function() {
            $('#home').css({
                'color': '#fff'
            });
            $('#products').css({
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
            $('#personal').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $("#content").load('views/home.php');
        })
        setTimeout(() => {
            $("#footerDiv").load("views/footer.php");
        }, 1000);
    })
    $("#products").on('click', function() {
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
            $('#personal').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
        })
        setTimeout(() => {
            $("#footerDiv").load('views/footer.php');
        }, 1000);
    })
    $("#clients").on('click', function() {
        $(document).ready(function() {
            $("#content").load('views/clients.php');
            $('#clients').css({
                'color': '#fff'
            });
            $('#products').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#home').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#carts').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#personal').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
        })
        setTimeout(() => {
            $("#footerDiv").load('views/footer.php');
        }, 1000);
    })
    $("#carts").on('click', function() {
        $(document).ready(function() {
            $("#content").load('views/carts.php');
            $('#carts').css({
                'color': '#fff'
            });
            $('#products').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#clients').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#home').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#personal').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
        })
        setTimeout(() => {
            $("#footerDiv").load('views/footer.php');
        }, 1000);
    })
    $("#personal").on('click', function() {
        $(document).ready(function() {
            $("#content").load('views/personal.php');
            $('#personal').css({
                'color': '#fff'
            });
            $('#products').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#clients').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#home').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
            $('#carts').css({
                'color': '#999',
                'transition': 'ease-in-out color .15s'
            });
        })
        setTimeout(() => {
            $("#footerDiv").load('views/footer.php');
        }, 1000);
    })
</script>

</html>