<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $type = $this->session->userdata("type");
      if ($type == NULL) {
         redirect(base_url(), "refresh");
      }
   }

   public function index() {
      $data = array();
      $this->load->helper("form");
      $this->load->library("form_validation");
      $data['allCat'] = $this->am->view_data("category", "", "name", "asc");
      $sub = $this->input->post("sub");
      if($sub != NULL){
         $data['report'] = $this->am->report($this->input->post("title"), $this->input->post("catid"), $this->input->post("price1"), $this->input->post("price2"), $this->input->post("date1"), $this->input->post("date2"));
         
         echo "<pre>";
         print_r($data['report']);
         echo "</pre>";
      }
      
      $data['content'] = $this->load->view("backend/report", $data, TRUE);
      $this->load->view("master", $data);
   }

}