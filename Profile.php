<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $type = $this->session->userdata("type");
      if ($type == NULL) {
         redirect(base_url(), "refresh");
      }
   }

   public function index() {
      echo "Welcome ";
      $type = $this->session->userdata("type");
      if ($type == "a") {
         echo "Admin";
      } else if ($type == "e") {
         echo "Employee";
      } else if ($type == "c") {
         echo "Valuable Customer";
      }
   }

}