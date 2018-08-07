<?php

/**
* OfferStack Token
*
* used inside offerstack.php
* variables are passsed from parent file
*/


$offerstack_api_key="";
$offerstack_api_endpoint="https://api.offerstack.io/v1/offers?query=".urlencode($offer_keyword).'&'.additional_param($widget_identifier);

?>