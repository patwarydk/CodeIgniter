<section class="header_text sub">
    <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
    <h4><span>New Product Enty Form</span></h4>
</section>
<section class="main-content">
    <div class="row">
        <div class="span6 title">
            <b>Insert Your New Porduct</b>
        </div>
        <div class="span6">					
            <h4 class="title"><span class="text"><strong>Product</strong> New</span></h4>
            <form class=" ">
            <?php
                //https://www.codeigniter.com/userguide3/libraries/form_validation.html
            
                $dt = $this->session->userdata("msg");
                if($dt != NULL){
                   echo $dt;
                   $this->session->unset_userdata("msg");
                }
            
                echo validation_errors();
            
                $action = base_url() . "product_management/insert";
                $attr = array(
                    "enctype" => "multipart/form-data",
                    "class" => "Kaj-kore-na"
                );
                echo form_open($action, $attr);
                
                //Title 
                echo form_label("Title");
                $data = array(
                    "name"=>"title",
                    "placeholder"=>"Product Title",
                    "class"=>"input-xlarge",
                    "value" => set_value("title")
                );
                echo form_input($data);
                
                //Descriptiopn 
                echo form_label("Descriptiopn");
                $data = array(
                    "name"=>"descr",
                    "placeholder"=>"Product Descriptiopn",
                    "class"=>"input-xlarge",
                    "value" => set_value("descr")
                );
                echo form_textarea($data);
                
                //Price 
                echo form_label("Price");
                $data = array(
                    "name"=>"price",
                    "placeholder"=>"Product Price",
                    "class"=>"input-xlarge",
                    "value" => set_value("price")
                );
                echo form_input($data);
                
                //Stock 
                echo form_label("Stock");
                $data = array(
                    "name"=>"stock",
                    "placeholder"=>"Product Stock",
                    "class"=>"input-xlarge",
                    "value" => set_value("stock")
                );
                echo form_input($data);
                
                //Category
                echo form_label("Category");
                $data = array();
                $data[] = "Select Category";
                foreach ($allCat as $c){
                    $data[$c->id] = $c->name;
                }
                echo form_dropdown("catid", $data);
                
                //Type 
                echo form_label("Product Type");
                $data = array(
                    "name"=>"type",
                    "class"=>"input-xlarge"
                );
                echo form_radio($data, "Natural") . "Natural<br />";
                echo form_radio($data, "Downloabile") . "Downloabile";
                
                
                //Picture 
                echo form_label("Picture");
                $data = array(
                    "name"=>"pic",
                    "class"=>"input-xlarge"
                );
                echo form_upload($data);
                
                //Submit
                echo "<br /><br />";
                $data = array(
                    "name"=>"sub",
                    "value"=>"Save",
                    "class"=>"input-xlarge"
                );
                echo form_submit($data);
                
                echo form_close();
            ?>
          </form>
        </div>        
    </div>
</section>

