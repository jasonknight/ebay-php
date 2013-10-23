<EndItemRequest xmlns="urn:ebay:apis:eBLBaseComponents">
  <RequesterCredentials>
    <eBayAuthToken><?= $this->ebayAuthToken ?></eBayAuthToken>
  </RequesterCredentials>
  <ItemID ComplexType="ItemIDType"><?= $this->ItemID ?></ItemID>
  <EndingReason EnumType="EndReasonCodeType"><?= $this->EndingReason ?></EndingReason>
</EndItemRequest>​