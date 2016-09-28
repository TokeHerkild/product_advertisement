<?php
namespace Drcsystems\ProductAdvertisement\Domain\Repository;
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
 * The repository for Products
 */
class ProductsRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

	/**
	 * Generate Sorated Products
	 *
	 * @param mixed $productArgs 
	 *
	 * @return object
	 */
	public function findProducts($productArgs)
	{
		$query = $this->createQuery();
		$queryCondition = array($query->equals('status',1), $query->equals('approve',1));
		if (!empty($productArgs['productName'])) {
			array_push($queryCondition, $query->like('name', '%' . $productArgs['productName'] . '%'));
		}
		if (!empty($productArgs['place'])) {
			array_push($queryCondition, $query->like('ownerplace', '%' . $productArgs['place'] . '%'));
		}
		if (!empty($productArgs['category'])) {
			array_push($queryCondition, $query->contains('category', $productArgs['category']));
		}
		if(!empty($productArgs['fromdate'])){
			array_push($queryCondition, $query->greaterThanOrEqual('fromdate', $productArgs['fromdate']));   
		}
		if(!empty($productArgs['todate'])){
			array_push($queryCondition, $query->lessThanOrEqual('todate', $productArgs['todate']));   
		}
		if (count($queryCondition) > 0) {
			$query->matching($query->logicalAnd($queryCondition));
		}
		if ($productArgs['order'] == 'asc') {
			$query->setOrderings(array(
				$productArgs['fieldName'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
			));
		} else {
			$query->setOrderings(array(
				$productArgs['fieldName'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
				)
			);
		}
		if ($query->count()) {
			return $query->execute();
		}
	}

	/**
	 * Generate Products List User Wise
	 * @param mixed $userParams 
	 * @return object
	 */
	public function findProductByUser($userParams)
	{
		$userProductQuery = $this->createQuery();
		$userProductQuery->matching($userProductQuery->equals('user', $userParams['userUid']));
		if ($userParams['order'] == 'asc') {
			$userProductQuery->setOrderings(array(
				$userParams['fieldName'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
				)
			);
		} else {
			$userProductQuery->setOrderings(array(
				$userParams['fieldName'] => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
				)
			);
		}
		return $userProductQuery->execute();
	}

	/**
	 * Generate Sorated Products
	 * @param mixed $searchArgs 
	 * @return object
	 */
	public function searchProducts($searchArgs)
	{
		$query = $this->createQuery();
		$queryCondition = array();
		if (!empty($searchArgs['productName'])) {
			array_push($queryCondition, $query->like('name', '%' . $searchArgs['productName'] . '%'));
		}
		if (!empty($searchArgs['place'])) {
			array_push($queryCondition, $query->like('ownerplace', '%' . $searchArgs['place'] . '%'));
		}
		if (!empty($searchArgs['category'])) {
			array_push($queryCondition, $query->contains('category', $searchArgs['category']));
		}
		if(!empty($searchArgs['fromdate'])){
			array_push($queryCondition, $query->greaterThanOrEqual('fromdate', $searchArgs['fromdate']));   
		}
		if(!empty($searchArgs['todate'])){
			array_push($queryCondition, $query->lessThanOrEqual('todate', $searchArgs['todate']));   
		}
		if($searchArgs['approved'] != ''){
			array_push($queryCondition, $query->equals('approve', $searchArgs['approved']));      
		}
		if (count($queryCondition) > 0) {
			$query->matching($query->logicalAnd($queryCondition));
		}
		if ($query->count()) {
			return $query->execute();
		}
	}

}