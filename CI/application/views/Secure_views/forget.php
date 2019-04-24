<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONE Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="Border sign in Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"> -->

    <link rel="stylesheet" href="<?='/css/style3.css'?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?='/css/font-awesome.css'?>" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">

</head>

<body>
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <div class="content-bottom">
            <h2>Account recovery<i class="fa fa-" aria-hidden="true"></i></h2>
            <p>
Please enter your username or email to retrieve your password</p>
            <form action="<?='/Secure/sendemail'?>" method="post" id="form" novalidate>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="email" id="email" type="text" placeholder="Email" required>
                    </div>
                    <span class="fa fa-envelope" aria-hidden="true"></span>
                </div>            
                <div class="field-group">
                    <div class="wthree-field-l">
                        <input name="captcha" id="captcha" type="text" placeholder="Verification Code" required>
                    </div>
                        <img src="/Secure/captcha" alt="驗證碼" height="48" align="bottom" style="cursor:pointer;" onclick="this.src='<?='/Secure/captcha'?>?d='+Math.random();" />
                </div>

                <div class="wthree-field">
                    <input id="saveForm" name="saveForm" type="submit" value="send reset link" style="outline: none;"/>
                    <a href="<?='/Secure/username_login'?>">
                        <button type="button" style="outline: none;">Return</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="copyright text-center">
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

        function check() {
            if (form.email.value == "") {
                alert("Email address cannot be empty!!");
                form.email.focus();
                return false;
            }
            if (form.captcha.value == "") {
                alert("Captcha cannot be empty!!");
                form.captcha.focus();
                return false;
            }
            return true;
        }

        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = check();
                if(valid) {
                    if(checkEmail()) {
                        encode();
                    }
                }
                return false;
            }
        }


        function encode() {
            var email = document.getElementById('email').value.trim();
            var captcha = document.getElementById('captcha').value.trim();
            $.ajax({
                type : "POST",
                url:"/Secure/sendemail",
                dataType:"json",
                data:{'email':email, 'captcha':captcha},
                success : function(data) {
                    switch (data.code) {
                        case 1:
                            alert(data.message);
                            document.getElementById('captcha').value="";
                            break;
                        case 0:
                            alert(data.message);
                            window.location.href="/Secure/register";
                            break;
                        case 2:
                            alert(data.message);
                            window.location.href="/Secure/index";
                            break;
                        case 3:
                            alert(data.message);
                            window.location.href="/Secure/forget";
                            break;
                    }
                }
            });
        }

    </script>
</body>
<!-- //Body -->
</html>
