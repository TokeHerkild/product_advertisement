<?php
namespace Drcsystems\ProductAdvertisement\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 
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
 * Test case for class Drcsystems\ProductAdvertisement\Controller\ProductsController.
 *
 */
class ProductsControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Drcsystems\ProductAdvertisement\Controller\ProductsController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Drcsystems\\ProductAdvertisement\\Controller\\ProductsController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllProductssFromRepositoryAndAssignsThemToView()
	{

		$allProductss = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$productsRepository = $this->getMock('Drcsystems\\ProductAdvertisement\\Domain\\Repository\\ProductsRepository', array('findAll'), array(), '', FALSE);
		$productsRepository->expects($this->once())->method('findAll')->will($this->returnValue($allProductss));
		$this->inject($this->subject, 'productsRepository', $productsRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('productss', $allProductss);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenProductsToView()
	{
		$products = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('products', $products);

		$this->subject->showAction($products);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenProductsToProductsRepository()
	{
		$products = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();

		$productsRepository = $this->getMock('Drcsystems\\ProductAdvertisement\\Domain\\Repository\\ProductsRepository', array('add'), array(), '', FALSE);
		$productsRepository->expects($this->once())->method('add')->with($products);
		$this->inject($this->subject, 'productsRepository', $productsRepository);

		$this->subject->createAction($products);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenProductsToView()
	{
		$products = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('products', $products);

		$this->subject->editAction($products);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenProductsInProductsRepository()
	{
		$products = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();

		$productsRepository = $this->getMock('Drcsystems\\ProductAdvertisement\\Domain\\Repository\\ProductsRepository', array('update'), array(), '', FALSE);
		$productsRepository->expects($this->once())->method('update')->with($products);
		$this->inject($this->subject, 'productsRepository', $productsRepository);

		$this->subject->updateAction($products);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenProductsFromProductsRepository()
	{
		$products = new \Drcsystems\ProductAdvertisement\Domain\Model\Products();

		$productsRepository = $this->getMock('Drcsystems\\ProductAdvertisement\\Domain\\Repository\\ProductsRepository', array('remove'), array(), '', FALSE);
		$productsRepository->expects($this->once())->method('remove')->with($products);
		$this->inject($this->subject, 'productsRepository', $productsRepository);

		$this->subject->deleteAction($products);
	}
}
