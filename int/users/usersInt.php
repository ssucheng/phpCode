<?php
// 这里写后台的业务逻辑 用于获取所有的用户信息
// 1.先链接数据库
$conn = mysqli_connect("127.0.0.1","root","root","baixiu");
// 2.判断下数据库是否链接成功
if(!$conn){
    die("数据库链接失败");
}
// 3.查询数据库 读取数据库里面的数据
$sql = "select * from users";
// 4.操作数据库 
$res = mysqli_query($conn,$sql);
// 5.将查询到的结果集 循环读取
while($row = mysqli_fetch_assoc($res) ){
    $data[] = $row;
} 
$arr = array(
    "code" =>200,
    "msg" => "success",
    "data" =>$data
);
// 6.断开数据库
mysqli_close($conn);
// 7. 返回数据
echo json_encode($arr);


?>