<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ONE Library</title>
    <link href="/common/css/show.css" rel="stylesheet" />
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <link href="/common/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="/common/css/cu.css" rel="stylesheet" />    
</head>

<body>
    <div id="wrapper" style="margin-top: -20px;">
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
                        <li><a href="<?='/Profile/admin_info'?>"><i class="fa fa-user fa-fw"></i>&nbsp;<?php echo $user['admin_name']; ?></a></li>
                        <li><a href="/Profile/modifyAdmin"><i class="fa fa-cog fa-fw"></i>&nbsp;setting</a></li>
                        <li><a href="<?='/Secure/logout'?>"><i class="fa fa-reply fa-fw"></i>&nbsp;log out</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a class="active-menu" href="/Admin/Home"><i class="fa fa-home"></i> Home</a>
                    </li>
                    <li>
                        <a><i class="fa fa-book"></i> Books Management<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="/Admin/show_books">Books</a>
                            </li>
                            <li>
                                <a href="/Admin/add_book">Add Books</a>
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
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <h1 class="page-header">
                        Welcome to the administration system  <small>Have a nice day!</small>
                    </h1>
                </div>
                

                <div class="text-center footer">
                    <?php echo 'Copyright &copy; 2019 ONE Book lending. All rights reserved | Design by Tony.';?>
                </div>
            </div>
        </div>
    </div>



    <script src="/common/js/jquery-1.10.2.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
    <script src="/common/js/jquery.metisMenu.js"></script>
    <script src="/common/js/morris/raphael-2.1.0.min.js"></script>
    <script src="/common/js/morris/morris.js"></script>
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
    </script>

</body>

</html>