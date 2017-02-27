<section class="header_text sub">
    <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
    <h4><span>Login or Regsiter</span></h4>
</section>
<section class="main-content">				
    <div class="row">
        <div class="span12">					
            <h4 class="title"><span class="text"><strong>Product</strong> New</span></h4>
            <?php
                //https://www.codeigniter.com/userguide3/libraries/form_validation.html
            
                $dt = $this->session->userdata("msg");
                if($dt != NULL){
                   echo $dt;
                   $this->session->unset_userdata("msg");
                }
            
                echo validation_errors();
            
                $action = base_url() . "add_product_management/insert";
                $attr = array(
                    "enctype" => "multipart/form-data",
                    "class" => "Kaj-kore-na"
                );
                echo form_open($action, $attr);
               
                //Category
                echo form_label("Product Title");
                $data = array();
                $data[] = "Select Product";
                foreach ($allPdt as $c){
                    $data[$c->id] = $c->title . " - " . $c->price;
                }
                echo form_dropdown("pdtid", $data);
                
                //Stock 
                echo form_label("Stock");
                $data = array(
                    "name"=>"stock",
                    "placeholder"=>"Product Stock",
                    "class"=>"input-xlarge",
                    "value" => set_value("stock")
                );
                echo form_input($data);                
                
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
        </div>        
    </div>
</section>

