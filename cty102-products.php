<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Công ty 102</title>
	<!-- Bootstrap -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/cty102products.css" rel="stylesheet" type="text/css">
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


	<!--CONTENT-->
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-12 col-md-12">
				<div class="row" id="filtername">

					<?php
					$sql = "SELECT TenHH,Gia,MaHinh,hanghoa.MSHH from hanghoa,hinhhanghoa where hanghoa.MSHH=hinhhanghoa.MSHH";
					$result = $conn->query($sql);


					if ($result->num_rows > 0) {
						// Load dữ liệu lên website
						while ($row = $result->fetch_assoc()) {
							echo '<div class="col-lg-3
							col-md-3">

							<a href="cty102-info.php?id=' . $row["MSHH"] . '">
							
							<img src="imgs/' . $row["MaHinh"] . '.jpg" class="img-responsive" style="width:auto; height:auto">
							</a>
				<ul>
					<li><a href="tiki-info.php?id=' . $row["MSHH"] . '">' . $row["TenHH"] . '</a></li>
					<li>' . $row["Gia"] . '</a></li>
				</ul>
			</div>';
						}
					} else {
						echo "0 results";
					}
					$conn->close();
					?>

					<!--SanPham-->

				</div>
			</div>

		</div>
	</div>


	<!-----FOOOTER----->
	<div class="container-fluid">
		<hr>
		<div class="container">
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