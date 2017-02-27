<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Nainai extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
   public function index() {
      $data = array();
      
      $farhad = $this->am->view_data("per_page", "", "", "");
      foreach ($farhad as $f){
          $f420 = $f->name;
      }
      
      $data["page_title"] = "Home Page | bazar.com";
      $data['per_page'] = $f420;
      if(isset($_GET['page'])){
          $start = ($_GET['page'] - 1)*$data['per_page'];
          $data['cur_page'] = $_GET['page'];
      }
      else{
        $start = 0;
        $data['cur_page'] = 1;
      }
      $data['total'] = $this->am->totalProduct();
      
      $data['allPdt'] = $this->am->home("", $data['per_page'], $start);
      $data['content'] = $this->load->view("frontend/home", $data, TRUE);
      $this->load->view('master', $data);
   }

}
