<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$lllPath = 'LLL:EXT:' . 'product_advertisement/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_attribute',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => TRUE,
        'versioningWS' => 2,
        'versioning_followPages' => TRUE,

        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => array(
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ),
        'searchFields' => 'name,caption',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('product_advertisement') . 'Resources/Public/Icons/tx_productadvertisement_domain_model_products.gif'
    ],
    'columns' => [
        'name' => [
            'exclude' => 1,
            'label' => $lllPath . 'attribute.name',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'max' => 32,
                'size' => 16
            ],
        ],
        'caption' => [
            'exclude' => 1,
            'label' => $lllPath . 'attribute.caption',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'max' => 32,
                'size' => 16
            ],
        ],
        'attribute_type' => [
            'exclude' => 1,
            'label' => $lllPath . 'attribute.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$lllPath . 'attribute.render.type.0', \Drcsystems\ProductAdvertisement\Domain\Model\AttributeInterface::ATTRIBUTE_TYPE_TEXT],
                    [$lllPath . 'attribute.render.type.1', \Drcsystems\ProductAdvertisement\Domain\Model\AttributeInterface::ATTRIBUTE_TYPE_INT],
                    [$lllPath . 'attribute.render.type.2', \Drcsystems\ProductAdvertisement\Domain\Model\AttributeInterface::ATTRIBUTE_TYPE_DATE],
                ],
            ],
        ],
        'date_format' => [
            'exclude' => 1,
            'label' => $lllPath . 'attribute.dateFormat',
            'config' => [
                'type' => 'input',
                'default' => 'd-m-Y',
                'eval' => 'trim',
            ],
        ],
        'category' => [
            'exclude' => 1,
            'label' => $lllPath . 'tx_productadvertisement_domain_model_category',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_productadvertisement_domain_model_category',
                'items' => [
                    [$lllPath . 'searchfield.default_category', 0]
                ],
            ],
        ],
    ],
    'types' => [
        0 => [
            'showitem' => 'name,caption,attribute_type,category'
        ]
    ],
    'palettes' => [],
];