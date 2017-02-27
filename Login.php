<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

   public function __construct() {
      parent::__construct();
   }

   public function index() {
      $data = array();
      $data["page_title"] = "Login/Register | nainai.com";
      $sub = $this->input->post("sub");
      if ($sub != NULL) {
         $dt = array(
             "email"=>  $this->input->post("email"),
             "password"=>  md5($this->input->post("pass"))
         );
         $user = $this->am->view_data("user", $dt, "", "");
         if($user){
            foreach ($user as $u){
               if($u->status == ""){
                  $sdata['id'] = $u->id;
                  $sdata['type'] = $u->type;
                  $this->session->set_userdata($sdata);
                  redirect(base_url() . "profile", "refresh");
               }  else {
                  echo "Pleas Verify your account";
               }
            }
            
         }
         else{
            $sdata['msg'] = "Invalid Email or Password";
            $this->session->set_userdata($sdata);
            $data['content'] = $this->load->view("frontend/login", NULL, TRUE);
            $this->load->view('master', $data);
         }
      } else {
         $data['content'] = $this->load->view("frontend/login", NULL, TRUE);
         $this->load->view('master', $data);
      }
   }

   public function account_verify() {
      $code = $this->uri->segment(3);
      if ($code != NULL) {
         $data = $this->am->view_data("user", array("status" => $code), "", "");
         if ($data) {
            foreach ($data as $d) {
               $sdata['id'] = $d->id;
               $sdata['type'] = $d->type;
            }
            $this->session->set_userdata($sdata);
            $this->am->update_data("user", array("status" => ""), array("id" => $sdata['id']));
            echo "Account Verify Successful";
         } else {
            echo "Invalid Code";
         }
      } else {
         redirect(base_url(), "refresh");
      }
   }

   public function logout(){
      $this->session->sess_destroy();
      redirect(base_url(), "refresh");
   }
}

