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
            
                $action = base_url() . "report";
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
                
                //Price1 
                echo form_label("Price1");
                $data = array(
                    "name"=>"price1",
                    "placeholder"=>"Product Price1",
                    "class"=>"input-xlarge",
                    "value" => set_value("price1")
                );
                echo form_input($data);
                
                //Start Date 
                echo form_label("Start Date");
                $data = array(
                    "name"=>"date1",
                    "placeholder"=>"Start Date",
                    "class"=>"input-xlarge",
                    "value" => set_value("date1")
                );
                echo form_input($data);
                
                //End Date 
                echo form_label("End Date");
                $data = array(
                    "name"=>"date2",
                    "placeholder"=>"End Date",
                    "class"=>"input-xlarge",
                    "value" => set_value("date2")
                );
                echo form_input($data);
                
                //Price2 
                echo form_label("Price2");
                $data = array(
                    "name"=>"price2",
                    "placeholder"=>"Product Price2",
                    "class"=>"input-xlarge",
                    "value" => set_value("price2")
                );
                echo form_input($data);
                
                //Category
                echo form_label("Category");
                $data = array();
                $data[] = "All Category";
                foreach ($allCat as $c){
                    $data[$c->id] = $c->name;
                }
                echo form_dropdown("catid", $data);
                
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

