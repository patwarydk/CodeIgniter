<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

   public function index() {
      $data = array();
      $data["page_title"] = "Product | bazar.com";
      $data['content'] = $this->load->view("product", "", TRUE);
      $this->load->view('master', $data);
   }
   public function details() {
      $data = array();
      $id = $this->uri->segment(3);
      $pdata = $this->am->view_data("product", array("id"=>$id), "", "");
      foreach ($pdata as $pdt){
         $data["page_title"] = "{$pdt->title} | bazar.com";
      }
      $data['selPdt'] = $pdata;
      $data['content'] = $this->load->view("frontend/details", $data, TRUE);
      $this->load->view('master', $data);
   }

}
