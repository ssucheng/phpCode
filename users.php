<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <?php include './inc/css.php'?>
 
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <?php include './inc/navBar.php'?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="myForm">
            <h2>添加新用户</h2>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
              <span class="btn btn-primary" id="btnAdd">添加</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              
             
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <?php include './inc/aside.php'?>

  <?php include './inc/script.php'?>
  <script>NProgress.done()</script>
</body>
</html>
<!-- <script type="text/template" id="usersListTmp">
  {{each data as val key}}
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td class="text-center"><img class="avatar" src="{{val.avatar}}"></td>
                <td>val.email</td>
                <td>val.slug/td>
                <td>val.nickname</td>
                  {{if val.status =='unactivated'}}
                          <td>未激活</td>
                  {{else if val.status =='activated'}}
                          <td>激活</td>
                  {{else if val.status =='forbidden'}}
                          <td>禁用</td>
                  {{else }}
                          <td>废弃</td>
                  {{/if}}              
                <td class="text-center">
                  <a href="post-add.php" class="btn btn-default btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
  {{/each}}
</script> -->
<script type="text/template" id="usersListTmp">
  {{each data as val key}}
     <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td class="text-center"><img class="avatar" src="{{val.avatar}}"></td>
        <td>{{val.email}}</td>
        <td>{{val.slug}}</td>
        <td>{{val.nickname}}</td>   
        {{if val.status =='unactivated'}}
          <td>未激活</td>
        {{else if val.status =='activated'}}
          <td>激活</td>
        {{else if val.status =='forbidden'}}
          <td>禁用</td>
        {{else }}
          <td>废弃</td>
         {{/if}}
        <td class="text-center">
          <!-- <a href="post-add.php" class="btn btn-default btn-xs">编辑</a> -->
          <input type="button" data-id="{{val.id}}" class="btn btn-default btn-xs btnEdit" value="编辑">
          <!-- <a href="javascript:;" class="btn btn-danger btn-xs">删除</a> -->
          <span class="btn btn-danger btn-xs btnDel" data-id="{{val.id}}">删除</span>
        </td>
      </tr>
  {{/each}}
</script>
<script type="text/template" id="userEditTmp">
            <h2>编辑用户</h2>
            <input type="hidden" value="{{id}}" name='id'>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱" value="{{email}}">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug" value="{{slug}}">
              <p class="help-block">https://zce.me/author/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称" value="{{nickname}}">
            </div>
            
            <div class="form-group">
              <!-- <button class="btn btn-primary" type="submit">添加</button> -->
              <span class="btn btn-primary" id="btnUpdate">更新</span>
            </div>
</script>
<script>
  // 1.向服务器发送请求 请求用户数据 动态渲染用户数据
  render();
  function render(){

    $.ajax({
    type:'get',//一般渲染页面使用get请求
    url:'./int/users/usersInt.php',
    dataType:'json',
    success:function(res){
      // console.log(res);
      // console.log(typeof(res));
      //  判断下是否请求成功 请求成功就渲染页面
     if(res && res.code ==200){
        //准备模板字符串
        var htmlStr = template('usersListTmp',res);
        //动态渲染数据
        $('tbody').html(htmlStr);
     }
    },


  });
  }

  // 2.页面中用户的添加  只有用户在点击的时候才发送ajax请求
  $("#btnAdd").on("click",function(){
    $.ajax({
      type:"post",
      url:"./int/users/usersAddInt.php",
      //不采用表单的形式提交 用表达序列化的形式把数据都添加
      // data:$("#myForm").serialize(),
      data: $("#myForm").serialize(),
      //将后台响应的数据 装换成json对象的形式
      dataType:"json",

      success:function(res){
          //判读下返回数据的状态码
          if(res && res.code == 200){
              // 调用上面的1 重新渲染页面
              render();
              //清空页面中用户写的内容
              $("input[name]").val("");

          }
      }


    });




  });

  // 3.页面中用户的删除 因为页面中这一块是动态创建的需要用委派
  $('tbody').on('click','.btnDel',function(){
      $.ajax({
        type:'get',
        url:'./int/users/usersDelInt.php',
        data:{
          id : $(this).attr("data-id")
        },
        dataType:"json",
        success:function(res){
            if(res && res.code == 200){
              //重新渲染页面
              render();
            }
        }
      });


  });
  // 4.页面中用户编辑操作  利用委派获取元素
  $('tbody').on('click','.btnEdit',function(){
    // console.log(123);

    $.ajax({
      type:'get',
      url:'./int/users/usersEditInt.php',
      data:{
        id : $(this).attr('data-id')
        },
      dataType:'json',
      success:function(res){
          if(res && res.code == 200){
           var htmlStr = template('userEditTmp',res.data);
           $('#myForm').html(htmlStr);
          }
      }
    });
  });

  // 5.更改数据 就是更新数据 
  $("#myForm").on("click","#btnUpdate",function(){
    $.ajax({
      type:'post',
      url:"./int/users/usersUpdateInt.php",
      data:$("#myForm").serialize(),
      dataType:"json",
      success:function(res){
        if(res && res.code == 200){
           render();
        }
      }
    })


  });

</script>
