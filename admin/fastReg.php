<?php
include "../config/dbconnection.php";
function UnsetAll()
{
    unset($_POST["name"]);
    unset($_POST["phone"]);
    unset($_POST["company"]);
    unset($_POST["FAX"]);
    unset($_POST["add1"]);
    unset($_POST["add2"]);
    unset($_POST["add3"]);
}
$sql = 'SELECT MSKH FROM KHACHHANG';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        $count += 1;
    }
    $MSKH = "KH" . $count;
}
if (!isset($_POST["company"]))
    $_POST["company"] = 'null';
else
    $_POST["company"] = "\"" . $_POST["company"] . "\"";

if (!isset($_POST["FAX"]))
    $_POST["FAX"] = 'null';
else
    $_POST["FAX"] = "\"" . $_POST["FAX"] . "\"";

$sql = 'INSERT INTO KHACHHANG VALUES("' . $MSKH . '","' . $_POST["name"] . '",' . $_POST["company"] . ',"' . $_POST["phone"] . '",' . $_POST["FAX"] . ');';

if ($conn->query($sql) === TRUE) {
    $addCount = 0;
    if ($_POST["add1"] != "")
        $addCount += 1;
    for ($i = 1; $i <= $addCount; $i++) {
        $sql1 = 'INSERT INTO DIACHIKH VALUES("' . $MSKH . 'DC' . $i . '","' . $_POST["add" . $i . ""] . '","' . $MSKH . '");';
        if ($conn->query($sql1) === FALSE) {
            echo 7;
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
    alert('Số điện thoại đã được đăng ký');
    window.location.replace('../register.php');
</script>;";

}


?>
