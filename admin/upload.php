<?php
include "../config/dbconnection.php";
firstStep();
if (!isset($_POST["nameProd"]))
    header("location:../main.php");
$target_dir = "../imgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo '<script type="text/javascript">
        alert("Đây không phải file hình ảnh");
        window.location.href="../main.php";
        </script>';
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo '<script type="text/javascript">
    alert("Hình ảnh đã tồn tại trong cơ sở dữ liệu");
    window.location.href="../main.php";
    </script>';
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo '<script type="text/javascript">
    alert("Kích thước file quá lớn");
    window.location.href="../main.php";
    </script>';
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo '<script type="text/javascript">
    alert("Chỉ upload hình ảnh");
    window.location.href="../main.php";
    </script>';
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $sql = "SELECT MaLoaiHang FROM LoaiHangHoa WHERE TenLoaiHang='".$_POST["cateProd"]."' ";

        $result = $conn->query($sql);
        $row=$result->fetch_assoc();
        $maloaihang=$row["MaLoaiHang"];
   
        $sql = "SELECT * FROM HANGHOA WHERE MaLoaiHang='" . $maloaihang . "';";
        $count = 1;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $count += 1;
            }     
        }
        $MSHH = $maloaihang.$count;

        $mahinh = basename($_FILES["fileToUpload"]["name"]);
        
        $tenhanghoa = $_POST["nameProd"];
        $quycach = $_POST["quycachProd"];
        $soluonghang = $_POST["countProd"];
        $gia = $_POST["priceProd"];
        $sql = "INSERT INTO HANGHOA VALUES('" . $MSHH . "','" . $tenhanghoa . "','" . $quycach . "','" . $gia . "','" . $soluonghang . "','" . $maloaihang . "');";
        echo $sql;
        if ($conn->query($sql)) {
            $sql1 = "INSERT INTO HINHHANGHOA VALUES('" . $mahinh . "','" . $mahinh . "','" . $MSHH . "');";
            if ($conn->query($sql1)) {
                echo '<script type="text/javascript">
                alert("Tạo sản phẩm mới thành công");
                window.location.href="../main.php";
                </script>';
                unset($_POST["nameProd"]);
            }
        }
    } else {
        echo '<script type="text/javascript">
        alert("Có lỗi");
        window.location.href="../main.php";
        </script>';
        unset($_POST["nameProd"]);
    }
}
