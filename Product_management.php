<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_management extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->model("amader_model", "am", TRUE);
      $type = $this->session->userdata("type");
      if ($type != 'a' && $type != 'e') {
         redirect(base_url(), "refresh");
      }
   }

   public function index() {
      $data = array();
      $this->load->helper("form");           
      $data['allCat'] = $this->am->view_data("category", "", "name", "asc");
      $data["page_title"] = "Product Management | bazar.com";
      $data['content'] = $this->load->view("backend/product-new", $data, TRUE);
      $this->load->view('master', $data);
   }

   public function insert() {
      $this->load->library("form_validation");

      $this->form_validation->set_rules("title", "Title", "required|trim|max_length[30]");
      $this->form_validation->set_rules("descr", "Description", "required");

      if ($this->form_validation->run() == TRUE) {

         if ($_FILES['pic']['name'] != NULL) {
            $ext = pathinfo($_FILES['pic']['name']);
            $ext = strtolower($ext['extension']);
            if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
               $ext = "";
            }
         } else {
            $ext = "";
         }
         $data = array(
             "title" => $this->input->post("title"),
             "description" => $this->input->post("descr"),
             "categoryid" => $this->input->post("catid"),
             "price" => $this->input->post("price"),
             "stock" => $this->input->post("stock"),
             "type" => $this->input->post("type"),
             "picture" => $ext
         );
         if ($this->am->save_data("product", $data)) {

            //Image Upload Start
            $config = array();
            $config['upload_path'] = "./images/product/";   //destination of image folder --'./product/'
            $config['allowed_types'] = 'gif|jpg|jpeg|png';  //supported image
            $config['max_size'] = 10000;   //Maximum size in kilo bite -- '10000'
            $config['max_width'] = 3000;   // image width -- '2000'
            $config['max_height'] = 3000;  // image height -- '1500'
            $config['file_name'] = "product-{$this->am->Id}.{$ext}";  // image file name in destination folder -- "2.jpg"
            $this->load->library('upload');
            $this->upload->initialize($config); //upload image data
            $this->upload->do_upload("pic"); // upload image file 
            //Image Crop Start
            $image_info = getimagesize("images/product/product-{$this->am->Id}.{$ext}");
            $w = $image_info[0];
            $h = $image_info[1];

            if (.77 < ($h / $w)) {
               $width = $w;
               $height = $w * .77;
               $x_axis = 0;
               $y_axis = ($h - $height) / 2;
            } else {
               $width = $h * 1.29;
               $height = $h;
               $x_axis = ($w - $width) / 2;
               $y_axis = 0;
            }
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = "images/product/product-{$this->am->Id}.{$ext}";
            $config['new_image'] = "images/product/crop/";
            ;
            $conf['create_thumb'] = TRUE;
            $conf['thumb_marker'] = "";
            $config['rotation_angle'] = '90';
            $config['x_axis'] = $x_axis;
            $config['y_axis'] = $y_axis;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = $width;
            $config['height'] = $height;
            //print_r($config);
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            $this->image_lib->clear();

            //Thumbnail Creator
            $this->load->library('image_lib');
            $config['source_image'] = "images/product/crop/product-{$this->am->Id}.{$ext}";
            $config['new_image'] = "images/product/thumbnail/";
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 210;
            $config['height'] = 210;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();


            //Watermark an Image
            $image_cfg = array();
            $image_cfg['image_library'] = 'GD2';
            $image_cfg['source_image'] = "images/product/crop/product-{$this->am->Id}.{$ext}";
            $image_cfg['wm_type'] = 'overlay';
            $image_cfg['wm_overlay_path'] = "images/product/crop/wt.png";
            $image_cfg['wm_vrt_alignment'] = 'top';
            $image_cfg['wm_hor_alignment'] = 'center';
            $image_cfg['wm_opacity'] = '20%';
            $image_cfg['create_thumb'] = FALSE;

            $this->load->library('image_lib');
            $this->image_lib->initialize($image_cfg);
            $this->image_lib->watermark();
            $this->image_lib->clear();

            $sdata["msg"] = "Save Successful";
         } else {
            $sdata["msg"] = "Not Save";
         }
         $this->session->set_userdata($sdata);
         redirect(base_url() . "product_management", "refresh");
      } else {
         $data = array();
         $this->load->helper("form");
         $data['allCat'] = $this->am->view_data("category", "", "name", "asc");
         $data["page_title"] = "Product Management | bazar.com";
         $data['content'] = $this->load->view("backend/product-new", $data, TRUE);
         $this->load->view('master', $data);
      }
   }

   public function view() {
      $data = array();
      $data['page_title'] = "View Product | bazar.com";
      $data['allPdt'] = $this->am->view_product("");
      $data['content'] = $this->load->view("backend/product-view", $data, TRUE);
      $this->load->view('master', $data);
   }

   public function edit() {
      $id = $this->uri->segment(3);
      $this->load->helper("form");
      $data['allCat'] = $this->am->view_data("category", "", "name", "asc");
      $data['selPdt'] = $this->am->view_product(array("product.id" => $id));
      //print_r($data['selPdt']);
      $data["page_title"] = "Product Edit | bazar.com";
      $data['content'] = $this->load->view("backend/product-edit", $data, TRUE);
      $this->load->view('master', $data);
   }

   public function update() {
      $id = $this->input->post("id");
      $selPdt = $this->am->view_product(array("product.id" => $id));
      foreach ($selPdt as $pdt) {
         $old_ext = $pdt->picture;
      }

      if ($_FILES['pic']['name'] != NULL) {
         $ext = pathinfo($_FILES['pic']['name']);
         $ext = strtolower($ext['extension']);
         if ($ext != "jpg" && $ext != "png" && $ext != "gif" && $ext != "jpeg") {
            $ext = $old_ext;
         } else {
            if (file_exists("images/product/product-{$id}.{$old_ext}")) {
               unlink("images/product/product-{$id}.{$old_ext}");
            }
            if (file_exists("images/product/crop/product-{$id}.{$old_ext}")) {
               unlink("images/product/crop/product-{$id}.{$old_ext}");
            }
            if (file_exists("images/product/thumbnail/product-{$id}.{$old_ext}")) {
               unlink("images/product/thumbnail/product-{$id}.{$old_ext}");
            }

            //Image Upload Start
            $config = array();
            $config['upload_path'] = "./images/product/";   //destination of image folder --'./product/'
            $config['allowed_types'] = 'gif|jpg|jpeg|png';  //supported image
            $config['max_size'] = 10000;   //Maximum size in kilo bite -- '10000'
            $config['max_width'] = 3000;   // image width -- '2000'
            $config['max_height'] = 3000;  // image height -- '1500'
            $config['file_name'] = "product-{$id}.{$ext}";  // image file name in destination folder -- "2.jpg"
            $this->load->library('upload');
            $this->upload->initialize($config); //upload image data
            $this->upload->do_upload("pic"); // upload image file 
            //Image Crop Start
            $image_info = getimagesize("images/product/product-{$id}.{$ext}");
            $w = $image_info[0];
            $h = $image_info[1];

            if (.77 < ($h / $w)) {
               $width = $w;
               $height = $w * .77;
               $x_axis = 0;
               $y_axis = ($h - $height) / 2;
            } else {
               $width = $h * 1.29;
               $height = $h;
               $x_axis = ($w - $width) / 2;
               $y_axis = 0;
            }
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = "images/product/product-{$id}.{$ext}";
            $config['new_image'] = "images/product/crop/";
            ;
            $conf['create_thumb'] = TRUE;
            $conf['thumb_marker'] = "";
            $config['rotation_angle'] = '90';
            $config['x_axis'] = $x_axis;
            $config['y_axis'] = $y_axis;
            $config['maintain_ratio'] = FALSE;
            $config['width'] = $width;
            $config['height'] = $height;
            //print_r($config);
            $this->image_lib->initialize($config);
            $this->image_lib->crop();
            $this->image_lib->clear();

            //Thumbnail Creator
            $this->load->library('image_lib');
            $config['source_image'] = "images/product/crop/product-{$id}.{$ext}";
            $config['new_image'] = "images/product/thumbnail/";
            $config['maintain_ratio'] = FALSE;
            $config['width'] = 270;
            $config['height'] = 210;
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
            $this->image_lib->clear();


            //Watermark an Image
            $image_cfg = array();
            $image_cfg['image_library'] = 'GD2';
            $image_cfg['source_image'] = "images/product/crop/product-{$id}.{$ext}";
            $image_cfg['wm_type'] = 'overlay';
            $image_cfg['wm_overlay_path'] = "images/product/crop/wt.png";
            $image_cfg['wm_vrt_alignment'] = 'top';
            $image_cfg['wm_hor_alignment'] = 'center';
            $image_cfg['wm_opacity'] = '20%';
            $image_cfg['create_thumb'] = FALSE;

            $this->load->library('image_lib');
            $this->image_lib->initialize($image_cfg);
            $this->image_lib->watermark();
            $this->image_lib->clear();
         }
      } else {
         $ext = $old_ext;
      }

      $data = array(
          "title" => $this->input->post("title"),
          "description" => $this->input->post("descr"),
          "categoryid" => $this->input->post("catid"),
          "type" => $this->input->post("type"),
          "picture" => $ext
      );

      $data2 = array("id" => $id);

      if ($this->am->update_data("product", $data, $data2)) {
         $sdata["msg"] = "Update Successful";
      } else {
         $sdata["msg"] = "Not Updated";
      }
      $this->session->set_userdata($sdata);
      redirect(base_url() . "product_management/view", "refresh");
   }

   public function delete() {
      $id = $this->uri->segment(3);
      $selPdt = $this->am->view_product(array("product.id" => $id));
      foreach ($selPdt as $pdt) {
         $old_ext = $pdt->picture;
      }
      if (file_exists("images/product/product-{$id}.{$old_ext}")) {
         unlink("images/product/product-{$id}.{$old_ext}");
      }
      if (file_exists("images/product/crop/product-{$id}.{$old_ext}")) {
         unlink("images/product/crop/product-{$id}.{$old_ext}");
      }
      if (file_exists("images/product/thumbnail/product-{$id}.{$old_ext}")) {
         unlink("images/product/thumbnail/product-{$id}.{$old_ext}");
      }

      if ($this->am->delete_data("product", array("id" => $id))) {
         $sdata["msg"] = "Delete Successful";
      } else {
         $sdata["msg"] = "Not Deleted";
      }
      $this->session->set_userdata($sdata);
      redirect(base_url() . "product_management/view", "refresh");
   }

}
