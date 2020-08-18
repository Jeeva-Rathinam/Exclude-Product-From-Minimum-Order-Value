<?php
class Min_Minus_Model_Quote_Address extends Mage_Sales_Model_Quote_Address
{
    public function validateMinimumAmount()
    {
        $helper = Mage::helper('minus');
        $isSkuPresent = $helper->IsSkuPresent();
        $storeId = $this->getQuote()->getStoreId();
        if (!Mage::getStoreConfigFlag('sales/minimum_order/active', $storeId)) {
            return true;
        }

        if ($this->getQuote()->getIsVirtual() && $this->getAddressType() == self::TYPE_SHIPPING) {
            return true;
        } elseif (!$this->getQuote()->getIsVirtual() && $this->getAddressType() != self::TYPE_SHIPPING) {
            return true;
        }

        $amount = Mage::getStoreConfig('sales/minimum_order/amount', $storeId);
        if ($this->getBaseSubtotalWithDiscount() < $amount && !($isSkuPresent)) {
            return false;
        }
        return true;
    }
}