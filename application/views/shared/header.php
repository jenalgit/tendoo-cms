<?php
/**
 * 	File Name 	: header.php
 *	Description :	header file for Auth purposes page. include <html> tag and ends at </head> closing tag
 *	Since		:	1.4
**/
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<?php $this->enqueue->loadcss();?>
<?php $this->enqueue->loadjs();?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
<?php $this->html->title();?>
</head>