<?php
	// Created by Simon J. Hogan
	// Modified: 1/1/2011

	$words = file('./words.txt');
	$pos = array_rand($words, 1);
	$captcha = trim($words[$pos]);
	
	$image = imagecreatetruecolor(200, 80);
	$background = imagecolorallocate($image, 255, 236, 179);
	$fontcolor = imagecolorallocate($image, 0, 0, 0);
	
	$font = './captcha.ttf';
	$size = 30;
	$angle = 10;
	
	$bbox = imagettfbbox($size, $angle , $font, $captcha);
	$w = imagesx($image);
	$h = imagesy($image);
	
	$x = $bbox[0] + ($w / 2) - ($bbox[4] / 2);
	$y = $bbox[1] + ($h / 2) - ($bbox[5] / 2);

	imagefilledrectangle($image, 0, 0, $w, $h, $background);	
	imagettftext($image, $size, $angle , $x, $y, $fontcolor, $font, $captcha);
	imageline($image, 0, rand(20, $h-20), $w, rand(20, $h), $fontcolor);
	imageline($image, 0, rand(20, $h-20), $w, rand(20, $h), $fontcolor);
	
	session_start();
	session_regenerate_id();
	$_SESSION['_captcha_'] = strtolower($captcha);	
		
	// Output the image to browser
	header('Content-type: image/gif');
	imagegif($image);
	imagedestroy($image);
?>
