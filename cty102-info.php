<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thông tin sản phẩm</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/cty102info.css" rel="stylesheet" type="text/css">
	<link href="css/fontawesome/css/all.css" type="text/css">
	<link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
	<?php
	include 'dbconnection.php';
	include 'header.php';
	generateHeader();
	?>

	<?php
	if (isset($_GET["id"])) {
		$sql = "select * from hanghoa,loaihanghoa,hinhhanghoa where hanghoa.MSHH=hinhhanghoa.MSHH and hanghoa.maloaihang = loaihanghoa.maloaihang and hanghoa.MSHH=\"" . $_GET["id"] . "\"";

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// Load dữ liệu lên website
			$row = $result->fetch_assoc();
			echo '<div class="container">
			<div class="row">
				<div class="col-lg-4
							 col-md-4
							 col-sm-12
							 col-xs-12 imgproduct">
					<img src="imgs/' . $row["mahinh"] . '.jpg" class="img-responsive">
					<p style="text-align: center;font-size: 18pt;">Số lượng còn lại: ' . $row["SoLuongHang"] . '</p>
				</div>
				<div class="col-lg-5
							  col-md-5
							  hidden-sm
							  hidden-xs infoproduct">
					<h2>Tên sản phẩm : ' . $row["TenHH"] . '</h2>		
					<h3>Thể loại : ' . $row["TenLoaiHang"] . '</h3>
					<h3><p id="p1"> Giá sản phẩm:</p>
					<p id="p2">' . $row["Gia"] . 'đ</p></h3>
			
					<hr>

				</div>
	
			</div>
	
		</div>';
		} else {
			echo "0 results";
		}
	} else {
		exit;
	}
	?>

	<!-----FOOOTER----->
	<div class="container-fluid">
		<hr>
		<div class="container" style="margin-top: 30%">
			<div class="row">
				<div class="col-lg-4
							col-md-4
							col-sm-6
							col-xs-6 footer1">
					<ul>
						<li><a href="">Hotline đặt hàng: 1800-6963</a></li>
						<li><a href="">Hotline: 1900-6035</a></li>
						<li><a href="">Các câu hỏi thường gặp</a></li>
						<li><a href="">Gửi yêu cầu hỗ trợ</a></li>
						<li><a href="">Hướng dẫn đặt hàng</a></li>
						<li><a href="">Phương thức vận chuyển</a></li>
						<li><a href="">Chính sách đổi trả</a></li>
						<li><a href="">Hướng dẫn mua trả góp</a></li>
						<li><a href="">Chính sách hàng nhập khẩu</a></li>
					</ul>

				</div>
				<div class="col-lg-4
							col-md-4
							col-sm-6
							col-xs-6
							footer1">
					<ul>
						<li><a href="">Tuyển Dụng</a></li>
						<li><a href="">Chính sách bảo mật thanh toán</a></li>
						<li><a href="">Chính sách bảo mật thông tin cá nhân</a></li>
						<li><a href="">Chính sách giải quyết khiếu nại</a></li>
						<li><a href="">Điều khoản sử dụng</a></li>
						<li><a href="">Hội Sách Online</a></li>
						<li><a href="">Bán hàng doanh nghiệp</a></li>
					</ul>
				</div>
				<div class="col-lg-4
							col-md-4
							col-sm-12
							col-xs-12 text-center">
					<a href="" class="iconpublic"><i class="fab fa-facebook"></i></a>
					<a href="" class="iconpublic"><i class="fab fa-instagram"></i></a>
					<a href="" class="iconpublic"><i class="fab fa-twitter"></i></a>
					<a href="" class="iconpublic"><i class="fas fa-envelope"></i></a>

				</div>
			</div>
		</div>
	</div>

</body>

</html>