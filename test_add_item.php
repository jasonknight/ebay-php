<?php
  include_once "ebay.php";
  $item = new EbayCall("AddItem","/var/www/ebay/config.php");
  $picURL = "http://www.images.stamp-collectors-network.net/large_images";

  $item->Description = $desc;
  $item->ListingDuration = 'GTC';
  if (strlen($product->name) > 80) {
    $product->name = substr($product->name,0,79);
  }
  $item->Title = $product->name;
  $item->Currency = 'GBP';
  $item->ListingType = 'FixedPriceItem';
  $item->Quantity = $product->count_on_hand;
  echo "SETTING ITEM PRICE TO: {$product->price}\n";
  $item->StartPrice = $product->price;
  $item->Country = 'GB';
  $item->Location = '-- not given --';
  $item->SKU = $product->image_number;
  $item->DispatchTimeMax = 3;
  
  $item->StoreCategoryID = $category->ebay_store_category;
  
  $item->PrimaryCategory = $category->ebay_category;
  
  $item->Site = 'UK';
  
  $item->PaymentMethods = array('PayPal');
  $item->PayPalEmailAddress = 'ebay@philatelic.co.uk';
  $item->PictureDetails = array("$picURL/" . $product->image_number . ".jpg");
  
  $ShipToLocations = array();
  $ShipToLocations[] = "GB";
  $ShipToLocations[] = "Europe";
  $ShipToLocations[] = "Worldwide";
  $item->ShipToLocations = $ShipToLocations;
  
  $localShippingOptions = array(
      'UK_RoyalMailFirstClassStandard' => 1,
      'UK_RoyalMailSpecialDeliveryNextDay' => 6.50
  );
  $p = 1;
  $ShippingServiceOptions = array();
  foreach ($localShippingOptions as $k=>$v) {
      $option = array('ShippingService' => $k, 'ShippingServiceCost' => $v,'ShippingServicePriority' => $p );
      $ShippingServiceOptions[] = $option;
      $p++;
  }
  $item->ShippingServiceOptions = $ShippingServiceOptions;
  
  
  $intlShipping = array(
        'UK_RoyalMailAirmailInternational' => array ( 
            'Europe' => 2.50,
            'Worldwide' => 2.50
            ),
      'UK_RoyalMailInternationalSignedFor' => array (
            'Europe' => 8,
            'Worldwide' => 8,
        )
    );
  $pr = 1;
  $InternationalShippingServiceOptions = array();
  foreach ($intlShipping as $method=>$arr) {
    foreach ($arr as $loc=>$price) {
      $option = array('ShippingService' => $method, 'ShippingServiceCost' => $price,'ShippingServicePriority' => $pr, 'ShipToLocation' =>  $loc );
      $InternationalShippingServiceOptions[] = $option;
      $pr++;
    }
  }
  $item->InternationalShippingServiceOptions = $InternationalShippingServiceOptions;
  echo "Item built.\n";
?>
