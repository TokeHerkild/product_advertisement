<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$lllPath = 'LLL:EXT:' . 'product_advertisement/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl' => [
        'title'	=> 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_attributevalue',
        'label' => 'uid,attribute,product',
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
        'searchFields' => '',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('product_advertisement') . 'Resources/Public/Icons/tx_productadvertisement_domain_model_products.gif'
    ],
    'columns' => [
        'attribute' => [
            'exclude' => 1,
            'label' => $lllPath . 'tx_productadvertisement_domain_model_attribute',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_productadvertisement_domain_model_attribute',
            ],
        ],
        'product' => [
            'exclude' => 1,
            'label' => $lllPath . 'tx_productadvertisement_domain_model_products',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_productadvertisement_domain_model_products',
            ],
        ],
        'value' => [
            'exclude' => 1,
            'label' => $lllPath . 'attributeValue.value',
            'config' => [
                'type' => 'input',
                'eval' => 'trim',
                'max' => 64,
                'size' => 24
            ],
        ],
    ],
    'types' => [
        0 => [
            'showitem' => 'value,attribute,product'
        ]
    ],
    'palettes' => [],
];