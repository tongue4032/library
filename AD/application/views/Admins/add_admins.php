
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ONE Library</title>
    <link href="/common/css/show7.css" rel="stylesheet" />
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <link href="/common/css/custom-styles7.css" rel="stylesheet" />
   	<!-- <link href='http://fonts.useso.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <a class="navbar-brand" href="/Secure/home">ONELibrary<img src="/common/images/logo.png"></a>
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
                        <li><a href="/Profile/admin_info"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $user['admin_name']; ?></a></li>
                        <li><a href="/Profile/modifyAdmin"><i class="fa fa-cog fa-fw"></i>&nbsp;setting</a></li>
                        <li><a href="/Secure/logout"><i class="fa fa-reply fa-fw"></i>&nbsp;log out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="/Secure/home"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a><i class="fa fa-book"></i> Books Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Book/show_books">Books</a>
                            </li>
                            <li>
                                <a href="/Book/add_book">Add Books</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a><i class="fa fa-group"></i> Users Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/User/show_users">Users</a>
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
                                <a href="/Admin/add_admin" class="active-menu">Add Admins</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a><i class="fa fa-hdd-o"></i> Rights Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Permissions/role_users">Role Management</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/Profile/admin_info"><i class="fa fa-info" style="margin-left: 4px;margin-right: 14px;"></i> Admin Info</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
				<div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">Add Admins</h1>
                    </div>
                </div>
                <div class="panel panel-default">
                    <form action="/Admin/add_admins" method="post" id="form" novalidate>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <div class="table-responsive">
                                    <p>Admin Name：
                                        <input maxlength="8" id="admin_name" name="admin_name" type="text" placeholder="Admin Name" required>
                                    &nbsp;&nbsp;&nbsp;&nbsp;Admin Password：
                                        <input maxlength="10" id="admin_pwd" name="admin_pwd" type="password" placeholder="Admin Password" required>
                                        <input type="checkbox" onclick="myFunction()">
                                    </p>
                                </div>
                                <div class="table-responsive">
                                    <p>Role：
                                        <select id="professional" name="professional">
                                            <?php foreach ($type as $ty) { ?>
                                                <option value="<?php echo $ty['professional']; ?> "><?php echo $ty['professional']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </p>

                                </div>
                                <div style="margin-left: 340px;margin-top: 30px;color: #fff;">
                                    <input id="reset" type="reset" value="Reset" style="background-color: #3a7ed4;border-radius: 12px;padding: 10px 20px;">
                                    <input id="add" type="submit" value="Add" style="outline:none;background-color: #3a7ed4;width: 80px;border-radius: 12px;padding: 10px 20px;">
                                </div>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    <script src="/common/js/jquery-1.10.2.js"></script>
    <script src="/common/js/jquery-2.1.4.min.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
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

            function myFunction() {
                var x = document.getElementById("admin_pwd");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }

            //检查Name
            function checkName(){
                var reg = new RegExp("^[A-Z\a-z\0-9]+$");
                var admin_name = document.getElementById("admin_name").value.trim();
                if(!reg.test(admin_name)) {
                    alert("Please enter the correct name format!");
                    document.getElementById('admin_name').value="";
                    return false;
                }
                return true;
            }

            //检查密码格式
            function checkPwd(){
                var password = document.getElementById("admin_pwd").value.trim();
                if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(password)){
                    alert("Password length is 6 or more digits and English!");
                    document.getElementById('admin_pwd').value="";
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
                        if(checkName() && checkPwd()) {
                            encode();
                        }
                    }
                    return false;
                }
            }

            function encode() {
                var data = $("#form").serialize();//传数据
                $.ajax({
                    type : "POST",
                    url : "add_admins",
                    dataType : "json",
                    data : data,
                    success : function (data) {
                        switch (data.code) {
                            case 0:
                                alert(data.message);
                                window.location.href="/Admin/show_admins";
                                break;
                            case 1:
                                alert(data.message);
                                window.location.href="/Admin/show_admins";
                                break;
                            case 2:
                                alert(data.message);
                                window.location.href="/Admin/show_admins";
                                break;
                        }
                    }
                });
            }
    </script>
 
</body>
</html>