<AddItemRequest xmlns="urn:ebay:apis:eBLBaseComponents"> 
  <RequesterCredentials> 
    <eBayAuthToken><?= $this->ebayAuthToken ?></eBayAuthToken> 
  </RequesterCredentials> 
  <WarningLevel>High</WarningLevel> 
  <Item> 
    <CategoryMappingAllowed>true</CategoryMappingAllowed> 
    <Country><?= $this->Country ?></Country> 
    <Currency><?= $this->Currency ?></Currency> 
    <Description><![CDATA[<?= $this->Description ?>]]></Description> 
    <ListingDuration><?= $this->ListingDuration ?></ListingDuration> 
    <ListingType><?= $this->ListingType ?></ListingType> 
    <Location><?= $this->Location ?></Location> 
    <? foreach($this->PaymentMethods as $pm) { ?>
      <PaymentMethods><?= $pm ?></PaymentMethods> 
    <? } ?>
    <PayPalEmailAddress><?= $this->PayPalEmailAddress ?></PayPalEmailAddress> 
    <PrimaryCategory> 
      <CategoryID><?= $this->PrimaryCategory ?></CategoryID> 
    </PrimaryCategory> 
    <Quantity><?= $this->Quantity ?></Quantity> 
    <Site><?= $this->Site ?></Site> 
    <StartPrice currencyID="<?= $this->Currency ?>"><?= $this->StartPrice ?></StartPrice> 
    <Storefront> 
      <StoreCategoryID><?= $this->StoreCategoryID ?></StoreCategoryID> 
    </Storefront> 
    <Title><![CDATA[<?= $this->Title ?>]]></Title>
    <PictureDetails> 
      <GalleryType>Gallery</GalleryType>
    <? if ($this->PictureDetails) { 
      foreach ($this->PictureDetails as $url) {
        ?> 
            <PictureURL><?= $url ?></PictureURL>
        <?
      }
    } // end PictureDetails ?>
    </PictureDetails>
    <? if ($this->SKU) { ?>
      <SKU><?= $this->SKU ?></SKU>
    <? } // SKU ?>
    <? if ($this->ShipToLocations) { 
      foreach($this->ShipToLocations as $loc) {
        ?> <ShipToLocations><?= $loc?></ShipToLocations> <?
      }
    } // end ShipToLocations?>
    <ShippingDetails>
      <? foreach ($this->ShippingServiceOptions as $option) {
        ?>
          <ShippingServiceOptions>
            <ShippingService><?= $option['ShippingService']?></ShippingService>
            <ShippingServiceCost currencyID="<?= $this->Currency ?>"><?= $option['ShippingServiceCost']?></ShippingServiceCost>
            <ShippingServicePriority><?= $option['ShippingServicePriority']?></ShippingServicePriority>
          </ShippingServiceOptions>
        <?
      } ?>
      <? if ($this->InternationalShippingServiceOptions) { 
        foreach ($this->InternationalShippingServiceOptions as $option) {
          ?>
            <InternationalShippingServiceOption>
              <ShippingService><?= $option['ShippingService']?></ShippingService>
              <ShippingServiceCost currencyID="<?= $this->Currency ?>"><?= $option['ShippingServiceCost']?></ShippingServiceCost>
              <ShippingServicePriority><?= $option['ShippingServicePriority']?></ShippingServicePriority>
              <ShipToLocation><?= $option['ShipToLocation']?></ShipToLocation>
            </InternationalShippingServiceOption>
          <?
        }
      } ?>
    </ShippingDetails>
    <DispatchTimeMax><?= $this->DispatchTimeMax?></DispatchTimeMax>
    <ReturnPolicy>
      <ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>
      <RefundOption>MoneyBack</RefundOption>
      <ReturnsWithinOption>Days_30</ReturnsWithinOption>
      <Description>You may return items still in pristine, un-opened condition.</Description>
      <ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>
    </ReturnPolicy>
  </Item> 
</AddItemRequest> 