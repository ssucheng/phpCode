<?php
/**这个页面是操作删除用户的 */
$id = $_GET["id"];
// 1.链接数据库
$conn = mysqli_connect("127.0.0.1","root","root","baixiu");
// 2.判断下下数据库是否链接成功
if(!$conn){
    die("数据库链接失败...");
}
// 3.编写sql语句
$sql = "delete from users where id=$id ";
// 4.操作数据库
$res = mysqli_query($conn,$sql);
// 5.0 判断结果
if($res){
    $arr = array(
        "code" => 200,
        "msg" => "操作成功..."
    );
}else{
    $arr = array(
        "code" => 250,
        "msg" => "操作失败..."
    );
}
// 6.返回结果
echo json_encode($arr);
// 7.0断开数据库
mysqli_close($conn);




?>