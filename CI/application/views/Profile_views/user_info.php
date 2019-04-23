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
    <?php $user = $this->session->userdata('user'); ?>
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <a style="color: #fff" href="<?='/Secure'?>"><span class="fa fa-reply" aria-hidden="true">BACK</span></a>
        <div class="content-bottom">
			<h2>User Info</h2> 
            <li style="list-style: none;padding-bottom:5px;">
                <a style="color: #ffffff;margin-left:275px;" href="<?='/Profile/modify?user_id='.$user['user_id'] ?>"><span class="fa fa-pencil" aria-hidden="true">Modify</span></a>
            </li> 
            <form>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="user_id" id="user_id" type="text" value="<?php echo $user['user_id'] ?>" readonly>
                    </div>
                    <span class="fa fa-tag" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="username" id="text1" type="text" value="<?php echo $user['username'] ?>" readonly>
                    </div>
                    <span class="fa fa-user" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="password" id="password" type="text" value="<?php echo $user['password'] ?>" readonly>
                    </div>
                    <span class="fa fa-lock" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="telephone" id="telephone" type="text" value="<?php echo $user['telephone'] ?>" readonly>
                    </div>
                    <span class="fa fa-phone" aria-hidden="true"></span>
                </div>
                <div class="field-group">
                    <div class="wthree-field">
                        <input name="telephone" id="telephone" type="text" value="<?php echo $user['email'] ?>" readonly>
                    </div>
                    <span class="fa fa-envelope" aria-hidden="true"></span>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center copyright" style="width: 100%;position:absolute;bottom:10px;left:0px;">
        <p>© 2019 ONE Book lending. All rights reserved | Design by Tony</p>
    </div>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }


    </script>
</body>
<!-- //Body -->
</html>