<!DOCTYPE html>
<html lang="en">

<head>
    <title>ONE Library</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <!-- <meta name="keywords" content="Border sign in Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design"> -->

    <link rel="stylesheet" href="<?='/css/show4.css'?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?='/css/font-awesome.css'?>" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">

</head>

<body>
    <h1 class="title-agile text-center">ONE Library</h1>
    <div class="content-w3ls">
        <div class="content-bottom">
            <?php $user = $this->session->userdata('user');  ?>
            <?php if(empty($user)) :?>
			<p><a style="margin-right: 10px;" class="fa fa-cog"></a>Please login to account：
				<a href="<?='/Secure/username_login'?>" style='text-decoration: none;'>Login</a>
                <a>|</a>
				<a href="<?='/Secure/register'?>"style='text-decoration: none;'>Register</a>
			</p>
            <?php else :?>
                <p><a href="/Profile/user_info" style="margin-right: 10px;" class="fa fa-cog"></a><?php echo $user['username'];?>,Welcome！[<a href="<?='/Secure/logout'?>">Logout</a>]
                </p>
            <?php endif;?>
            <form action="<?='/Book/search'?>" method="post" id="form" novalidate>
                <div class="field-group" style="margin-left: 18px;">
                    <select id="type" name="type" style="margin-top: 30px;margin-left: -3px;margin-bottom: 3px;height: 25px;outline: none;">
                        <option value="Bookname">Bookname</option>
                        <option value="Author">Author</option>
                    </select>
                    <div class="wthree-field-l">
                        <input style="margin-top: 0;" name="info" id="info" type="text" placeholder="Search books" required>
                        <span class="fa fa-search" aria-hidden="true"></span>
                    </div>
                    
                
                    <div class="wthree-field">
                        <input style="outline: none;" type="submit" id="search" value="Search" class="enjoy-css">
                    </div>
<!--                    <h6 style="color: #ff0000;">--><?php //echo $this->session->tempdata('item');?><!--</h6>-->
                </div>
            </form>
            <div class="wthree-field-k">
                <?php $user = $this->session->userdata('user');  ?>
                <?php if(empty($user)) :?>
                    <a>
                        <button type="button" class="enjoy-css" style="outline: none;">Information</button>
                    </a>
                <? else :?>
                    <a href="<?='/Book/info'?>">
                        <button type="button" class="enjoy-css" style="outline: none;">Information</button>
                    </a>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="text-center copyright" style="width: 100%;position:absolute;bottom:10px;left:0px;">
        <p>© 2019 ONE Book lending. All rights reserved | Design by Tony</a></p>
    </div>
    <script src="/js/jquery-2.1.4.min.js"></script>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }

        //检查表单是否为空
        function check() {
            if (form.info.value == "") {
                alert("Query information cannot be empty!!");
                form.info.focus();
                return false;
            }
            return true;
        }

        window.onload = function() {
            document.getElementById('form').onsubmit = function () {
                var valid = check();
                if(valid) {
                    return true;
                }
                return false;
            }
        }

    </script>
</body>
<!-- //Body -->
</html>
