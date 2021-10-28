<?php
include "../config/dbconnection.php";
function UnsetAll()
{
    unset($_POST["name"]);
    unset($_POST["phone"]);
    unset($_POST["company"]);
    unset($_POST["FAX"]);
    unset($_POST["add1"]);
}
$sql = "SELECT MSKH FROM KHACHHANG WHERE MSKH='" . $_POST['account'] . "';";
$result = $conn->query($sql);
if ($result->num_rows > 0)
    echo "<script type='text/javascript'>
alert('Tên đăng nhập đã tồn tại');
window.location.replace('../register.php');
</script>;";
else {
    if (!isset($_POST["company"]))
        $_POST["company"] = 'null';
    else
        $_POST["company"] = "\"" . $_POST["company"] . "\"";

    if (!isset($_POST["FAX"]))
        $_POST["FAX"] = 'null';
    else
        $_POST["FAX"] = "\"" . $_POST["FAX"] . "\"";

    $sql = 'INSERT INTO KHACHHANG VALUES("' . $_POST["account"] . '","' . $_POST["name"] . '",' . $_POST["company"] . ',"' . $_POST["phone"] . '",' . $_POST["FAX"] . ',"' . $_POST["pass"] . '");';

    if ($conn->query($sql) === TRUE) {
        $addCount = 0;
        if ($_POST["add1"] != "")
            $addCount += 1;
        for ($i = 1; $i <= $addCount; $i++) {
            $sql1 = 'INSERT INTO DIACHIKH VALUES("' . $_POST["account"] . 'DC' . $i . '","' . $_POST["add" . $i . ""] . '","' . $_POST["account"] . '");';
            if ($conn->query($sql1) === FALSE) {
                echo $sql1;
                UnsetAll();
                return;
            }
        }
        echo "<script type='text/javascript'>
    alert('Đăng ký thành công');
    window.location.replace('../index.php');
</script>;";
    } else {
        UnsetAll();
        echo "<script type='text/javascript'>
    alert('Số điện thoại đã được đăng ký hoặc vượt độ dài cho phép (10-11 số)');
    window.location.replace('../register.php');
</script>;";
    }
}
