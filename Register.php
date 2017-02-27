<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data = array();
      $sub = $this->input->post("sub");
      if ($sub != NULL) {
         $dt = array(
             "name" => $this->input->post("fn"),
             "email" => $this->input->post("email"),
             "password" => md5($this->input->post("pass")),
             "type" => "c",
             "status" => RandStr(12)
         );
         if ($this->am->save_data("user", $dt)) {
            $msg = "For verify your account, <a href='".  base_url() . "login/account_verify/" . $dt['status'] ."'>Click Here</a>";
            $this->load->library("email");
            $this->email->from("tareq142@gmail.com", "Shah Fuad MD. Tareq");
            $this->email->to($dt['email']);
            $this->email->subject("Email Verification");
            $this->email->message($msg);
            
            $this->email->send();
            echo $this->email->print_debugger();
            
            echo $msg;
         } else {
            $data["page_title"] = "Login/Register | nainai.com";
            $data['content'] = $this->load->view("frontend/login", NULL, TRUE);
            $this->load->view('master', $data);
         }
      } else {
         $data["page_title"] = "Login/Register | nainai.com";
         $data['content'] = $this->load->view("frontend/login", NULL, TRUE);
         $this->load->view('master', $data);
      }
   }

}