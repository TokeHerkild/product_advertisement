<?php
namespace Drcsystems\ProductAdvertisement\Domain\Model;

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

/**
 * Users
 */
class Users extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
{
	/**
	 * username
	 *
	 * @var string
	 */
	protected $username = '';

	/**
	 * Returns the username
	 *
	 * @return string $username
	 */
	public function getusername()
	{
		return $this->username;
	}

	/**
	 * Sets the username
	 *
	 * @param string $username
	 * @return void
	 */
	public function setusername($username)
	{
		$this->username = $username;
	}
}