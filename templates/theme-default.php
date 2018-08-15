<section class="offerstack-widget <?php echo ($is_sidebar != '')?'offerstack-widget-sidebar':'' ?>">
<?php

//print_r($offers_listing['data']);die();
$offers_listing = array_slice($offers_listing['data'], 0 , ($max_iteams != '') ? $max_iteams : 8);

foreach ($offers_listing as $key => $offer) {

$offer_description = (strlen($offer['description']) > 300) ? (substr($offer['description'], 0, 300)).'...' : $offer['description'];
$promotional_text = (strlen($offer['promotional_text']) > 300) ? (substr($offer['promotional_text'], 0, 300)).'...' : $offer['promotional_text'];


?>
<div class="offers__wrap">
    <div class="data-table">
        <div class="col provider">
            <div class="ribbon"><span class="num"><?php echo ($key+1)?></span></div>
            <?php
            if(isset($offer['advertiser']['logo_image'])) 
            {
            	?>
            	<img class="provider-logo" src="<?php echo $offer['advertiser']['logo_image'];?>" alt="">
            	<?php
            }
            ?>	
            <a href="<?php echo $offer['link_get_offer']?>" title="" target="_blank" rel="nofollow"><img class="holiday-img" src="<?php echo $offer['image'] ?>" alt=""></a>
        </div>
        <div class="col detail">
            <a href="<?php echo $offer['link_get_offer']?>" title="" target="_blank" rel="nofollow" rel="nofollow"><div class="detail-title"><?php echo $offer['name']?></div></a>
            <p><?php echo $offer_description;?></p>
        </div>
       

        <?php 
        if ( isset($offer['price']) || isset($offer['is_featured']) ) 
        {
    	?>
        <div class="col price">

            <?php if(isset($offer['is_featured']))
            {	
            	?>
            	<span class="deal-highlight">Editor's Pick</span>
            	<?php
			}

			if($offer['price']['display'] > 0)
			{
            ?>
            <div class="price-content">
                <?php
                if($offer['price']['display'] !=  $offer['price']['rrp'])
            	{	
	                if($offer['price']['rrp'] > 0)
	                {
                		?>
                		<span class="rrp">RRP: £ <?php echo $offer['price']['rrp']?></span>
                		<?php
					}

					if($offer['price']['saving'] > 0)
					{
	                	?>
	                	<span class="saving">save: £ <?php echo $offer['price']['saving']?></span>
	                	<?php
					}
				}		
	        	?>
	        <span class="deal-price">£ <?php echo $offer['price']['display']?></span>
            </div>
            <?php
			}
            ?>
            <a href="<?php echo $offer['link_get_offer']?>" class="deal-btn" title="" target="_blank" rel="nofollow">See Deals</a>
        </div>
        <?php
		}
        ?>
    </div>
</div>
<?php 
}
?>
</section>