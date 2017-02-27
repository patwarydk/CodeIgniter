<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

   public function __construct() {
      parent::__construct();
      date_default_timezone_set("Asia/Dhaka");
   }

   public function index() {
      redirect(base_url(), "refresh");
   }

   public function add() {
      $sub = $this->input->post("sub");
      $id = $this->input->post("id");
      $qty = $this->input->post("qty");

      if ($sub != NULL) {
         $data = $this->am->product_stock(array("product.id" => $id));

         $stock = 0;
         $tsale = 0;
         foreach ($data as $d) {
            $stock = $d->stock;
            $tsale = $d->tsale;
         }

         $spdtid = $this->session->userdata("pdtid");
         $sqty = $this->session->userdata("qty");

         if ($spdtid) {
            $index = array_search($id, $spdtid);

            if ($index !== FALSE) {
               if ($stock >= ($tsale + $qty + $sqty[$index])) {
                  $sqty[$index] = $sqty[$index] + $qty;
                  $sdata['msg'] = "Product Updated in Cart";
               } else {
                  $sdata['msg'] = "Out of Stock";
               }
            } else {
               if ($stock >= ($tsale + $qty)) {
                  array_push($spdtid, $id);
                  array_push($sqty, $qty);
                  $sdata['msg'] = "Product Added in Cartrrr";
               } else {
                  $sdata['msg'] = "Out of Stock";
               }
            }
            $sdata['pdtid'] = $spdtid;
            $sdata['qty'] = $sqty;
         } else {
            if ($stock >= ($tsale + $qty)) {
               $sdata['pdtid'][] = $id;
               $sdata['qty'][] = $qty;
               $sdata['msg'] = "Product Added in Cart";
            } else {
               $sdata['msg'] = "Out of Stock";
            }
         }


         $this->session->set_userdata($sdata);
         redirect(base_url() . "product/details/{$id}", "refresh");
      } else {
         redirect(base_url(), "refresh");
      }
   }

   public function checkout() {
      $data = array();
      $data['page_title'] = "Product Checkout";
      $pdtid = $this->session->userdata("pdtid");
      $data['allPdt'] = $this->am->checkout($pdtid);
      $data['content'] = $this->load->view("frontend/checkout", $data, TRUE);
      $this->load->view("master", $data);
   }

   public function update() {
      $id = $this->input->post("id");
      $qty = $this->input->post("qty");

      $stock = 0;
      $tsale = 0;
      $data = $this->am->product_stock(array("product.id" => $id));
      foreach ($data as $d) {
         $stock = $d->stock;
         $tsale = $d->tsale;
      }
      $spdtid = $this->session->userdata("pdtid");
      $sqty = $this->session->userdata("qty");

      $index = array_search($id, $spdtid);
      if ($stock >= ($tsale + $qty)) {
         $sqty[$index] = $qty;
         $sdata['msg'] = "Product Updated in Cart";
         $sdata['pdtid'] = $spdtid;
         $sdata['qty'] = $sqty;
      } else {
         $sdata['msg'] = "Out of Stock";
      }
      $this->session->set_userdata($sdata);
      redirect(base_url() . "cart/checkout", "refresh");
   }

   public function delete() {
      $id = $this->input->post("id");
      echo $id;
      $spdtid = $this->session->userdata("pdtid");
      $sqty = $this->session->userdata("qty");
      $index = array_search($id, $spdtid);
      array_splice($spdtid, $index, 1);
      array_splice($sqty, $index, 1);
      $sdata['msg'] = "Item Delete Successful";
      $sdata['pdtid'] = $spdtid;
      $sdata['qty'] = $sqty;
      $this->session->set_userdata($sdata);
      redirect(base_url() . "cart/checkout", "refresh");
   }

   public function confirm() {
      $sub = $this->input->post("sub");
      if ($sub != NULL) {
         $data = array(
             "userid" => $this->session->userdata("id"),
             "address" => $this->input->post("addr"),
             "contact" => $this->input->post("contact"),
             "ddate" => $this->input->post("dtime"),
             "date" => date("Y-m-d H:i:s")
         );

         $payment = $this->input->post("payment");
         if ($payment == "Cash on Delivary") {
            $data['payment'] = $this->input->post("payment");
         } else {
            $data['payment'] = $this->input->post("tid");
         }

         if ($this->am->save_data("sales", $data)) {
            $id = $this->am->Id;

            $spdtid = $this->session->userdata("pdtid");
            $sqty = $this->session->userdata("qty");

            for ($i = 0; $i < count($spdtid); $i++) {
               $product = $this->am->view_data("product", array("id" => $spdtid[$i]), "", "");
               foreach ($product as $p) {
                  $vat = $p->vat;
                  $dis = $p->discount;
               }

               $ddata = array(
                   "productid" => $spdtid[$i],
                   "vat" => $vat,
                   "discount" => $dis,
                   "quantity" => $sqty[$i],
                   "salesid" => $id
               );
               $this->am->save_data("salesdetails", $ddata);
            }
         }
         $this->session->unset_userdata("pdtid");
         $this->session->unset_userdata("qty");
         
         redirect(base_url(), "refresh");
      }
   }

}
