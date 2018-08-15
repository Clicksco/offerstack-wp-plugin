<section class="offerstack-widget <?php echo ($is_sidebar != '')?'offerstack-widget-sidebar':'' ?>">
<?php

//print_r($offers_listing['data']);die();
$offers_listing = array_slice($offers_listing['data'], 0 , ($max_iteams != '') ? $max_iteams : 8);

foreach ($offers_listing as $key => $offer) {

$description_length = 150;
$offer_description = (strlen($offer['description']) > $description_length) ? (substr($offer['description'], 0, $description_length)).'...' : $offer['description'];
$promotional_text = (strlen($offer['promotional_text']) > $description_length) ? (substr($offer['promotional_text'], 0, $description_length)).'...' : $offer['promotional_text'];


$offer['image'] = isset($offer['image']) ? $offer['image'] : '';
?>
<a class="offers--wrap" href="<?php echo $offer['link_get_offer']?>" title="">
    
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
    
    <div class="offer--detail">
        <h2 class="offer-title"><?php echo $offer['name']?></h2>
        <p class="offer-desc"><?php echo $offer_description;?></p>
    </div>

    <div class="offer--footer">
        <div class="price">from <span class="amount">£<?php echo $offer['price']['display']?></span></div>
        <div class="detail-btn">See Deals</div>
    </div>

    <div class="ribbon">50%</div>
</a>
<?php 
}
?>
</section>