
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ONE Library</title>
    <link href="/common/css/show11.css" rel="stylesheet" />
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <link href="/common/css/custom-styles13.css" rel="stylesheet" />
   	<!-- <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
   	
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/Admin/Home">ONELibrary<img src="/common/images/logo.png"></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <div id="nowtime" style="color: #d9edf759"></div>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <?php $user = $this->session->userdata('user'); ?>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?='/admin/admin_info'?>"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $user['admin_name']; ?></a></li>
                        <li><a href="/Admin/modifyAdmin"><i class="fa fa-cog fa-fw"></i>&nbsp;setting</a></li>
                        <li><a href="<?='/admin/logout'?>"><i class="fa fa-reply fa-fw"></i>&nbsp;log out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="./Home"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a><i class="fa fa-book"></i> Books Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Admin/show_books">Books</a>
                            </li>
                            <li>
                                <a href="/Admin/add_book"  class="active-menu">Add Books</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-group"></i> Users Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Admin/show_users">Users</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-user-md"></i> Admins Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Admin/show_admins">Admins</a>
                            </li>
                            <li>
                                <a href="/Admin/add_admin">Add Admins</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-hdd-o"></i> Rights Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Admin/role_users">Role Management</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/Admin/admin_info"><i class="fa fa-info" style="margin-left: 4px;margin-right: 14px;"></i> Admin Info</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
				<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">Modify Info</h1>
                    </div>
                </div>
                <div class="panel panel-default">
                    <form action="/Admin/do_modify" method="post" id="form" novalidate>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <div class="table-responsive">
                                <p>Admin ID:
                                    <input type="text" id="admin_id" name="admin_id" value="<?php echo $user['admin_id'] ?>" readonly>
                                    Admin Type:
                                    <input type="text" id="professional" name="professional" value="<?php echo $user['professional'] ?>" readonly>
                                 </p>
                            </div>
                            <div class="table-responsive">
                                <p>Admin Name:
                                    <input type="text" id="admin_name" name="admin_name" placeholder="<?php echo $user['admin_name'] ?>" required>
                                    Admin Password:
                                    <input style="width: 300px;" type="text" id="admin_pwd" name="admin_pwd"" placeholder="<?php echo $user['admin_pwd'] ?>" required>
                                </p>
                            </div>
                            <div style="margin-left: 370px;margin-top: 30px;color: #fff;">
                                <button style="background-color: #3a7ed4;border-radius: 12px;padding: 10px 20px;">
                                    <a href="/Admin/admin_info" style="color: #fff;text-decoration:none;">Return</a>
                                </button>
                                <input id="add" type="submit" value="Modify" style="outline:none;background-color: #3a7ed4;width: 80px;border-radius: 12px;padding: 10px 20px;">
                            </div>
                        </table> 
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <script src="/common/js/jquery-1.10.2.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
    <script src="/common/js/jquery-2.1.4.min.js"></script>
    <script src="/common/js/jquery.metisMenu.js"></script>
    <script src="/common/js/custom-scripts.js"></script>
    <script>
        window.onload=function(){
          setInterval("NowTime()",1000);
        }
        function NowTime(){
            var time=new Date();
            var year=time.getFullYear();
            var month=time.getMonth()+1;
            var day=time.getDate();

            var h=time.getHours();
            var m=time.getMinutes();
            var s=time.getSeconds();

            h=check(h);
            m=check(m);
            s=check(s);
            document.getElementById("nowtime").innerHTML=year+"/"+month+"/"+day+" "+h+":"+m+":"+s;
        }
        function check(i){
            var num;
            i<10?num="0"+i:num=i;
            return num;
        }

        //检查Name
        function checkName(){
            var admin_name = document.getElementById("admin_name").value.trim();
            if(!(/^[A-Za-z0-9]+$/).test(admin_name)) {
                alert("Please enter the correct name format!");
                document.getElementById('admin_name').value="";
                return false;
            }
            return true;
        }

        //检查密码格式
        function checkPwd() {
            var pwd = document.getElementById('admin_pwd').value.trim();
            if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(pwd)){
                alert("Please enter the correct password format!");
                document.getElementById("admin_pwd").value="";
                return false;
            }
            return true;
        }

        //检查表单是否有空
        function mycheck(){
            if(form.admin_name.value == ""){
                alert("Admin name cannot be empty!");
                form.admin_name.focus();
                return false;
            }
            if(form.admin_pwd.value == "") {
                alert("Admin password cannot be empty!");
                form.admin_pwd.focus();
                return false;
            }
            return true;
        }

        //Ajax提交信息
        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = mycheck();
                if (valid) {
                    if (checkName() && checkPwd()) {
                        encode();
                    }
                }
                return false;
            }
        }

        function encode(){
            var data = $("#form").serialize();//传数据
            $.ajax( {
                type : "POST",
                url : "do_modify",
                dataType:"json",
                data : data,
                success : function(data) {
                    if (data.code == 1) {
                        alert(data.message);
                        window.location='/Admin/index';
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
    </script>
 
</body>
</html>