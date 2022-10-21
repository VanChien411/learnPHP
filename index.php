<?php
require("header.php");
?>
<script>
$(document).ready(function(){
GetAllBook();

});
function GetAllBook()
{
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) { 
$("#content").html(this.responseText);
}
};
xmlhttp.open("GET", "request_process.php?table=tb_book", true);
xmlhttp.send();
}
function Delete(value) {
var del = confirm('Xóa sản phẩm này?');
if(del)
{
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (this.readyState == 4 && this.status == 200) { 
GetAllBook();
}
};
xmlhttp.open("POST", "request_process.php?book_id=" + value, true);
xmlhttp.send();
}
}
</script>
<h3>DANH MỤC SÁCH</h3>
<div id="content"></div>
<?php
require("footer.php");
?>