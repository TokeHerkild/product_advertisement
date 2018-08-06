<?php
namespace Drcsystems\ProductAdvertisement\Service;


use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

class RegionService
{

    /**
     * @return array
     */
    public function getRegionList()
    {
        $regions = [];
        for ($i=0; $i<10; $i++) {
            $region = [
                'id' => $i,
                'label' => $this->translate('products.ownerRegion.I.' . $i),
            ];
            $regions[] = $region;
        }
        return $regions;
    }

    /**
     * @param string $key
     * @return string
     */
    public function translate($key) {
        $label = LocalizationUtility::translate($key, 'ProductAdvertisement');
        return !empty($label) ? $label : $key;
    }

}