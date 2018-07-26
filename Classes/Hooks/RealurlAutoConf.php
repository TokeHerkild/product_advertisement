<?php
namespace Drcsystems\ProductAdvertisement\Hooks;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\ArrayUtility;

/**
 * Class RealurlAutoConf
 * @package Drcsystems\ProductAdvertisement\Hooks
 * @author toke@webto.dk
 */
class RealurlAutoConf
{

    /**
     * @param $params
     * @param $object
     * @return mixed
     */
    public function extensionConfiguration($params, &$object)
    {
        return \array_replace_recursive($params['config'], [
            'postVarSets' => [
                '_DEFAULT' => [
                    'annoncer' => [
                        [
                            'GETvar' => 'tx_productadvertisement_products[controller]',
                            'valueMap' => [
                                'products' => 'Products',
                            ],
                        ],
                        [
                            'GETvar' => 'tx_productadvertisement_products[action]',
                            'valueMap' => [
                                'vis' => 'show',
                            ],
                        ],
                        [
                            'GETvar' => 'tx_productadvertisement_products[products]',
                            'lookUpTable' => [
                                'table' => 'tx_productadvertisement_domain_model_products',
                                'id_field' => 'uid',
                                'alias_field' => 'name',
                                'useUniqueCache' => 1,
                                'useUniqueCache_conf' => [
                                    'strtolower' => 1,
                                    'spaceCharacter' => '-',
                                ],
                            ],

                        ],
                    ],
                ],
            ],
        ]);
    }

}