<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONE Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="Border sign in Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"> -->

    <link rel="stylesheet" href="/css/style.css" type="text/css" media="all">
    <link rel="stylesheet" href="/css/font-awesome.css" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">

</head>

<body>
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <a style="color: #fff" href="<?='/secure'?>"><span class="fa fa-reply" aria-hidden="true">BACK</span></a>
        <div class="content-bottom">
			<h2>Log In<i class="fa fa-book" aria-hidden="true"></i></h2>
            <li style="list-style: none;padding-bottom:5px;">
                <a style="color: #ffffff;margin-left:230px;" href="<?='/Secure/email_login'?>">Email</a>
                <a style="margin-left:2px;">/</a>
                <a style="color: #ffffff;margin-left:2px;" href="<?='/Secure/telephone_login'?>">Phone</a>
            </li> 
            <form action="<?='/Secure/do_username_login'?>" method="post" id="form" novalidate>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="username" id="username" type="text" placeholder="Username" required>
                    </div>
                    <span class="fa fa-user" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="password" id="myInput" type="Password" placeholder="Password" required>
                    </div>
                    <span class="fa fa-lock" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="check">
                        <label class="checkbox w3l">
                            <input type="checkbox" onclick="myFunction()">
                            <i> </i>show password</label>
                    </div>
                </div>
                

                <div class="wthree-field">
                    <input id="saveForm" name="saveForm" type="submit" value="log in" style="outline: none;"/>
                </div>
                <ul class="list-login">
                    <li>
                        <a href="<?='/Secure/register'?>">Create account</a>
                    </li>                    
                        <a href="<?='/Secure/forget'?>" class="text-right">Forget password?</a>
                    </li>                    
                </ul>
            </form>
        </div>
    </div>
    <div class="text-center copyright" style="width: 100%;position:absolute;bottom:10px;left:0px;">
        <p>© 2019 ONE Book lending. All rights reserved | Design by Tony</p>
    </div>
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

        function myFunction() {
            var x = document.getElementById("myInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        //检查用户名格式
        function checkName() {
            var name = document.getElementById("username").value.trim();
            if(!(/^[a-zA-Z0-9]+$/).test(name)){
                alert("Please enter the correct username format!");
                document.getElementById("username").value="";
                return false;
            }
            return true;
        }

        //检查密码格式
        function checkPwd(){
            var password = document.getElementById("myInput").value.trim();
            if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(password)){
                alert("Please enter the correct password format!");
                document.getElementById("myInput").value="";
                return false;
            }
            return true;
        }

        //检查表单是否为空
        function check(){           //定义一个函数
            if(form.username.value==""){         //通过if语句判断用户名是否为空
                alert("User name cannot be empty!!");
                form.username.focus();
                return false;      //返回表单元素位置
            }
            if(form.password.value==""){         //通过if语句判断密码是否为空
                alert("User password cannot be empty!!");
                form.password.focus();
                return false;
            }   //返回表单元素位置
            return true;
        }

        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = check();
                if (valid) {
                    if(checkName() && checkPwd()) {
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
                url : "do_username_login",
                dataType:"json",
                data : data,
                success : function(data) {
                    if (data.code == 1) {
                        window.location='/Secure/index';
                    } else {
                        alert(data.message);
                        document.getElementById("form").value="";
                    }
                }
            });
        }
    </script>
</body>
<!-- //Body -->
</html>