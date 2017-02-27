<section  class="homepage-slider" id="home-slider">
    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="<?php echo base_url() ?>themes/images/carousel/banner-1.jpg" alt="" />
            </li>
            <li>
                <img src="<?php echo base_url() ?>themes/images/carousel/banner-2.jpg" alt="" />
                <div class="intro">
                    <h1>All Fresh Food</h1>
                    <p><span>Fully Organic</span></p>
                    <p><span>Select your Choice</span></p>
                </div>
            </li>
        </ul>
    </div>			
</section>
<br><br>
<section class="main-content">
    <div class="row">
        <div class="span12">		
            <div class="row">
                <div class="span12">
                    <h4 class="title">
                        <span class="pull-left"><span class="text"><span class="line">Latest <strong>Products</strong></span></span></span>

                        <button onclick="myFunction()">Print this page</button>

                        <script>
                            function myFunction() {
                                window.print();
                            }
                        </script>

                        <span class="pull-right">
                            <a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a>
                        </span>
                    </h4>
                    <div id="myCarousel-2" class="myCarousel carousel slide">


                        <?php
                        $i = 1;
                        foreach ($allPdt as $pdt) {
                            if ($i % 3==1) {
                                echo '<div class="item">
                        <ul class="thumbnails">';
                            }
                            ?>
                            <li class="span3">
                                <div class="product-box">
                                    <span class="sale_tag"></span>
                                    <p><a href="<?php echo base_url() . Replace($pdt->name) ."/details/{$pdt->id}/" . Replace($pdt->title); ?>"><img src="<?php echo base_url() . "images/product/thumbnail/product-{$pdt->id}.{$pdt->picture}"; ?>" alt="" width="210" height="210" /></a></p>
                                    <a href="<?php echo base_url() . "product/details/{$pdt->id}/" . Replace($pdt->title); ?>" class="title"><?php echo $pdt->title; ?></a><br/>

                                    <p class="price">
                                        <?php
                                        if ($pdt->discount > 0) {
                                            ?>
                                            <span><?php echo Calculation($pdt->price, $pdt->vat, $pdt->discount); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <del><?php echo Calculation($pdt->price, $pdt->vat, 0); ?></del>
                                            <?php
                                        } else {
                                            echo Calculation($pdt->price, $pdt->vat, 0);
                                        }
                                        ?>
                                    </p>
                                </div>
                            </li>
                            <?php
                            if ($i % 3 == 0) {
                                echo " </ul>
                     </div>";
                            }
                            $i++;
                        }

                        $pg = 1;
                        if ($cur_page > 1) {
                            $pp = $cur_page - 1;
                            echo "<a href='" . base_url() . "?page={$pp}" . "' class='page-num'>PREV</a>";
                        }
                        for ($i = 1; $i <= $total; $i = $i + $per_page) {
                            if ($pg == $cur_page) {
                                echo "<a href='" . base_url() . "?page={$pg}" . "' class='active-page'>{$pg}</a>";
                            } else {
                                echo "<a href='" . base_url() . "?page={$pg}" . "' class='page-num'>{$pg}</a>";
                            }
                            $pg++;
                        }
                        if ($pg > $cur_page + 1) {
                            $pp = $cur_page + 1;
                            echo "<a href='" . base_url() . "?page={$pp}" . "' class='page-num'>NEXT</a>";
                        }
                        ?>




                    </div>
                </div>						
            </div>

        </div>				
    </div>
</section>
<section class="our_client">
    <h4 class="title"><span class="text">Manufactures</span></h4>
    <div class="row">					
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/14.png"></a>
        </div>
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/35.png"></a>
        </div>
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/1.png"></a>
        </div>
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/2.png"></a>
        </div>
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/3.png"></a>
        </div>
        <div class="span2">
            <a href="#"><img alt="" src="<?php echo base_url() ?>themes/images/clients/4.png"></a>
        </div>
    </div>
</section>