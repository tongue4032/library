<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ONE Library</title>
    <link href="/common/css/show1.css" rel="stylesheet" />
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <link href="/common/css/custom-styles1.css" rel="stylesheet" />
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
                                <a href="/Book/show_books" class="active-menu">Books</a>
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
                                <a href="/Admin/add_admin">Add Admins</a>
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
                        <h1 class="page-header">Books Info</h1>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table border="1" cellpadding="0">
  								<tr style="background-color: #7dbfe699;">
    								<th width="100" scope="col" class="text-center">Barcode</th>
    								<th width="230" scope="col" class="text-center">Bookname</th>
    								<th width="150" scope="col" class="text-center">Author</th>
    								<th width="180" scope="col" class="text-center">Press.</th>
    								<th width="140" scope="col" class="text-center">Publish Date</th>
    								<th width="110" scope="col" class="text-center">Operation</th>
    							</tr>
    							<?php foreach ($books as $book) { ?>
    							<tr>
    								<td class="text-center"><?php echo $book['barcode']; ?></td>
    								<td class="text-center">《<?php echo $book['bookname'] ;?>》</td>
    								<td class="text-center"><?php echo $book['author'] ;?></td>
    								<td class="text-center"><?php echo $book['press'] ;?></td>
    								<td class="text-center"><?php echo $book['publish_date'] ;?></td>
    								<td class="text-center"><a class="editBtn" data-id="<?php echo $book['id'];?>" href="javascript:void(0);"><span class="fa fa-edit"></span></a>&nbsp;|&nbsp;<a class="deleteBtn" data-id="<?php echo $book['id'];?>" href="javascript:void(0);"><span class="fa fa-trash" style="color: #ff0000;"></span></a></td>
    							</tr>

    							<?php } ?>
							</table>
                            <div>
                                <?php echo $link ?>
                            </div>
                        </div>                                     
                    </div>
                </div>
            </div>
        </div>  
    <script src="/common/js/jquery-1.10.2.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
    <script src="/common/js/jquery.metisMenu.js"></script>
    <script src="/common/js/custom-scripts.js"></script>
    <script src="/common/js/jquery-2.1.4.min.js"></script>
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

            window.onload = function() {
                $(".editBtn").click(function () {
                    var id = $(this).attr("data-id");
                    edit(id);
                    return false;
                });

                function edit(id) {
                    $.ajax({
                        type: "POST",
                        url: "/Book/change_book",
                        dataType: "json",
                        data: {'id': id},
                        success: function (data) {
                            if (data.code = 1) {
                                window.location.href = "/Book/change_books";
                            }
                        }
                    });
                }

                $(".deleteBtn").click(function () {
                    var id = $(this).attr("data-id");
                    de(id);
                    return false;
                });

                function de(id) {
                    $.ajax({
                        type: "POST",
                        url: "/Book/delete_book",
                        dataType: "json",
                        data: {'id': id},
                        success: function (data) {
                            alert(data.message);
                            if (data.code = 1) {
                                window.location.href = "/Book/show_books";
                            } else {
                                alert(data.message);
                                window.location.href = "/Book/show_books";
                            }
                        }
                    });
                }
            }
    </script>
 
</body>
</html>