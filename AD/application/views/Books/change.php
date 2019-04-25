
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ONE Library</title>
    <link href="/common/css/show2.css" rel="stylesheet" />
    <link href="/common/css/font-awesome.css" rel="stylesheet" />
    <link href="/common/css/custom-styles2.css" rel="stylesheet" />
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
                        <a href="/Admin/Home"><i class="fa fa-home"></i> Home</a>
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
                        <h1 class="page-header">Modify Books</h1>
                    </div>
                </div>
                <div class="panel panel-default">
                    <form action="/Admin/change" id="form" method="post" novalidate>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <div class="table-responsive">
                                <p>Barcode：
                                    <input type="text" id="barcode" name="barcode" value="<?php echo $barcode ?>" readonly>
                                &nbsp;&nbsp;&nbsp;&nbsp;Bookname：
                                    <input id="bookname" name="bookname" type="text" value="<?php echo $bookname ?>" required>
                                </p>
                            </div> 
                            <div class="table-responsive">
                                <p>Author：
                                    <input id="author" name="author" type="text" value="<?php echo $author ?>" required>
                                &nbsp;&nbsp;&nbsp;&nbsp;Press.：
                                    <input id="press" name="press" type="text" value="<?php echo $press ?>" required>
                                </p>
                            </div> 
                            <div class="table-responsive">
                                <p>Publish Date：
                                    <input id="date" name="date" type="text" value="<?php echo $publish_date ?>" required >
                                &nbsp;&nbsp;&nbsp;&nbsp;Content：
                                    <textarea style="vertical-align: top;" id="content" name="content" maxlength="100" onkeyup="this.value=this.value.substring(0, 100)" cols="35" rows="5" ><?php echo $content ?></textarea>
                                </p>
                                <div style="margin-top: -28px; margin-left: 710px;">
                                    <span id="text-count" style=" color: #0480be;">100</span>/100
                                </div>
                            </div>
                            <div style="margin-left: 340px;margin-top: 30px;color: #fff;">
                                <button style="background-color: #3a7ed4;border-radius: 12px;padding: 10px 20px;">
                                    <a href="/Admin/show_books" style="color: #fff;text-decoration:none;">Return</a>
                                </button>
                                <input id="add" type="submit"  value="Modify" style="background-color: #3a7ed4;width: 80px;border-radius: 12px;padding: 10px 20px;">
                            </div>
                        </table> 
                    </div>
                    </form>
                </div>
            </div>
        </div>  
    <script src="/common/js/jquery-1.10.2.js"></script>
    <script src="/common/js/bootstrap.min.js"></script>
    <script src="/common/js/jquery.metisMenu.js"></script>
    <script src="/common/js/custom-scripts.js"></script>
    <script>
        //显示时间
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

        //日期格式检查
        function dateValidationCheck(){
            var a = /^(\d{4})-(\d{2})-(\d{2})$/;
            if (!a.test(document.getElementById("date").value)) {
                alert("Date format is incorrect!");
                document.getElementById('date').value="";
                return false;
            }
            return true;
        }

        //作者名格式检查
        function checkAuthor(){
            var reg = new RegExp("^[A-Z\a-z\u4e00-\u9fa5\·]+$");
            var author = document.getElementById("author").value.trim();
            if(!reg.test(author)) {
                alert("Please enter the correct author format！");
                document.getElementById('author').value="";
                return false;
            }
            return true;
        }


        //检查图书名称
        function checkbookname() {
            var  bookname = document.getElementById('bookname').value.trim();
            if(!(/^[\u4e00-\u9fa5a-zA-Z0-9]+$/).test(bookname)){
                alert("Please enter the correct bookname format!");
                document.getElementById('bookname').value="";
                return false;
            }
            return true;
        }

        //出版社格式检查
        function checkPress(){
            var reg = new RegExp("^[A-Z\a-z\u4e00-\u9fa5]+$");
            var press = document.getElementById("press").value.trim();
            if(!reg.test(press)) {
                alert("Please enter the correct publisher format！");
                document.getElementById('press').value="";
                return false;
            }
            return true;
        }

        //textarea限制字数
        window.onload = function() {
            //（document）
            document.getElementById('content').onkeyup = function() {
                document.getElementById('text-count').innerHTML=this.value.length;
            }
            //（jquery）
            $('#note2').keyup(function() {
                var len=this.value.length
                $('#text-count2').text(len);
            })
        }

        //检查表单是否为空
        function mycheck(){
            if(form.bookname.value == ""){
                alert("Bookname cannot be empty!!");
                form.bookname.focus();
                return false;
            }
            if(form.author.value == ""){
                alert("Author cannot be empty!!");
                form.author.focus();
                return false;
            }
            if(form.press.value == ""){
                alert("Press. cannot be empty!!");
                form.press.focus();
                return false;
            }
            if(form.date.value == ""){
                alert("Publish date cannot be empty!!");
                form.date.focus();
                return false;
            }
            if(form.content.value == "") {
                alert("Content cannot be empty!!");
                form.content.focus();
                return false;
            }
            return true;
        }

        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = mycheck();
                if(valid) {
                    if(checkbookname() && checkAuthor() && checkPress() && dateValidationCheck()) {
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
                url : "change",
                dataType:"json",
                data : data,
                success : function(data) {
                    if (data.code == 1) {
                        alert(data.message);
                        window.location='/Admin/show_books';
                    }else{
                        alert(data.message);
                    }
                }
            });
        }
            
    </script>
 
</body>
</html>