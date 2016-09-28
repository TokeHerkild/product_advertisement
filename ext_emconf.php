<?php

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

$EM_CONF[$_EXTKEY] = array(
	'title' => 'DRC Product Advertisement',
	'description' => 'Product advertisement extension. Classified the advertisement in different categories with image upload and product details and search functionality. Front-end user can add, edit or disable the advertisement. Every activities notified by email. Nice back-end module is also available for the management',
	'category' => 'plugin',
	'author' => 'DRC Systems India PVT.LTD.',
	'author_email' => 'info@drcsystems.com',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => '0',
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'version' => '1.1.2',
	'constraints' => array(
		'depends' => array(
			'typo3' => '7.6.0-7.6.99',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);