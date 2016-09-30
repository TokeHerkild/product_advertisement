<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'Drcsystems.' . $_EXTKEY,
	'Products',
	'Products'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'Drcsystems.' . $_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'modproducts',	// Submodule key
		'',						// Position
		array(
			'Products' => 'searchBack, editMod, updateMod, delete, approve, disapprove, newCategory, createCategory, editCategory, updateCategory, deleteCategory, searchFirst',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_modproducts.xlf',
		)
	);

}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Products Advertisement');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productadvertisement_domain_model_category', 'EXT:product_advertisement/Resources/Private/Language/locallang_csh_tx_productadvertisement_domain_model_category.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productadvertisement_domain_model_category');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_productadvertisement_domain_model_products', 'EXT:product_advertisement/Resources/Private/Language/locallang_csh_tx_productadvertisement_domain_model_products.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_productadvertisement_domain_model_products');

$extensionName = \TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY);

// Front-end Plugin Name
$frontendpluginName = 'Products'; 
// Register a flexform
$pluginSignature = strtolower($extensionName) . '_' . strtolower($frontendpluginName);
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/pluginConfiguration.xml');