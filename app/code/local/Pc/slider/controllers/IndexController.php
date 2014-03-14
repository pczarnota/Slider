<?php

class Pc_Slider_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {
        $this->loadLayout();

        $block = $this->getLayout()->createBlock('core/template')->setTemplate('pc/slider/slider.phtml')->setData('items', $this->getRecentlyViewedProducts());
        ;

        $this->getLayout()->getBlock('left')->append($block);

        $this->renderLayout();
    }


    public function getRecentlyViewedProducts() {
        $store_id = Mage::app()->getStore()->getId();

        $collection = Mage::getSingleton('Mage_Reports_Block_Product_Viewed')->getItemsCollection()
                ->addMinimalPrice()
                ->addTaxPercents()
                ->addStoreFilter($store_id);

        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInSearchFilterToCollection($collection);

        return $collection;
    }

}