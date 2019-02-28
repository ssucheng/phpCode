<?php
// 此页面用于用户点击编辑之后在点击更新操作
// 1.0链接数据库
$conn = mysqli_connect("127.0.0.1","root","root","baixiu");
// 2.0判断下数据库是否链接成功
if(!$conn){
    die("数据库链接失败");
}
// else{
//     echo "操作数据库成功";
// }
// 3.0接受前台传递过来的数据
// print_r($_POST);
// exit;
$id = $_POST["id"];
$email = $_POST["email"];
$slug = $_POST["slug"];
$nickname = $_POST["nickname"];
// print_r($slug,$email);
// exit;
// 4.0把sql语句用变量存储起来
$sql = "update users set email = '$email' ,slug = '$slug', nickname = '$nickname' where id = $id";
// 5.0操作数据库
$res = mysqli_query($conn,$sql);

// 6.0判断下操作数据库是否成功
if($res){
    $arr = array(
        "code" => 200,
        "msg" => "操作数据库成功"
        
    );
}else{
    $arr = array(
        "code" => 250,
        "msg" => "操作数据库失败"
    );
}
// 7.0将数据返回给前台
echo json_encode($arr);
?>