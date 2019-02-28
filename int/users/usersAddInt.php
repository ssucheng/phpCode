<?php
/**此界面用于操作用户添加 */
// 1. 链接数据库
$conn = mysqli_connect("127.0.0.1","root","root","baixiu");
// 2.判断下数据库是否链接成功
if(!$conn){
    die("数据库链接失败");
}
// print_r($_POST);
// exit;
// 3.接受前台上传过来的数据
$email = $_POST["email"];
$slug = $_POST["slug"];
$nickname = $_POST["nickname"];
$password = $_POST['password'];
$status = "activated";
// print_r ($email);
// exit;
// 4.编写sql语句 添加数据到数据库中
$sql = "insert into users (email,slug,nickname,password,status) values ('$email','$slug','$nickname','$password','$status')";
// 5.0 操作数据库
$res = mysqli_query($conn,$sql);
// 6.0判断结果
if($res){
    $arr = array(
        "code" => 200,
        "msg" => "添加成功..."

    );
}else{
    $arr = array(
        "code" => 250,
        "msy" => "添加失败..."
    );
}
// 7.0将结果返回给前台  前后台的数据交互只能是字符串和二进制
echo json_encode($arr);
// 8.0断开数据库
mysqli_close($conn);
?>