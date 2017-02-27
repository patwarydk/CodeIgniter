<section class="main-content">				
   <div class="row">
      <div class="span9">					
         <h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
         <?php
         $msg = $this->session->userdata("msg");
         if ($msg != NULL) {
            echo $msg;
            $this->session->unset_userdata("msg");
         }
         ?>
         <?php
         $total = 0;
         $pdtid = $this->session->userdata("pdtid");
         $qty = $this->session->userdata("qty");
         if ($pdtid) {
            ?>
            <table class="table table-striped">
               <thead>
                  <tr>
                     <th>Product Name</th>
                     <th>Quantity</th>
                     <th>Unit Price</th>
                     <th>Vat</th>
                     <th>Discount</th>
                     <th>Total</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  for ($i = 0; $i < count($pdtid); $i++) {
                     foreach ($allPdt as $pdt) {
                        if ($pdtid[$i] == $pdt->id) {
                           ?>
                           <tr>
                              <td><?php echo $pdt->title; ?></td>
                              <td>
                                 <form action="<?php echo base_url() ?>cart/update" method="post">
                                    <input type="hidden" name="id" value="<?php echo $pdtid[$i] ?>" />   
                                    <input type="number" name="qty" value="<?php echo $qty[$i] ?>" placeholder="1" class="input-mini">
                                    <input type="submit" name="sub" value="U" class="btn btn-inverse" />
                                 </form>
                                 <form action="<?php echo base_url() ?>cart/delete" method="post">
                                    <input type="hidden" name="id" value="<?php echo $pdtid[$i] ?>" />                                    
                                    <input type="submit" name="sub" value="D" class="btn btn-inverse" />
                                 </form>
                              </td>
                              <td><?php echo $pdt->price ?></td>
                              <td><?php echo $pdt->vat ?></td>
                              <td><?php echo $pdt->discount ?></td>
                              <td>
                                 <?php
                                 $t = (Calculation($pdt->price, $pdt->vat, $pdt->discount) * $qty[$i]);
                                 echo $t;
                                 $total += $t;
                                 ?>

                              </td>
                           </tr>			  
                           <?php
                           break;
                        }
                     }
                  }
                  ?>
                  <tr>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td>&nbsp;</td>
                     <td><strong><?php echo $total; ?></strong></td>
                  </tr>		  
               </tbody>
            </table>
            <?php
            $type = $this->session->userdata("type");
            if ($type != NULL) {
               ?>
               <form action="<?php echo base_url() ?>cart/confirm" method="post">
                  <input type="text" name="addr" class="input-large" placeholder="Shipping Address" /><br />
                  <input type="text" name="contact" class="input-large" placeholder="Contact Number" /><br /> 
                  <input type="radio" name="payment" value="Cash on Delivary" checked="" id="cod" />Cash on Delivary &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="payment" value="bkash" id="bkash" />bKash
                  <br />
                  <input type="text" name="tid" id="tid" class="input-large" placeholder="Transaction Id" /><br />
                  
                  <select name="dtime">
                     <option value="8AM-9AM">8AM-9AM</option>
                     <option value="9AM-10AM">9AM-10AM</option>
                     <option value="10AM-11AM">10AM-11AM</option>
                     <option value="11AM-12PM">11AM-12PM</option>
                  </select>
                  <br />
                  <input type="submit" name="sub" class="btn btn-success" value="Confirm" />
               </form>
               <?php
            } else {
               echo "For Purchase, Please Login";
            }
         } else {
            echo "No item found in Cart";
         }
         ?>

      </div>
      <div class="span3 col">
         <div class="block">	
            <ul class="nav nav-list">
               <li class="nav-header">SUB CATEGORIES</li>
               <li><a href="products.html">Nullam semper elementum</a></li>
               <li class="active"><a href="products.html">Phasellus ultricies</a></li>
               <li><a href="products.html">Donec laoreet dui</a></li>
               <li><a href="products.html">Nullam semper elementum</a></li>
               <li><a href="products.html">Phasellus ultricies</a></li>
               <li><a href="products.html">Donec laoreet dui</a></li>
            </ul>
            <br/>
            <ul class="nav nav-list below">
               <li class="nav-header">MANUFACTURES</li>
               <li><a href="products.html">Adidas</a></li>
               <li><a href="products.html">Nike</a></li>
               <li><a href="products.html">Dunlop</a></li>
               <li><a href="products.html">Yamaha</a></li>
            </ul>
         </div>
         <div class="block">
            <h4 class="title">
               <span class="pull-left"><span class="text">Randomize</span></span>
               <span class="pull-right">
                  <a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
               </span>
            </h4>
            <div id="myCarousel" class="carousel slide">
               <div class="carousel-inner">
                  <div class="active item">
                     <ul class="thumbnails listing-products">
                        <li class="span3">
                           <div class="product-box">
                              <span class="sale_tag"></span>												
                              <a href="product_detail.html"><img alt="" src="<?php echo base_url() ?>themes/images/ladies/2.jpg"></a><br/>
                              <a href="product_detail.html" class="title">Fusce id molestie massa</a><br/>
                              <a href="#" class="category">Suspendisse aliquet</a>
                              <p class="price">$261</p>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <div class="item">
                     <ul class="thumbnails listing-products">
                        <li class="span3">
                           <div class="product-box">												
                              <a href="product_detail.html"><img alt="" src="<?php echo base_url() ?>themes/images/ladies/4.jpg"></a><br/>
                              <a href="product_detail.html" class="title">Tempor sem sodales</a><br/>
                              <a href="#" class="category">Urna nec lectus mollis</a>
                              <p class="price">$134</p>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>						
      </div>
   </div>
</section>
<script>
   $(document).ready(function() {
      $("#tid").hide();
      $('#cod').click(function() {
         if ($('#cod').is(':checked')) {
            $("#tid").hide();
         }
      });

      $('#bkash').click(function() {
         if ($('#bkash').is(':checked')) {
            $("#tid").show();
         }
      });
   });

</script>





















