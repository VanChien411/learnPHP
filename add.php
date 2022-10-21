<?php
require('header.php');
?>
<h3>NHẬP SÁCH</h3>
<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtTitle">Tựa sách</label>
        <input type="text" name="txtTitle" />
    </div>
    <div class="form-group">

        <label class="control-label col-sm-2" for="txtPubDate">Năm xuất bản</label>
        <input type="text" name="txtPubDate" />
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="Img">Hình sách</label>
        <input type="file" name="Img" />
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="Upload" value="Upload" class="btn btn-default" />
        </div>
    </div>
</form>
<?php // Xử Lý Upload
include "DbProcess.php";
use DB\DbProcess;

// Nếu người dùng click Upload
if (isset($_POST['Upload'], $_POST['txtTitle'], $_POST['txtPubDate'])) {
    $title = $_POST['txtTitle'];
    $year = $_POST['txtPubDate'];
    // Nếu người dùng có chọn file để upload
    if (isset($_FILES['Img'])) {
        // Nếu file upload không bị lỗi (thuộc tính error > 0)
        if ($_FILES['Img']['error'] > 0) {
            echo 'File Upload Bị Lỗi';
        } else {
            // Upload file
            move_uploaded_file($_FILES['Img']['tmp_name'],
                './Images/' . $_FILES['Img']['name']);
            $sql = "INSERT into tb_book (`Title`,`PubDate`,`Image`) VALUES
('" . $title . "','" . $year . "','" . $_FILES['Img']['name'] . "')";
            DbProcess::Insert($sql);
        }
    } else {
        echo 'please choose a file';
    }
}
?>
<?php
require('footer.php');

?>