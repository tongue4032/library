<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONE Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="Border sign in Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"> -->
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link rel="stylesheet" href="/css/style6.css" type="text/css" media="all">
    <link rel="stylesheet" href="/css/font-awesome.css" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">

</head>

<body>
<!-- <?php echo form_open('form');?> -->
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <div class="content-bottom">
			<h2>User Register<i class="fa fa-book" aria-hidden="true"></i></h2>                
            <form action="<?='/Secure/do_phone_register';?>" method="post" id="form" novalidate>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="username" id="username" type="text" placeholder="Username" required>
                    </div>
                    <span class="fa fa-user" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="telephone" id="telephone" type="text" placeholder="Phone Number" required>
                    </div>
                    <span class="fa fa-user" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="password" id="password" type="Password" placeholder="Password" required>
                    </div>
                    <span class="fa fa-lock" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="repassword" id="repassword" type="Password" placeholder="Confirm Password" required>
                    </div>
                    <span class="fa fa-lock" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="email" id="email" type="text" placeholder="Email" required>
                    </div>
                    <span class="fa fa-envelope" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field-l">
                        <input name="captcha" id="captcha" type="text" placeholder="Verification Code" required></div>
                        <img src="/Secure/captcha" alt="驗證碼" height="48" align="bottom" style="cursor:pointer;" onclick="this.src='<?='captcha/' . rand()?>'" />
                </div>
                <div class="wthree-field">
                    <input id="saveForm" name="saveForm" type="submit" value="register" style="outline: none;"/>
                    <a href="<?='/Secure/register'?>">
                        <button type="button" style="outline: none;">Return</button>
                    </a>
                </div>
                
                
            </form>
        </div>
    </div>
    <div class="text-center copyright" style="width: 100%;position:absolute;bottom:10px;left:0px;">
        <p>© 2019 ONE Book lending. All rights reserved | Design by Tony
        </p>
    </div>
<script src="/js/jquery-2.1.4.min.js"></script>
<script>
    addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
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

    //检查密码格式
    function checkPwd(){
        var password = document.getElementById("password").value.trim();
        if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(password)){
            alert("Password length is 6 or more digits and English!");
            document.getElementById("password").value="";
            return false;
        }
        return true;
    }

    //检查密码格式
    function checkConfirmPwd(){
        var repassword = document.getElementById("repassword").value.trim();
        if(!(/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,12}$/).test(repassword)){
            alert("Please enter the correct confirm password format!");
            document.getElementById("repassword").value="";
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
        if(form.telephone.value==""){
            alert("Mobile number cannot be empty!!");
            form.telephone.focus();
            return false;
        }
        if(form.password.value==""){
            alert("User password cannot be empty!!");
            form.password.focus();
            return false;
        }
        if(form.repassword.value==""){
            alert("Confirm password cannot be empty!!");
            form.repassword.focus();
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
                if(checkName() && checkPhone() && checkPwd() && checkConfirmPwd() && checkEmail()) {
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
            url : "do_phone_register",
            dataType:"json",
            data : data,
            success : function(data) {
                if (data.code == 1) {
                    alert(data.message);
                    window.location='/Secure/username_login';
                } else {
                    alert(data.message);
                    document.getElementById("captcha").value="";
                }
            }
        });
    }


</script>
</body>
<!-- //Body -->
</html>
