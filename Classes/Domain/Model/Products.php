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
 * Products
 */
class Products extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * fromdate
	 *
	 * @var \DateTime
	 */
	protected $fromdate = null;

	/**
	 * todate
	 *
	 * @var \DateTime
	 */
	protected $todate = null;

	/**
	 * crdate
	 *
	 * @var \DateTime
	 */
	protected $crdate = null;

	/**
	 * type
	 *
	 * @var int
	 */
	protected $type = 0;

	/**
	 * price
	 *
	 * @var string
	 */
	protected $price = '';

	/**
	 * ownername
	 *
	 * @var string
	 */
	protected $ownername = '';

	/**
	 * owneremail
	 *
	 * @var string
	 */
	protected $owneremail = '';

	/**
	 * ownerphone
	 *
	 * @var string
	 */
	protected $ownerphone = '';

	/**
	 * ownerzip
	 *
	 * @var string
	 */
	protected $ownerzip = '';

	/**
	 * ownerplace
	 *
	 * @var string
	 */
	protected $ownerplace = '';

	/**
	 * status
	 *
	 * @var bool
	 */
	protected $status = false;

	/**
	 * approve
	 *
	 * @var bool
	 */
	protected $approve = false;

	/**
	 * category
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\Category>
	 */
	protected $category = null;

	/**
	 * user
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $user = null;

	/**
	 * images
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\FileReference>
	 * @cascade remove
	 */
	protected $images = null;

	/**
	 * __construct
	 */
	public function __construct()
	{
		// Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects()
	{
		$this->images = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

	/**
	 * Returns the fromdate
	 *
	 * @return \DateTime $fromdate
	 */
	public function getFromdate()
	{
		return $this->fromdate;
	}

	/**
	 * Sets the fromdate
	 *
	 * @param \DateTime $fromdate
	 * @return void
	 */
	public function setFromdate(\DateTime $fromdate)
	{
		$this->fromdate = $fromdate;
	}

	/**
	 * Returns the todate
	 *
	 * @return \DateTime $todate
	 */
	public function getTodate()
	{
		return $this->todate;
	}

	/**
	 * Sets the todate
	 *
	 * @param \DateTime $todate
	 * @return void
	 */
	public function setTodate(\DateTime $todate)
	{
		$this->todate = $todate;
	}

	/**
	 * Returns the create date
	 *
	 * @return \DateTime $crdate
	 */
	public function getCrdate()
	{
		return $this->crdate;
	}

	/**
	 * Sets the crdate
	 *
	 * @param \DateTime $crdate
	 * @return void
	 */
	public function setCrdate(\DateTime $crdate)
	{
		$this->crdate = $crdate;
	}

	/**
	 * Returns the price
	 *
	 * @return string $price
	 */
	public function getPrice()
	{
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param string $price
	 * @return void
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}

	/**
	 * Returns the type
	 *
	 * @return int $type
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param int $type
	 * @return void
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * Returns the ownername
	 *
	 * @return string $ownername
	 */
	public function getOwnername()
	{
		return $this->ownername;
	}
	
	/**
	 * Sets the ownername
	 *
	 * @param string $ownername
	 * @return void
	 */
	public function setOwnername($ownername)
	{
		$this->ownername = $ownername;
	}

	/**
	 * Returns the owneremail
	 *
	 * @return string $owneremail
	 */
	public function getOwneremail()
	{
		return $this->owneremail;
	}

	/**
	 * Sets the owneremail
	 *
	 * @param string $owneremail
	 * @return void
	 */
	public function setOwneremail($owneremail)
	{
		$this->owneremail = $owneremail;
	}
	
	/**
	 * Returns the ownerphone
	 *
	 * @return string $ownerphone
	 */
	public function getOwnerphone()
	{
		return $this->ownerphone;
	}

	/**
	 * Sets the ownerphone
	 *
	 * @param string $ownerphone
	 * @return void
	 */
	public function setOwnerphone($ownerphone)
	{
		$this->ownerphone = $ownerphone;
	}

	/**
	 * Returns the ownerzip
	 *
	 * @return string $ownerzip
	 */
	public function getOwnerzip()
	{
		return $this->ownerzip;
	}

	/**
	 * Sets the ownerzip
	 *
	 * @param string $ownerzip
	 * @return void
	 */
	public function setOwnerzip($ownerzip)
	{
		$this->ownerzip = $ownerzip;
	}

	/**
	 * Returns the ownerplace
	 *
	 * @return string $ownerplace
	 */
	public function getOwnerplace()
	{
		return $this->ownerplace;
	}

	/**
	 * Sets the ownerplace
	 *
	 * @param string $ownerplace
	 * @return void
	 */
	public function setOwnerplace($ownerplace)
	{
		$this->ownerplace = $ownerplace;
	}

	/**
	 * Returns the status
	 *
	 * @return bool $status
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Sets the status
	 *
	 * @param bool $status
	 * @return void
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 * Returns the boolean state of status
	 *
	 * @return bool
	 */
	public function isStatus()
	{
		return $this->status;
	}

	/**
	 * Returns the approve
	 *
	 * @return bool $approve
	 */
	public function getApprove()
	{
		return $this->approve;
	}

	/**
	 * Sets the approve
	 *
	 * @param bool $approve
	 * @return void
	 */
	public function setApprove($approve)
	{
		$this->approve = $approve;
	}

	/**
	 * Returns the boolean state of approve
	 *
	 * @return bool
	 */
	public function isApprove()
	{
		return $this->approve;
	}

	/**
	 * Adds a Category
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category
	 * @return void
	 */
	public function addCategory(\Drcsystems\ProductAdvertisement\Domain\Model\Category $category)
	{
		$this->category->attach($category);
	}

	/**
	 * Removes a Category
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $categoryToRemove The Category to be removed
	 * @return void
	 */
	public function removeCategory(\Drcsystems\ProductAdvertisement\Domain\Model\Category $categoryToRemove)
	{
		$this->category->detach($categoryToRemove);
	}

	/**
	 * Returns the category
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\Category> $category
	 */
	public function getCategory()
	{
		return $this->category;
	}

	/**
	 * Sets the category
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\Category> $category
	 * @return void
	 */
	public function setCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $category)
	{
		$this->category = $category;
	}

	/**
	 * Returns the user
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
	 */
	public function getUser()
	{
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user
	 * @return void
	 */
	public function setUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user)
	{
		$this->user = $user;
	}

	/**
	 * Adds a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
	{
		$this->images->attach($image);
	}

	/**
	 * Removes a FileReference
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove The FileReference to be removed
	 * @return void
	 */
	public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $imageToRemove)
	{
		$this->images->detach($imageToRemove);
	}

	/**
	 * Returns the images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages()
	{
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setImages(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $images)
	{
		$this->images = $images;
	}

}