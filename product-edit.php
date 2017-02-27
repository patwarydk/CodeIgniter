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

            

            echo validation_errors();

            foreach ($selPdt as $pdt) {
                
                $hidden = array("id"=>$pdt->id);
                $action = base_url() . "product_management/update";
                $attr = array(
                    "enctype" => "multipart/form-data",
                    "class" => "Kaj-kore-na"
                );
                echo form_open($action, $attr, $hidden);

                //Title 
                echo form_label("Title");
                $data = array(
                    "name" => "title",
                    "placeholder" => "Product Title",
                    "class" => "input-xlarge",
                    "value" => $pdt->title
                );
                echo form_input($data);

                //Descriptiopn 
                echo form_label("Descriptiopn");
                $data = array(
                    "name" => "descr",
                    "placeholder" => "Product Descriptiopn",
                    "class" => "input-xlarge",
                    "value" => $pdt->description
                );
                echo form_textarea($data);

                //Category
                echo form_label("Category");
                $data = array();
                $data[] = "Select Category";
                foreach ($allCat as $c) {
                    $data[$c->id] = $c->name;
                }
                echo form_dropdown("catid", $data, $pdt->categoryid);

                //Type 
                echo form_label("Product Type");
                $data = array(
                    "name" => "type",
                    "class" => "input-xlarge"
                );
                if ($pdt->type == "V") {
                    echo form_radio($data, "V", TRUE) . "Virtual<br />";
                    echo form_radio($data, "D") . "Downloabile";
                }
                else{
                    echo form_radio($data, "V") . "Virtual<br />";
                    echo form_radio($data, "D", TRUE) . "Downloabile";
                }
                

                //form_r
                //Picture 
                echo form_label("Picture");
                $data = array(
                    "name" => "pic",
                    "class" => "input-xlarge"
                );
                echo form_upload($data);

                //Submit
                echo "<br /><br />";
                $data = array(
                    "name" => "sub",
                    "value" => "Update",
                    "class" => "input-xlarge"
                );
                echo form_submit($data);

                echo form_close();
            }
            ?>
        </div>        
    </div>
</section>

