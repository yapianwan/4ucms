<?php
class Detail{
  private $db;
  public function __construct($db) {
    $this->db = $db;
  }
  // 获取详情
  public function getDetail($id) {
    return $this->db->getRow("SELECT * FROM cms_detail WHERE id = $id");
  }
  //获取详情数据
  public function getCol($col,$id) {
    return $this->db->getOne("SELECT $col FROM cms_detail WHERE id = $id");
  }
  // 获取同级
  public function getLevel($id,$order="d_order ASC,id DESC") {
    $cid = $this->getCol(LIB_DPARENT,$id);
    return $this->db->getAll("SELECT * FROM cms_detail WHERE d_parent = $cid ORDER BY $order");
  }
  // 获取上一条 $order[0,1] 0正序 1倒序
  public function getPrev($id,$order=1) {
    $cid = $this->getCol(LIB_DPARENT,$id);
    if ($order) {
      $res = $this->db->getRow("SELECT * FROM cms_detail WHERE d_parent = $cid AND id > $id ORDER BY id ASC");
    } else {
      $res = $this->db->getRow("SELECT * FROM cms_detail WHERE d_parent = $cid AND id < $id ORDER BY id DESC");
    }
    return $res;
  }
  // 获取下一条 $order[0,1] 0正序 1倒序
  public function getNext($id,$order=1) {
    $cid = $this->getCol(LIB_DPARENT,$id);
    if ($order) {
      $res = $this->db->getRow("SELECT * FROM cms_detail WHERE d_parent = $cid AND id < $id ORDER BY id DESC");
    } else {
      $res = $this->db->getRow("SELECT * FROM cms_detail WHERE d_parent = $cid AND id > $id ORDER BY id ASC");
    }
    return $res;
  }
  // 浏览自增
  public function addHit($id) {
    $this->db->query("UPDATE cms_detail SET d_hits = d_hits + 1 WHERE id = $id");
  }
}
?>