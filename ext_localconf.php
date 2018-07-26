<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Drcsystems.' . $_EXTKEY,
	'Products',
	array(
		'Products' => 'list, show, new, search, searchMeFirst, hide, create, edit, update, delete, userproducts, inquiry, sendMessage',
		
	),
	// non-cacheable actions
	array(
		'Products' => 'create, edit, update, delete, search, searchMeFirst, userproducts, hide, showProduct, list, inquiry, sendMessage',
		
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Drcsystems\\ProductAdvertisement\\Property\\TypeConverter\\UploadedFileReferenceConverter');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter('Drcsystems\\ProductAdvertisement\\Property\\TypeConverter\\ObjectStorageConverter');

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/realurl/class.tx_realurl_autoconfgen.php']['extensionConfiguration']['product_advertisement'] =
    \Drcsystems\ProductAdvertisement\Hooks\RealurlAutoConf::class . '->extensionConfiguration';