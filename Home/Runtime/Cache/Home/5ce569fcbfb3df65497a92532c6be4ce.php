<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <title><?php echo ($info["title"]); ?></title>
    <link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/base.css"/>
	<style>
		.fonts{padding:1rem;}
	</style>
</head>
<body>
	<div class="logobox mt20 mb20">
		<img style="width:40%;" class="m0a" src="/hbang/Public/Home/about/img/logo.png" />
		<h1 class="tc f14 mt5"></h1>
	</div>
	<div class="fonts bag1">
		<?php echo ($info["content"]); ?>

	</div>
</body>