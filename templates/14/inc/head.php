<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo $title;?></title>
<meta name="keywords" content="<?php echo $keywords;?>" />
<meta name="description" content="<?php echo $description;?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="icon" type="image/png" href="favicon.png">
<!-- CSS FILES -->
<link rel="stylesheet" href="<?php echo $t_path;?>/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/flexslider.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/prettyPhoto.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/datepicker.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/selectordie.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/main.css">
<link rel="stylesheet" href="<?php echo $t_path;?>/css/2035.responsive.css">

<script src="<?php echo $t_path;?>js/vendor/modernizr-2.8.3-respond-1.1.0.min.js"></script>
<!-- Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="js/luxen/respond.min.js"></script>
<![endif]-->
<?php unset($title);unset($keywords);unset($description);?>
<?php define('PAGE_DISABLED','am-disabled'); define('PAGE_ACTIVE', 'am-active'); ?>