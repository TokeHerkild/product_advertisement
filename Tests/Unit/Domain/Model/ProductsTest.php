<?php

namespace Drcsystems\ProductAdvertisement\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case for class \Drcsystems\ProductAdvertisement\Domain\Model\Products.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class ProductsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \Drcsystems\ProductAdvertisement\Domain\Model\Products
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName()
	{
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForFileReference()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getImages()
		);
	}

	/**
	 * @test
	 */
	public function setImagesForFileReferenceSetsImages()
	{
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$objectStorageHoldingExactlyOneImages = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneImages->attach($image);
		$this->subject->setImages($objectStorageHoldingExactlyOneImages);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneImages,
			'images',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addImageToObjectStorageHoldingImages()
	{
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$imagesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$imagesObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($image));
		$this->inject($this->subject, 'images', $imagesObjectStorageMock);

		$this->subject->addImage($image);
	}

	/**
	 * @test
	 */
	public function removeImageFromObjectStorageHoldingImages()
	{
		$image = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$imagesObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$imagesObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($image));
		$this->inject($this->subject, 'images', $imagesObjectStorageMock);

		$this->subject->removeImage($image);

	}

	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription()
	{
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFromdateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getFromdate()
		);
	}

	/**
	 * @test
	 */
	public function setFromdateForDateTimeSetsFromdate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setFromdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'fromdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTodateReturnsInitialValueForDateTime()
	{
		$this->assertEquals(
			NULL,
			$this->subject->getTodate()
		);
	}

	/**
	 * @test
	 */
	public function setTodateForDateTimeSetsTodate()
	{
		$dateTimeFixture = new \DateTime();
		$this->subject->setTodate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'todate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInt()
	{	}

	/**
	 * @test
	 */
	public function setTypeForIntSetsType()
	{	}

	/**
	 * @test
	 */
	public function getOwnernameReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOwnername()
		);
	}

	/**
	 * @test
	 */
	public function setOwnernameForStringSetsOwnername()
	{
		$this->subject->setOwnername('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ownername',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOwneremailReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOwneremail()
		);
	}

	/**
	 * @test
	 */
	public function setOwneremailForStringSetsOwneremail()
	{
		$this->subject->setOwneremail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'owneremail',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOwnerphoneReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOwnerphone()
		);
	}

	/**
	 * @test
	 */
	public function setOwnerphoneForStringSetsOwnerphone()
	{
		$this->subject->setOwnerphone('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ownerphone',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOwnerzipReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOwnerzip()
		);
	}

	/**
	 * @test
	 */
	public function setOwnerzipForStringSetsOwnerzip()
	{
		$this->subject->setOwnerzip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ownerzip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOwnerplaceReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getOwnerplace()
		);
	}

	/**
	 * @test
	 */
	public function setOwnerplaceForStringSetsOwnerplace()
	{
		$this->subject->setOwnerplace('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ownerplace',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStatusReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getStatus()
		);
	}

	/**
	 * @test
	 */
	public function setStatusForBoolSetsStatus()
	{
		$this->subject->setStatus(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'status',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getApproveReturnsInitialValueForBool()
	{
		$this->assertSame(
			FALSE,
			$this->subject->getApprove()
		);
	}

	/**
	 * @test
	 */
	public function setApproveForBoolSetsApprove()
	{
		$this->subject->setApprove(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'approve',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCategoryReturnsInitialValueForCategory()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getCategory()
		);
	}

	/**
	 * @test
	 */
	public function setCategoryForObjectStorageContainingCategorySetsCategory()
	{
		$category = new \Drcsystems\ProductAdvertisement\Domain\Model\Category();
		$objectStorageHoldingExactlyOneCategory = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneCategory->attach($category);
		$this->subject->setCategory($objectStorageHoldingExactlyOneCategory);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneCategory,
			'category',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addCategoryToObjectStorageHoldingCategory()
	{
		$category = new \Drcsystems\ProductAdvertisement\Domain\Model\Category();
		$categoryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$categoryObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($category));
		$this->inject($this->subject, 'category', $categoryObjectStorageMock);

		$this->subject->addCategory($category);
	}

	/**
	 * @test
	 */
	public function removeCategoryFromObjectStorageHoldingCategory()
	{
		$category = new \Drcsystems\ProductAdvertisement\Domain\Model\Category();
		$categoryObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$categoryObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($category));
		$this->inject($this->subject, 'category', $categoryObjectStorageMock);

		$this->subject->removeCategory($category);

	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForFrontendUser()
	{	}

	/**
	 * @test
	 */
	public function setUserForFrontendUserSetsUser()
	{	}
}
