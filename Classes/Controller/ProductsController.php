<?php
namespace Drcsystems\ProductAdvertisement\Controller;


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

use Drcsystems\ProductAdvertisement\Domain\Model\Products;
use Drcsystems\ProductAdvertisement\Property\TypeConverter\UploadedFileReferenceConverter;
use TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

/**
 * ProductsController
 */
class ProductsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

	/**
	 * Repository object of products
	 *
	 * @var \Drcsystems\ProductAdvertisement\Domain\Repository\ProductsRepository
	 * @inject
	 */
	protected $productsRepository = NULL;

	/**
	 * Repository object of product category
	 *
	 * @var \Drcsystems\ProductAdvertisement\Domain\Repository\CategoryRepository
	 * @inject
	 */
	protected $categoryRepository = NULL;

	/**
	 * Repository object of frontend users
	 *
	 * @var \Drcsystems\ProductAdvertisement\Domain\Repository\UsersRepository
	 * @inject
	 */
	protected $usersRepository = NULL;


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->userUid = $GLOBALS['TSFE']->fe_user->user['uid'];
	}

	/**
	 * Display list of advertisements
	 *
	 * @return void
	 */
	public function listAction()
	{ 

		// Get Sorting Configuration     
		$sorting = $this->configureSorting();
		$maxProducts = $this->settings['maxAdsPerPage'];
		// Pagination Cofiguration
		if ($maxProducts != '') {
			$paginateConfiguration = array('itemsPerPage' => $maxProducts, 'insertAbove' => 0, 'insertBelow' => 1);
		} else {
			$paginateConfiguration = array('insertAbove' => 0, 'insertBelow' => 0);
		}
		$this->view->assign('configure', $paginateConfiguration);
		// Detail Page Id
		$detailPage = $this->settings['detailPageId'];
		$this->view->assign('detailPageId', $detailPage);
		
		// Fetch Products
		$products = $this->productsRepository->findProducts($sorting);
		$this->view->assign('product', $products);
	} 

	/**
	 * Check user Login
	 *
	 * @return void
	 */
	public function initializeUserproductsAction(){
		if (!isset($this->userUid)) {
			$uri = $this->uriBuilder->reset()->setTargetPageUid($this->settings['listPageId'])->build();
			$this->redirectToUri($uri);
		}
	}

	/**
	 * Generates user wise list of advertisement 
	 *
	 * @return void
	 */
	public function userproductsAction()
	{
		$userParams = array();
		$sorting = $this->configureSorting();
		$maxProducts = $this->settings['maxAdsPerPage'];
		if ($maxProducts != '') {
			$paginateConfiguration = array('itemsPerPage' => $maxProducts, 'insertAbove' => 0, 'insertBelow' => 1);
		} else {
			$paginateConfiguration = array('insertAbove' => 0, 'insertBelow' => 0);
		}
		$this->view->assign('configure', $paginateConfiguration);
		$userParams['userUid'] = $this->userUid;
		$userParams += $sorting;
		$userWiseProducts = $this->productsRepository->findProductByUser($userParams);
		$this->view->assign('userProducts', $userWiseProducts);
		$this->view->assign('createProduct', $this->settings['createPageId']);
	}

	/**
	 * Check Argument Set
	 *
	 * @return void
	 */
	public function initializeShowAction(){
		$getArgs = $this->request->getArguments();
		if(!$getArgs['controller']){
			$uri = $this->uriBuilder->reset()->setTargetPageUid($this->settings['listPageId'])->build();
			$this->redirectToUri($uri);
		}
	}

	/**
	 * Display single product detail
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 * @return void
	 */
	public function showAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$this->view->assign('products', $products);
		$this->view->assign('listPage', $this->settings['listPageId']);
	}

	/**
	 * Check user Login
	 *
	 * @return void
	 */
	public function initializeNewAction(){
		if (!isset($this->userUid)) {
			$uri = $this->uriBuilder->reset()->setTargetPageUid($this->settings['listPageId'])->build();
			$this->redirectToUri($uri);
		}
	}

	/**
	 * Action new
	 *
	 * @return void
	 */
	public function newAction()
	{
		// Fetch All Categories
		$productCategory = $this->categoryRepository->findAll();
		// Fetch user
        $user = $this->usersRepository->findByUid($this->userUid);
		$this->view->assign('categories', $productCategory);
		$this->view->assign('user', $user);
	}

	/**
	 * Set TypeConverter option for image upload While Create
	 *
	 * @return void
	 */
	public function initializeCreateAction()
	{
		if (isset($this->arguments['newProducts'])) {
			$this->arguments['newProducts']
			->getPropertyMappingConfiguration()
			->forProperty('fromdate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');

			$this->arguments['newProducts']
			->getPropertyMappingConfiguration()
			->forProperty('todate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');
		}
		$this->setTypeConverterConfigurationForImageUpload('newProducts');
	}

	/**
	 * Action create
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $newProducts 
	 * @return void
	 */
	public function createAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $newProducts)
	{            
		if (isset($this->userUid) && !$newProducts->getUser()) {
			$user = $this->usersRepository->findByUid($this->userUid);
			$newProducts->setUser($user);
			$newProducts->setStatus(1);
			$this->productsRepository->add($newProducts);

			// Send Mail To user Product Created Successfully
			$mailConfig['configure'] = array(
				'mailto'=>$user->getEmail(),
				'mailFrom'=>$this->settings['emailAdmin'],
				'username'=>$user->getUsername(),
				'productName' => $newProducts->getName(),
			);
			$this->productCreateMail($mailConfig);

			// Notify Admin Product Created
			$adminMailConfig['configure'] = array(
				'mailto'=>$this->settings['emailAdmin'],
				'mailFrom'=>$this->settings['emailAdmin'],
				'username'=>$user->getUsername(),
				'productName' => $newProducts->getName(),  
			);
			$this->notifyAdminProductCreate($adminMailConfig);

			$uriBuilder = $this->controllerContext->getUriBuilder();
			$this->uriBuilder->setCreateAbsoluteUri(true);
			$this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
			$uri = $uriBuilder->build();
			$this->redirectToUri($uri);
		}
		if ($newProducts->getUser()) {
            $this->productsRepository->add($newProducts);

            // Send Mail To user Product Created Successfully
            $mailConfig['configure'] = array(
                'mailto'=>$newProducts->getUser()->getEmail(),
                'mailFrom'=>$this->settings['emailAdmin'],
                'username'=>$newProducts->getUser()->getUsername(),
                'productName' => $newProducts->getName(),
            );
            $this->productCreateMail($mailConfig);

            // Notify Admin Product Created
            $adminMailConfig['configure'] = array(
                'mailto'=>$this->settings['emailAdmin'],
                'mailFrom'=>$this->settings['emailAdmin'],
                'username'=>$newProducts->getUser()->getUsername(),
                'productName' => $newProducts->getName(),
            );
            $this->notifyAdminProductCreate($adminMailConfig);

            $uriBuilder = $this->controllerContext->getUriBuilder();
            $this->uriBuilder->setCreateAbsoluteUri(true);
            $this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
            $uri = $uriBuilder->build();
            $this->redirectToUri($uri);
        }
	}

	/**
	 * Action edit
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 * @return void
	 */
	public function editAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$this->view->assign('products', $products);
		$this->view->assign('maxImages', $this->getImageRest(8, $products));
		$productCategory = $this->categoryRepository->findAll();
		$this->view->assign('categories', $productCategory);
	}

	/**
	 * Set TypeConverter option for image upload while update
	 *
	 * @return void
	 */
	public function initializeUpdateAction()
	{
		if (isset($this->arguments['products'])) {
			$this->arguments['products']
			->getPropertyMappingConfiguration()
			->forProperty('fromdate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');

			$this->arguments['products']
			->getPropertyMappingConfiguration()
			->forProperty('todate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');
		}
		$this->setTypeConverterConfigurationForImageUpload('products');
	}

	/**
	 * Action update
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function updateAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		if(isset($this->userUid)){
			$products->setApprove(0);

			$this->productsRepository->update($products);

			// Send Mail To user Product Updated Successfully
			$mailConfig['configure'] = array(
				'mailto'=>$products->getUser()->getEmail(),
				'mailFrom'=>$this->settings['emailAdmin'],
				'username'=>$products->getUser()->getUsername(),
				'productName' => $products->getName(),
			);
			$this->productUpdateMail($mailConfig);

			// Notify Admin Product Updated
			$adminMailConfig['configure'] = array(
				'mailto'=>$this->settings['emailAdmin'],
				'mailFrom'=>$this->settings['emailAdmin'],
				'username'=>$products->getUser()->getUsername(),
				'productName' => $products->getName(),  
			);
			$this->notifyAdminProductUpdate($adminMailConfig);

			$uriBuilder = $this->controllerContext->getUriBuilder();
			$this->uriBuilder->setCreateAbsoluteUri(true);
			$this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
			$uri = $uriBuilder->build();
			$this->redirectToUri($uri);
		}
	}

	/**
	 * Action delete
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function deleteAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$this->productsRepository->remove($products);
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$this->uriBuilder->setCreateAbsoluteUri(true);
		$this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}

	/**
	 * Action hide - frontend can hide advertisement from others
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function hideAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$products->setStatus(0);
		$this->productsRepository->update($products);
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$this->uriBuilder->setCreateAbsoluteUri(true);
		$this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}

	/**
	 * Action showProduct - frontend can show advertisement from others
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function showProductAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{        
		$products->setStatus(1);       
		$this->productsRepository->update($products);
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$this->uriBuilder->setCreateAbsoluteUri(true);
		$this->uriBuilder->setTargetPageUid($this->settings['myListPageId']);
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}

	/**
	 * Generate URL for Search
	 *
	 * @return void
	 */
	public function searchMeFirstAction()
	{
		$postArgs = $this->request->getArguments();
		$searchParam = array();
		if (!empty($postArgs['productName'])) {
			$searchParam['productName'] = $postArgs['productName'];
		}
		if (!empty($postArgs['place'])) {
			$searchParam['place'] = $postArgs['place'];
		}
		if (!empty($postArgs['category'])) {
			$searchParam['category'] = $postArgs['category'];
		}
		if (!empty($postArgs['fromdate'])) {
			$searchParam['fromdate'] = $postArgs['fromdate'];
		}
		if (!empty($postArgs['todate'])) {
			$searchParam['todate'] = $postArgs['todate'];
		}
		if (!empty($postArgs['type'])) {
			$searchParam['type'] = $postArgs['type'];
		}
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uriBuilder->reset();
		$uriBuilder->setArguments(array(
			'tx_productadvertisement_search' => array(
				'action' => 'search',
				'controller' => 'Product',
				'filter' => $searchParam
			)
		));
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}
	/**
	 * Advance search 
	 *
	 * @return void
	 */
	public function searchAction()
	{
		$getArgs = array();
		$setArgs = array();
		if(GeneralUtility::_GET('tx_productadvertisement_search')){
			$setArgs += GeneralUtility::_GET('tx_productadvertisement_search');
			if($setArgs['filter']){
				$getArgs = $setArgs['filter'];
			}
		}
		$maxProducts = $this->settings['maxAdsPerPage'];
		if (count($this->configureSorting()) > 0) {
			$getArgs += $this->configureSorting();
		}
		// Pagination Cofiguration
		if ($maxProducts != '') {
			$paginateConfiguration = array('itemsPerPage' => $maxProducts, 'insertAbove' => 0, 'insertBelow' => 1);
		} else {
			$paginateConfiguration = array('insertAbove' => 0, 'insertBelow' => 0);
		}
		$this->view->assign('configure', $paginateConfiguration);
		
		// Fetch Products
		$products = $this->productsRepository->findProducts($getArgs);
		
		// Fetch All Categories
		//$productCategory = $this->categoryRepository->findAll();
        $productCategory = $this->categoryRepository->findAllParents();

		// Auto Fill Input Fields;
		if (isset($getArgs['productName'])) {
			$this->view->assign('productName', $getArgs['productName']);
		}
		if (isset($getArgs['place'])) {
			$this->view->assign('place', $getArgs['place']);
		}
		if (isset($getArgs['category'])) {
			$this->view->assign('categoryUid', $getArgs['category']);
		}
		if (!empty($getArgs['fromdate'])) {
			$this->view->assign('fromdate', $getArgs['fromdate']);
		}
		if (!empty($getArgs['todate'])) {
			$this->view->assign('todate', $getArgs['todate']);
		}
		if (!empty($getArgs['type'])) {
			$this->view->assign('productType', $getArgs['type']);
		}
		$this->view->assign('product', $products);
		$this->view->assign('categories', $productCategory);
		$this->view->assign('detailPage', $this->settings['detailPageId']);
		$this->view->assign('listPage', $this->settings['listPageId']);
	}

	/**
	 * Advertisement inquiry
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function inquiryAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$this->view->assign('products', $products);
	}

	/**
	 * Inquiry form for send inquiry message
	 * 
	 * @return void
	 */
	public function sendMessageAction()
	{
		$messageArgs = $this->request->getArguments();

		$mailConfig['configure'] = array(
			'mailto'=>$messageArgs['message']['userEmail'],
			'mailFrom'=>$this->settings['emailAdmin'],  
			'product'=>$messageArgs['message']['product'],
			'username'=>$messageArgs['message']['userName'],
			'inquiryUserName'=>$messageArgs['message']['name'],
			'inquiryUserEmail'=>$messageArgs['message']['email'],
			'inquiryUserContact'=>$messageArgs['message']['telephone'],
			'inquiryMessage'=>$messageArgs['message']['message'],
		);

		// Send Inquiry notification to user
		$this->sendInquiry($mailConfig);

		$mailConfig['configure'] = array(
			'mailto'=>$messageArgs['message']['email'],
			'mailFrom'=>$this->settings['emailAdmin'],  
			'product'=>$messageArgs['message']['product'],
			'username'=>$messageArgs['message']['name'],
		);

		// Send 
		$this->replyInquiry($mailConfig);

		$uriBuilder = $this->controllerContext->getUriBuilder();
		$this->uriBuilder->setCreateAbsoluteUri(true);
		$this->uriBuilder->setTargetPageUid($this->settings['listPageId']);
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}

	/**
	 * Function for get sorting configuration
	 *
	 * @return array
	 */
	public function configureSorting()
	{
		$sorting = array();
		$sortField = $this->settings['sortField'];
		$sortOrder = $this->settings['sortDirection'];
		// Set Fieldname for Sorting
		if ($sortField) {
			$sorting['fieldName'] = $sortField;
		} else {
			$sorting['fieldName'] = 'crdate';
		}
		// Set Soring Order
		if ($sortOrder) {
			$sorting += array('order' => $sortOrder);
		} else {
			$sorting += array('order' => 'asc');
		}
		return $sorting;
	}

	/**
	 * Backend Plugin Module's Actions
	 */

	/**
	 * Setting up URL for search
	 * action searchFirst
	 *
	 * @return void
	 */
	public function searchFirstAction(){
		$postArgs = $this->request->getArguments();
		$searchParam = array();
		if (!empty($postArgs['productName'])) {
			$searchParam['productName'] = $postArgs['productName'];
		}
		if (!empty($postArgs['place'])) {
			$searchParam['place'] = $postArgs['place'];
		}
		if (!empty($postArgs['category'])) {
			$searchParam['category'] = $postArgs['category'];
		}
		if (!empty($postArgs['fromdate'])) {
			$searchParam['fromdate'] = $postArgs['fromdate'];
		}
		if (!empty($postArgs['todate'])) {
			$searchParam['todate'] = $postArgs['todate'];
		}
		if (isset($postArgs['approved'])) {
			$searchParam['approved'] = $postArgs['approved'];
		}
		$uriBuilder = $this->controllerContext->getUriBuilder();
		$uriBuilder->reset();
		$uriBuilder->setArguments(array(
			'tx_productadvertisement_searchBack' => array(
				'action' => 'searchBack',
				'controller' => 'Product',
				'filter' => $searchParam
			)
		));
		$uri = $uriBuilder->build();
		$this->redirectToUri($uri);
	}


	/**
	 * This action display all advertisements at backend module (Manage Products) and provide advance search option
	 *
	 * @return void
	 */
	public function searchBackAction()
	{   
		$getArgs = array();
		
		if(GeneralUtility::_GET('tx_productadvertisement_searchBack')){
			$getParams = GeneralUtility::_GET('tx_productadvertisement_searchBack');
			if($getParams['filter']){
				$getArgs = $getParams['filter'];
			}
		}

		$maxProducts = 10;
		$paginateConfiguration = array('itemsPerPage' => $maxProducts, 'insertAbove' => 0, 'insertBelow' => 1);
		$this->view->assign('configure', $paginateConfiguration);
		// Get Categories
		$productCategory = $this->categoryRepository->findAll();
		$this->view->assign('categories', $productCategory);

		// Auto Fill Input Fields;
		if (isset($getArgs['productName'])) {
			$this->view->assign('productName', $getArgs['productName']);
		}
		if (isset($getArgs['place'])) {
			$this->view->assign('place', $getArgs['place']);
		}
		if (isset($getArgs['category'])) {
			$this->view->assign('categoryUid', $getArgs['category']);
		}
		if (isset($getArgs['fromdate'])) {
			$this->view->assign('fromdate', $getArgs['fromdate']);
		}
		if (isset($getArgs['todate'])) {
			$this->view->assign('todate', $getArgs['todate']);
		}
		if (isset($getArgs['approved'])) {
			$this->view->assign('approved', $getArgs['approved']);
		}

		// Fetch Products
		$products = $this->productsRepository->searchProducts($getArgs);
		$this->view->assign('product', $products);
	}

	/**
	 * Action edit at backend module
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function editModAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$this->view->assign('products', $products);
		$productCategory = $this->categoryRepository->findAll();
		$this->view->assign('categories', $productCategory);
	}

	/**
	 * Set TypeConverter option for image upload while update
	 *
	 * @return void
	 */
	public function initializeUpdateModAction()
	{
		if (isset($this->arguments['products'])) {
			$this->arguments['products']
			->getPropertyMappingConfiguration()
			->forProperty('fromdate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');

			$this->arguments['products']
			->getPropertyMappingConfiguration()
			->forProperty('todate')
			->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
			\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,'Y-m-d');
		}
		$this->setTypeConverterConfigurationForImageUpload('products');
	}

	/**
	 * Action update at backend module
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function updateModAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$products->setApprove(0);
		$this->productsRepository->update($products);

		// Send Mail To user Product Updated Successfully
		$mailConfig['configure'] = array(
			'mailto'=>$products->getUser()->getEmail(),
			'mailFrom'=>$this->settings['emailAdmin'],
			'username'=>$products->getUser()->getUsername(),
			'productName' => $products->getName(),
		);
		$this->notifyUserProductUpdateByAdmin($mailConfig);

		$this->redirect('searchBack');
	}

	/**
	 * Approve User Product Advertisement
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function approveAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$products->setApprove(1);
		$this->productsRepository->update($products);

		// Send Mail To user Product Approved Successfully
		$mailConfig['configure'] = array(
			'mailto'=>$products->getUser()->getEmail(),
			'mailFrom'=>$this->settings['emailAdmin'],  
			'username'=>$products->getUser()->getUsername(),
			'productName' => $products->getName(),
		);
		$this->productActivate($mailConfig);

		$this->redirect('searchBack');
	}

	/**
	 * Action disapprove 
	 * Deactivate User Product Advertisement
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products 
	 *
	 * @return void
	 */
	public function disapproveAction(\Drcsystems\ProductAdvertisement\Domain\Model\Products $products)
	{
		$products->setApprove(0);
		$this->productsRepository->update($products);
		// Send Mail To user Product Disapproved Successfully
		$mailConfig['configure'] = array(
			'mailto'=>$products->getUser()->getEmail(),
			'mailFrom'=>$this->settings['emailAdmin'],
			'username'=>$products->getUser()->getUsername(),
			'productName' => $products->getName(),
		);
		$this->productDeactivate($mailConfig);

		$this->redirect('searchBack');
	}

	/**
	 * Generate new categories
	 * New Category Form
	 * @return void
	 */
	public function newCategoryAction()
	{
		$paginateConfiguration = array('itemsPerPage' => 20, 'insertAbove' => 0, 'insertBelow' => 1);
		$this->view->assign('configure', $paginateConfiguration);

		$categoryList = $this->categoryRepository->findAll();
		$this->view->assign('categories', $categoryList);
	}

	/**
	 * Action createCategory 
	 * Create new Category
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $newCategory 
	 * @return void
	 */
	public function createCategoryAction(\Drcsystems\ProductAdvertisement\Domain\Model\Category $newCategory)
	{
		$this->categoryRepository->add($newCategory);
		$this->redirect('newCategory');
	}

	/**
	 * Edit category form 
	 *
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category 
	 *
	 * @return void
	 */
	public function editCategoryAction(\Drcsystems\ProductAdvertisement\Domain\Model\Category $category)
	{
		$this->view->assign('category', $category);
	}

	/**
	 * Action updateCategory 
	 * update Exsisting Category
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category 
	 * @return void
	 */
	public function updateCategoryAction(\Drcsystems\ProductAdvertisement\Domain\Model\Category $category)
	{
		$this->categoryRepository->update($category);
		$this->redirect('newCategory');
	}

	/**
	 * Action deleteCategory 
	 * Delete Exsisting Category
	 * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category 
	 * @return void
	 */
	public function deleteCategoryAction(\Drcsystems\ProductAdvertisement\Domain\Model\Category $category)
	{
		$this->categoryRepository->remove($category);
		$this->redirect('newCategory');
	}

	/**
	 * Arguments
	 * @param mixed $argumentName 
	 * @return void
	 */
	protected function setTypeConverterConfigurationForImageUpload($argumentName)
	{
		$uploadConfiguration = array(
			UploadedFileReferenceConverter::CONFIGURATION_ALLOWED_FILE_EXTENSIONS => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
			UploadedFileReferenceConverter::CONFIGURATION_UPLOAD_FOLDER => '1:/user_upload/'
		);
		$newExampleConfiguration = $this->arguments[$argumentName]->getPropertyMappingConfiguration();
		$newExampleConfiguration->forProperty('images.*')->setTypeConverterOptions('Drcsystems\\ProductAdvertisement\\Property\\TypeConverter\\UploadedFileReferenceConverter', $uploadConfiguration);
	}


	/**
	 *   Email Functionalities Starts
	 */ 



	/**
	 * Email Function 
	 * @param string $recipient 
	 * @param string $sender 
	 * @param string $subject 
	 * @param string $template 
	 * @param mixed $mailConfig 
	 * @return boolean 
	 */
	protected function sendMail($recipient, $sender, $subject, $template, $mailConfig = array())
	{
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$ressourcePath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($ressourcePath === NULL ? 'EXT:product_advertisement/Resources/Private/' : $ressourcePath);
		$view->setLayoutRootPath($ressourcePath . 'Layouts/');
		$view->setPartialRootPath($ressourcePath . 'Partials/');
		$view->setTemplatePathAndFilename($ressourcePath . 'Templates/' . $template);
		$view->assignMultiple($mailConfig);
		$emailBody = html_entity_decode($view->render()); 
		$message = $this->objectManager->get('TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$message->setTo($recipient)->setFrom($sender)->setSubject($subject);
		// HTML Email
		$message->setBody($emailBody, 'text/html');
		$message->send();
		return $message->isSent();
	}


	/**
	 *   Mail Sent when Product Create Functions Start
	 */

	/**
	 * Send Mail to the user When Product Created
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function productCreateMail($mailConfig)
	{
		$template = 'Mail/createProduct.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['createProduct'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}


	/**
	 * Notify Admin When Product Created By User
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function notifyAdminProductCreate($mailConfig)
	{
		$template = 'Mail/notifyAdminProductCreated.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['createProduct'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 *  Mail Sent when Product Create Function End
	 */


	/**
	 *  Mail Sent when Product Update Functions Start
	 */    

	/**
	 * Send Mail When Product Update
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function productUpdateMail($mailConfig)
	{
		$template = 'Mail/updateProduct.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['modifyProduct'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 * Notify Admin When Product Update By User
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function notifyAdminProductUpdate($mailConfig)
	{
		$template = 'Mail/notifyAdminProductUpdated.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['modifyProduct'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 * Notify User When Product Update By Admin
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function notifyUserProductUpdateByAdmin($mailConfig)
	{
		$template = 'Mail/updateProductByAdmin.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['modifyProduct'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 *  Mail Sent when Product Update Functions End
	 */


	/**
	 *  Mail Sent when Product Approve / Disapprove Functions Start
	 */

	/**
	 * Send Mail When Product Activated
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function productActivate($mailConfig)
	{
		$template = 'Mail/activatedProduct.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['approveSubject'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 * Send Mail When Product Deactivated
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function productDeactivate($mailConfig)
	{
		$template = 'Mail/deactivatedProduct.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = $this->settings['disapproveSubject'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 *  Mail Sent when Product Approve / Disapprove Functions Start
	 */

	/**
	 * Inquiry Mail to owner
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function sendInquiry($mailConfig)
	{
		$template = 'Mail/sendInquiry.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = 'Inquiry for ' . $mailConfig['configure']['product'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

	/**
	 * Inquiry registered notification mail
	 * @param mixed $mailConfig 
	 * @return void
	 */
	protected function replyInquiry($mailConfig)
	{
		$template = 'Mail/replyInquiry.html';
		$mailTo = $mailConfig['configure']['mailto'];
		$mailFrom = $mailConfig['configure']['mailFrom'];
		$subject = 'Inquiry for ' . $mailConfig['configure']['product'];
		$this->sendMail($mailTo, $mailFrom, $subject, $template, $mailConfig);
	}

    /**
     * @param $limit
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $products
     * @return array
     */
    public function getImageRest($limit, Products $products)
    {
        $res = [];
        $missing = $limit - $products->getImages()->count();
        for ($i=1;$i<=$missing;$i++) {
            $index = $i+$products->getImages()->count() - 1;
            $res[] = $index;
        }
        return $res;
    }
}