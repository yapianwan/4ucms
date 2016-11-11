<?php
// 更新模板
if(!empty($_GET['t_id'])) {
  setcookie('cms[template_id]', $_GET['t_id'], time()+30*24*3600,'/');
  header('Location:../');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--[if (gte IE 9)|!(IE)]><!-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<!--<![endif]-->
<meta name="renderer" content="webkit">
<style>
.list{width:80%;list-style:none;margin:3rem auto;padding:0;overflow:hidden}
.list li{margin:1.5%;float:left;line-height:40px;border:1px solid #ccc;border-radius:5px;width:30%;min-width:200px;position:re4lative;}
.list .qrcode{display:none;position:absolute;left:50%;margin-left:-60px;width:120px;height:120px;}
.list .qrcode img{width:120px;height:120px;}
.list li:hover .qrcode{display:block;}
.list a{color:#666;display:block;padding:0 20px;text-decoration:none;text-align:center}
.list .img{height:12rem;padding:0;overflow:hidden;border-bottom:1px solid #ccc}
.list img{width:100%;height:auto;}</style>
</head>

<body>
  <ul class="list">
    <?php
    $dir = './images/';
    $file = scandir($dir);
    foreach ($file as $key=>$val) {
      if ($val!='.' && $val!='..') {
        $filename = explode('.', $val);
        $arr[$key] = $filename[0];
      }
    }
    sort($arr);
    foreach ($arr as $val) {
      echo '<li><a href="?t_id=' . $val . '" class="img"><img src="images/' . $val . '.jpg"></a><a href="?t_id=' . $val . '">' . '网站' . $val . '</a></li>';
    }
    ?>
  </ul>
</body>
</html>
<?php
unset($dir);
unset($file);
unset($t_id);
unset($arr);