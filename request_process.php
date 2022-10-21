<?php
include "DbProcess.php";
use DB\DbProcess;
if(isset($_REQUEST["table"]))
{
$str="";
$table = $_REQUEST["table"];
$sql ="select * from $table";
$result = DbProcess::GetData($sql);
if ($result)
{
    $str="<table class='table'><tr class='success'><th>Mã sách</th><th>Tựa 
    sách</th><th>Năm xuất bản</th><th>Hình</th><th></th></tr>";
    if(mysqli_num_rows ($result) > 0) 
    {
    $arr=array();
    $i=0;
    while ($row = mysqli_fetch_assoc ($result)) 
    {
    $str=$str."<tr class='info'>";
    $str=$str."<td>".$row['BookId']."</td>";
    $str=$str."<td>".$row['Title']."</td>";
    $str=$str."<td>".$row['PubDate']."</td>";
    $str=$str."<td>";
    $str=$str."<img class='img-rounded' src='Images/". $row['Image']."'>"
    ."</td>";
    $str=$str."<td><button id='". $row['BookId']."' class='btn btn-primary' 
    name='chkDel' id='chkDel' onclick='Delete(this.id)'>Xóa</a>" ."</td>"; 
    $str=$str."</tr>";
    } 
    $str = $str."</table>";
    }
    }
    echo $str ==="" ? "No date" : $str;
    }
    else if(isset($_REQUEST["book_id"]))
    {
    $result = "";
    $id = $_REQUEST["book_id"];
    $record = DbProcess::GetRecordById ("select * from tb_book where BookId = $id");
    $img = $record["Image"];
    if ($id !== "") {
    $result = DbProcess::DeleteRecord("delete from tb_book where BookId = $id");
    }
    if($result!="")
    {
    unlink("images/".$img);
    }
    echo $result ==="" ? "error!!!" : $result;
    }
    ?>