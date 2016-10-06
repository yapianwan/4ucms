<?php
include './library/inc.php';
header('Content-type: application/xml; charset="UTF-8"',true);
/* changefreq可自行设置 */
$changefreq = "weekly"; //"always", "hourly", "daily", "weekly", "monthly", "yearly" and "never".
$str = '<?xml version="1.0" encoding="UTF-8"?>';
$str .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$res = $db->getAll("SELECT * FROM cms_detail ORDER BY d_order ASC,id DESC LIMIT 0,3000");
foreach ($res as $val) {
  $str .= '<url><loc>'.$cms['s_domain'].'/'.d_url($val['id']).'</loc><lastmod>'.local_date("Y-m-d H:i:s",$val['d_date']).'</lastmod><changefreq>'.$changefreq.'</changefreq><priority>0.8</priority></url>';
}
$str .= '</urlset>';
if ($act == 'xml') {
  $fp = fopen("sitemap.xml","w+");
  fwrite($fp,$str);fclose($fp);
  header('Location: ./sitemap.xml');
}else{
  echo $str;
}