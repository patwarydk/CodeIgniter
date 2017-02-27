<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recovery extends CI_Controller {

   public function __construct() {
      parent::__construct();
      date_default_timezone_set("Asia/Dhaka");
   }

   public function index() {
      $data = array();
      $sub = $this->input->post("sub");
      if ($sub != NULL) {
         $user = $this->am->view_data("user", array("email" => $this->input->post("email")), "", "");
         if ($user) {
            $dt = array(
                "reset_pass" => RandStr(12),
                "datetime" => date("Y-m-d H:i:s")
            );
            $this->am->update_data("user", $dt, array("email" => $this->input->post("email")));

            $msg = "For verify your account, <a href='" . base_url() . "recovery/password/" . $dt['reset_pass'] . "'>Click Here</a>";
            $this->load->library("email");
            $this->email->from("tareq142@gmail.com", "Shah Fuad MD. Tareq");
            $this->email->to($this->input->post("email"));
            $this->email->subject("Password Recovery");
            $this->email->message($msg);

            $this->email->send();
            echo $this->email->print_debugger();

            echo $msg;
         } else {
            $sdata['msg'] = "Account not exist";
            $this->session->set_userdata($sdata);
            $data['content'] = $this->load->view("frontend/recovery", NULL, TRUE);
            $this->load->view('master', $data);
         }
      } else {
         $data["page_title"] = "Password Recovery | nainai.com";
         $data['content'] = $this->load->view("frontend/recovery", NULL, TRUE);
         $this->load->view('master', $data);
      }
   }

//SELECT TIMESTAMPDIFF(hour, datetime, '2016-10-5 13:29:57') from user

   public function password() {
      $code = $this->uri->segment(3);
      if ($code != NULL) {
         $arr = array("reset_pass" => $code);
         $data = $this->am->recovery_pass(date("Y-m-d H:i:s"), array("reset_pass" => $code));
         if ($data) {
            foreach ($data as $v) {
               if ($v->rtime < 1) {
                  $data["page_title"] = "Password Recovery | nainai.com";
                  $data['id'] = $v->id;
                  $data['content'] = $this->load->view("frontend/recovery_success", $data, TRUE);
                  $this->load->view('master', $data);
               } else {
                  echo "Session time out";
               }
            }
         } else {
            echo "Invalid Code";
         }
      } else {
         redirect(base_url(), "refresh");
      }
   }

   public function success() {
      $dt = array(
          "password" => md5($this->input->post("pass"))
      );
      $this->am->update_data("user", $dt, array("id"=>  $this->input->post("id")));
      echo "Update Hoise";
   }

}