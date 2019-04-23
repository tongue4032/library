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
    <link rel="stylesheet" href="<?='/css/style8.css'?>" type="text/css" media="all">
    <link rel="stylesheet" href="<?='/css/font-awesome.css'?>" type="text/css" media="all">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=devanagari,latin-ext" rel="stylesheet">
</head>

<body>
    <h1 class="title-agile text-center">ONE Library</h1>
      <div class="content-w3ls">
        <a style="color: #fff" href="<?='/Secure/index'?>"><span class="fa fa-reply" aria-hidden="true">BACK</span></a>
        <form>
        	<table width="740" border="1" class="text-center" cellspacing="0">	
    		    <tr>
      		    <td width="100">barcode</td>
      				<td width="210">bookname</td>
      				<td width="200">author</td>
     			    <td width="155">username</td>
     			    <td width="160">borrow time</td>
      				<td width="130">operation</td>
    		    </tr>
            <?php foreach ($book as $books) { ?>
       			  <tr style="color: #247d61">
      				  <td><?php echo $books['barcode']; ?></td>
      				  <td><?php echo $books['bookname']; ?></td>
      				  <td><?php echo $books['author']; ?></td>
      				  <td><?php echo $books['username']; ?></td>
      				  <td><?php echo $books['borrow_time']; ?></td>
      				  <td><a href="<?='/Book/give_back?barcode='.$books['barcode'] . '&bookname='.$books['bookname'] . '&author='.$books['author'] . '&username='.$books['username'] . '&borrow_time='.$books['borrow_time']?>">return</a></td>
       			  </tr>
            <?php } ?>
  		    </table>    
        </form>
      </div>

    <div class="text-center copyright" style="width: 100%;position:absolute;bottom:10px;left:0px;">
        <p>© 2019 ONE Book lending. All rights reserved | Design by Tony</p>
    </div>
</body>
<!-- //Body -->
</html>
