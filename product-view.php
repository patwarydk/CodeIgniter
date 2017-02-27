<section class="header_text sub">
    <img class="pageBanner" src="themes/images/pageBanner.png" alt="New products" >
    <h4><span>Login or Regsiter</span></h4>
</section>
<section class="main-content">				
    <div class="row">
        <div class=" span12">					
            <h4 class="title"><span class="text"><strong>Product</strong> View</span></h4>
            <?php
            $dt = $this->session->userdata("msg");
            if ($dt != NULL) {
                echo $dt;
                $this->session->unset_userdata("msg");
            }
            ?>
            <table border="1" cellpadding="5" width="90%" align="center">
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Vat</th>
                    <th>Discount</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Picture</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                <?php
                if ($allPdt) {
                    foreach ($allPdt as $pdt) {
                        ?>
                        <tr>
                            <td><?php echo $pdt->title; ?></td>
                            <td><?php echo $pdt->price; ?></td>
                            <td><?php echo $pdt->vat; ?></td>
                            <td><?php echo $pdt->discount; ?></td>
                            <td><?php echo $pdt->name; ?></td>
                            <td><?php echo $pdt->stock + $pdt->apStock - $pdt->tsale; ?></td>
                            <td>
                                <?php
                                if (file_exists("images/product/thumbnail/product-{$pdt->id}.{$pdt->picture}")) {
                                    echo "<img src='" . base_url() . "images/product/thumbnail/product-{$pdt->id}.{$pdt->picture}" . "' width='70' />";
                                }
                                ?>
                            </td>
                            <td><a href="<?php echo base_url() . "product-management/edit/{$pdt->id}" ?>">Edit</a></td>
                            <td><a href="<?php echo base_url() . "product-management/delete/{$pdt->id}" ?>">Delete</a></td>
                           
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>    
            <?php
            ?>
        </div>        
    </div>
</section>

