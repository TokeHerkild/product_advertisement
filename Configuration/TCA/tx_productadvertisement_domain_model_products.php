<?php
$yoastPrefix = 'LLL:EXT:' . 'yoast_seo/Resources/Private/Language/BackendModule.xlf:';
$lllPath = 'LLL:EXT:' . 'product_advertisement/Resources/Private/Language/locallang_db.xlf:';

return array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products',
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
		'searchFields' => 'name,images,description,fromdate,todate,price,type,ownername,owneremail,ownerphone,ownerzip,ownerplace,status,approve,category,user,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('product_advertisement') . 'Resources/Public/Icons/tx_productadvertisement_domain_model_products.gif'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, name, images, description, fromdate, todate, price, type, ownername, owneremail, ownerphone, ownerzip, ownerplace, status, approve, category, user',
	),
	'types' => array(
		'1' => [
		    'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, name, images,'
                        . 'description, fromdate, todate, price, type, ownername, owneremail, ownerphone, ownerzip,'
                        . 'ownerplace, status, approve, category, user,'
                        . '--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime,'
                        . '--div--;Attributes, attributes,'
                        . '--div--;Yoast SEO, tx_yoastseo_focuskeyword, tx_yoastseo_snippetpreview, tx_yoastseo_readability_analysis'
        ],
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
	
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_productadvertisement_domain_model_products',
				'foreign_table_where' => 'AND tx_productadvertisement_domain_model_products.pid=###CURRENT_PID### AND tx_productadvertisement_domain_model_products.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),

		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
	
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),

		'name' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'images' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.images',
			'config' => 
			\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'images',
				array(
					'appearance' => array(
						'createNewRelationLinkTitle' => 'LLL:EXT:' . 'cms/locallang_ttc.xlf:images.addFileReference'
					),
					'foreign_types' => array(
						'0' => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						),
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => array(
							'showitem' => '
							--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
							--palette--;;filePalette'
						)
					),
					'maxitems' => 8
				),
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			),

		),
		'description' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.description',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 15,
				'eval' => 'trim'
			)
		),
		'crdate' => array(
			'exclude' => 1,
			'label' => $lllPath . 'tx_productadvertisement_domain_model_products.crdate',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'fromdate' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.fromdate',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		'todate' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.todate',
			'config' => array(
				'dbType' => 'date',
				'type' => 'input',
				'size' => 7,
				'eval' => 'date',
				'checkbox' => 0,
				'default' => '0000-00-00'
			),
		),
		'price' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.price',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'type' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.type',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'items' => array(
					array('LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:product_registration.typeLable', 0),
					array('LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:product_registration.search', 1),
					array('LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:product_registration.offer', 2)
				),
				'size' => 1,
				'maxitems' => 1,
				'eval' => ''
			),
		),
		'ownername' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.ownername',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'owneremail' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.owneremail',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ownerphone' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.ownerphone',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ownerzip' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.ownerzip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'ownerplace' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.ownerplace',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'owner_region' => [
		    'exclude' => 1,
            'label' => $lllPath . 'products.ownerRegion',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [$lllPath . 'products.ownerRegion.I.0', 0],
                    [$lllPath . 'products.ownerRegion.I.1', 1],
                    [$lllPath . 'products.ownerRegion.I.2', 2],
                    [$lllPath . 'products.ownerRegion.I.3', 3],
                    [$lllPath . 'products.ownerRegion.I.4', 4],
                    [$lllPath . 'products.ownerRegion.I.5', 5],
                    [$lllPath . 'products.ownerRegion.I.6', 6],
                    [$lllPath . 'products.ownerRegion.I.7', 7],
                    [$lllPath . 'products.ownerRegion.I.8', 8],
                    [$lllPath . 'products.ownerRegion.I.9', 9],
                ],
                'default' => 0,
            ],
        ],
		'status' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.status',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'approve' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.approve',
			'config' => array(
				'type' => 'check',
				'default' => 0
			)
		),
		'category' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.category',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectMultipleSideBySide',
				'foreign_table' => 'tx_productadvertisement_domain_model_category',
				'MM' => 'tx_productadvertisement_products_category_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'module' => array(
							'name' => 'wizard_edit',
						),
						'type' => 'popup',
						'title' => 'Edit',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'module' => array(
							'name' => 'wizard_add',
						),
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_productadvertisement_domain_model_category',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
					),
				),
			),
		),
		'user' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:product_advertisement/Resources/Private/Language/locallang_db.xlf:tx_productadvertisement_domain_model_products.user',
			'config' => array(
				'type' => 'select',
				'renderType' => 'selectSingle',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'attributes' => [
		    'label' => $lllPath . 'products.attributes',
            'exclude' => 1,
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_productadvertisement_domain_model_attributevalue',
                'foreign_field' => 'product',
            ],
        ],
		'tx_yoastseo_snippetpreview' => [
		    'label' => $yoastPrefix . 'snippetPreview',
            'exclude' => true,
            //'displayCond' => 'REC:NEW:false',
            'config' => [
                'type' => 'text',
                'renderType' => 'snippetPreview',
                'settings' => [
                    'titleField' => 'name',
                    'descriptionField' => 'description'
                ],
            ]
        ],
        'tx_yoastseo_readability_analysis' => [
            'label' => $yoastPrefix . 'analysis',
            'exclude' => true,
            'config' => [
                'type' => 'input',
                'renderType' => 'readabilityAnalysis',
            ]
        ],
        'tx_yoastseo_focuskeyword' => [
            'label' => $yoastPrefix . 'seoFocusKeyword',
            'exclude' => true,
            'config' => [
                'type' => 'input',
            ],
        ]
	),
);