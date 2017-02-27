<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Amader_model extends CI_Model {

   public $Id;

   public function __construct() {
      parent::__construct();
   }

   public function save_data($table, $data) {
      if ($this->db->insert($table, $data)) {
         $this->Id = $this->db->insert_id();
         return TRUE;
      } else {
         return FALSE;
      }
   }

   public function update_data($table, $data, $where) {
      $this->db->where($where);
      if ($this->db->update($table, $data)) {
         return TRUE;
      } else {
         return FALSE;
      }
   }

   public function delete_data($table, $where) {
      $this->db->where($where);
      if ($this->db->delete($table)) {
         return TRUE;
      } else {
         return FALSE;
      }
   }

   public function recovery_pass($time, $where) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select("id, type, TIMESTAMPDIFF(hour, datetime, '" . $time . "') rtime");
      $this->db->from("user");
      return $this->db->get()->result();
   }

   public function view_data($table, $where, $order1, $order2) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select("*");
      $this->db->from("$table");
      if ($order1 != NULL) {
         $this->db->order_by("$order1", "$order2");
      }
      return $this->db->get()->result();
   }

   public function view_product($where) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select("product.*, category.name, (select sum(add_product.stock) from add_product where add_product.productid=product.id) apStock, (SELECT sum(salesdetails.quantity) FROM salesdetails WHERE salesdetails.productid=product.id) tsale");
      $this->db->from("product");
      $this->db->join("category", "product.categoryid=category.id");
      $this->db->join("add_product", "add_product.productid=product.id", "left");
      $this->db->join("salesdetails", "salesdetails.productid=product.id", "left");
      $this->db->order_by("product.id", "desc");
      $this->db->group_by("product.id");
      return $this->db->get()->result();
   }
   
   public function report($title, $catid, $price1, $price2, $date1, $date2){
      if($catid > 0){
         $this->db->where(array("category.id"=>$catid));
      }
      if($price1 > 0 && $price2 > 0){
         $this->db->where(array("product.price>="=>$price1));
         $this->db->where(array("product.price<="=>$price2));
      }
      else if($price1 > 0){
         $this->db->where(array("product.price>="=>0));
         $this->db->where(array("product.price<="=>$price1));
      }
      else if($price2 > 0){
         $this->db->where(array("product.price>="=>0));
         $this->db->where(array("product.price<="=>$price2));
      }
      
      if($date1 != NULL && $date2 != NULL){
         $this->db->where(array("sales.date>="=> $date1 . " 00-00-00"));
         $this->db->where(array("sales.date<="=> $date2 . " 23-59-59"));
      }
      else if($date1 != NULL){
         $this->db->where(array("sales.date>="=> $date1 . " 00-00-00"));
         $this->db->where(array("sales.date<="=> $date1 . " 23-59-59"));
      }
      else if($date2 != NULL){
         $this->db->where(array("sales.date>="=> $date2 . " 00-00-00"));
         $this->db->where(array("sales.date<="=> $date2 . " 23-59-59"));
      }
      
      echo $type = $this->session->userdata("type");
      if($type != "a"){
         $this->db->where(array("user.id"=>  $this->session->userdata("id")));
      }      
      
      $this->db->select("product.id, product.title, category.name");
      $this->db->from("product");
      $this->db->join("category", "category.id=product.categoryid");
      $this->db->join("salesdetails", "salesdetails.productid=product.id");
      $this->db->join("sales", "sales.id=salesdetails.salesid");
      $this->db->join("user", "user.id=sales.userid");
      
      if($title != NULL){
         $title = explode(" ",$title);
         foreach ($title as $t){
            $this->db->or_like("product.title", $t);
         }
      }
      return $this->db->get()->result();
   }
   
   public function totalProduct(){
       $this->db->select("count('id') tPdt");
       return $this->db->count_all_results("product");
   }

   public function home($where, $limit, $start) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select("product.*, category.name");
      $this->db->from("product");
      $this->db->join("category", "product.categoryid=category.id");
      $this->db->order_by("product.id", "desc");
      $this->db->limit($limit, $start);
      return $this->db->get()->result();
   }

   public function product_stock($where) {
      if ($where) {
         $this->db->where($where);
      }
      $this->db->select("product.stock, (SELECT sum(salesdetails.quantity) FROM salesdetails WHERE salesdetails.productid=product.id) tsale");
      $this->db->from("product");
      $this->db->join("salesdetails", "salesdetails.productid=product.id", "left");
      $this->db->group_by("product.id");
      return $this->db->get()->result();
   }

   public function checkout($where) {
      if ($where) {
         $this->db->where_in("id", $where);
      }
      $this->db->select("id, title, price, vat, discount");
      $this->db->from("product");
      return $this->db->get()->result();
   }
   
}