<section class="offerstack-widget  <?php echo ($is_sidebar != '') ? 'offerstack-widget-sidebar' : 'offerstack-slider' ?>">
<?php

//print_r($offers_listing['data']);die();
$offers_listing = array_slice($offers_listing['data'], 0 , ($max_iteams != '') ? $max_iteams : 8);

//for slider
$slider_page_no = 0;
$slider_classes = '';
foreach ($offers_listing as $key => $offer) {

$description_length = 150;
$offer_description = (strlen($offer['description']) > $description_length) ? (substr($offer['description'], 0, $description_length)).'...' : $offer['description'];
$promotional_text = (strlen($offer['promotional_text']) > $description_length) ? (substr($offer['promotional_text'], 0, $description_length)).'...' : $offer['promotional_text'];


$offer['image'] = isset($offer['image']) ? $offer['image'] : '';

//for slider
if(($key+1) % 3 == 1) {
    $slider_page_no++;    
    $slider_classes = " offer-slide-".$slider_page_no;

    //only show first 3 slides
    if($slider_page_no > 1) {
        $slider_classes = $slider_classes.' offer-nested-slides';    
    }

}
?>
<a class="offers--wrap offerstack-slide <?php echo $slider_classes?>" href="<?php echo $offer['link_get_offer']?>" title="">
    <div class="offer__image">
	   <img src="<?php echo str_replace("letterbox","fitup",$offer['image'])?>" alt="">
    </div>
    <?php
    if(isset($offer['advertiser']['logo_image'])) 
    {
        ?>
        <div class="provider__logo">
            <img src="<?php echo $offer['advertiser']['logo_image'];?>" alt="">
        </div>
        <?php
    }
    ?>
    <div class="offer--detail-wrap">
        <div class="offer--detail">
            <div class="offer-title"><?php echo $offer['name']?></div>
            <p class="offer-desc"><?php echo $offer_description;?></p>
        </div>
        <div class="offer--footer">
            <?php
            if((int)$offer['price']['display'] > 0) {
                ?>
                <div class="price">from <span class="amount">£<?php echo $offer['price']['display']?></span></div>
                <?php
            }
            ?>
            <div class="detail-btn">See Deals</div>
        </div>
    </div>
    <div class="ribbon">50%</div>
</a>
<?php 
}

if(!$is_sidebar && (count($offers_listing) > 3)) {
    echo "<ul class='offer-pagination'>";
    for($page=1; $page <= (count($offers_listing) / 3); $page++ )
    {
        ?>
        <li class="offer-slide-no" data-offerpageno=<?php echo $page?>></li>
        <?php
    }
    echo "</ul>";
}
?>
</section>