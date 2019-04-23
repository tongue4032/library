<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
// session_start();
$im = imagecreate(60, 25);
$back = imagecolorallocate($im, 245, 245, 245);
imagefill($im, 0, 0, $back);

$vcodes = "";
for($i = 0; $i < 4; $i++){
    $font = imagecolorallocate($im, rand(100, 255), rand(0, 100), rand(100, 255));
    $authnum = rand(0, 9);
    imagestring($im, 5, 9 + $i * 10, 5, $authnum, $font);
    $vcodes .= $authnum;
}

$_SESSION['VCODE'] = $vcodes;
for($i=0;$i<200;$i++) {
    $randcolor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
    imagesetpixel($im, rand()%60, rand()%25, $randcolor); //
}
Header("Content-type:image/PNG");
imagepng($im);
imagedestroy($im);
