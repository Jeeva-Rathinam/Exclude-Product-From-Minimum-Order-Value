<?php
class Min_Minus_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function IsSkuPresent(){
        $cart = Mage::getModel('checkout/cart')->getQuote();
        $prefferedSkus = array('paytm_test');

        foreach($cart->getAllVisibleItems() as $product){
            if (in_array($product->getSku(), $prefferedSkus)) {
                return true;
            }
        }
        return false;
    }
}