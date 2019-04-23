<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONE Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="Border sign in Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"> -->

    <link rel="stylesheet" href="/css/style10.css" type="text/css" media="all">
    <link rel="stylesheet" href="/css/font-awesome.css" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">

</head>

<body>
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <a style="color: #fff" href="/Profile/user_info"><span class="fa fa-reply" aria-hidden="true">BACK</span></a>
        <div class="content-bottom">
			<h2>Modify</h2> 
            <form action="<?='/Profile/modify_user_info'?>" method="post" id="form" novalidate>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="user_id" id="user_id" type="text" value="<?php echo $user_id ?>" readonly>
                    </div>
                    <span class="fa fa-tag" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="username" id="username" type="text" placeholder="New Name" required>
                    </div>
                    <span class="fa fa-user" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="password" id="password" type="Password" placeholder="New Password" required>
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
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="telephone" id="telephone" type="text" placeholder="New Telephone">
                    </div>
                    <span class="fa fa-phone" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="email" id="email" type="text" placeholder="New Email" required>
                    </div>
                    <span class="fa fa-envelope" aria-hidden="true"></span>
                </div>

                <div class="wthree-field">
                    <input id="saveForm" name="saveForm" type="submit" value="Modify" style="outline: none;"/>
                </div>
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
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        //检查用户名格式
        function checkName() {
            var name = document.getElementById("username").value.trim();
            if(!(/^[a-zA-Z]+$/).test(name)){
                alert("Please enter the correct username format!");
                document.getElementById("username").value="";
                return false;
            }
            return true;
        }

        //检查密码格式
        function checkPwd(){
            var password = document.getElementById("password").value.trim();
            if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(password)){
                alert("Please enter the correct password format!");
                document.getElementById("password").value="";
                return false;
            }
            return true;
        }

        //检查手机号格式
        function checkPhone(){
            var phone = document.getElementById('telephone').value;
            if(!(/^1[34578]\d{9}$/.test(phone))){
                alert("Please enter the correct mobile number format!");
                document.getElementById('telephone').value="";
                return false;
            }
            return true;
        }

        //检查邮箱格式
        function checkEmail(){
            var email = document.getElementById("email").value.trim();
            if (!(/^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/).test(email)) {
                alert("Please enter the correct email format!");
                document.getElementById("email").value="";
                return false;
            }
            return true;
        }

        //检查表单是否为空
        function check(){
            if(form.username.value==""){
                alert("User name cannot be empty!!");
                form.username.focus();
                return false;
            }
            if(form.password.value==""){
                alert("User password cannot be empty!!");
                form.password.focus();
                return false;
            }
            if(form.telephone.value==""){
                alert("Mobile number cannot be empty!!");
                form.telephone.focus();
                return false;
            }
            if(form.email.value==""){
                alert("Email address cannot be empty!!");
                form.email.focus();
                return false;
            }
            return true;
        }

        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = check();
                if(valid) {
                    if(checkName() && checkPhone() && checkPwd() && checkEmail()) {
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
                url : "modify_user_info",
                dataType:"json",
                data : data,
                success : function(data) {
                    if (data.code == 1) {
                        alert(data.message);
                        window.location='/Secure/username_login';
                    } else {
                        alert(data.message);
                    }
                }
            });
        }
    </script>
</body>
<!-- //Body -->
</html>