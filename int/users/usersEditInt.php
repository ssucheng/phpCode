<?php
// 这里是编辑用户的操作
// 1. 接受前台传过来的id
$id = $_GET["id"];
// echo $id;
// exit;
// 2.链接数据库
$conn = mysqli_connect("127.0.0.1","root","root","baixiu");
// 3.判断数据库链接情况
if(!$conn){
    die("数据库链接失败");
}
// 4.编写sql语句
$sql = "select * from users where id =$id";
// 5.操作数据库
// $res = mysqli_query($conn,$sql);
$res = mysqli_query($conn,$sql);
// print_r ($res);
// exit;
// 6.将查询到数据 存在数组中
$data = mysqli_fetch_assoc($res);
// 7.判断下结果
if($res){
    $arr = array(
        "code" => 200,
        "msg" => "操作成功",
        "data"=>$data
       
    );
}else{
    $arr = array(
        "code" => 250,
        "msg" => "操作失败",

    );
}
echo json_encode($arr);

?>