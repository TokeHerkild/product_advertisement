<?php
/**
 * Created by PhpStorm.
 * User: toke
 * Date: 26-07-18
 * Time: 15:25
 */

namespace Drcsystems\ProductAdvertisement\Service;


use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class CategoryService
{

    /**
     * @var array
     */
    protected $categories;

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage|\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $categories
     */
    public function getCategoryList($categories)
    {
        $categories->rewind();
        while ($categories->valid()) {
            $this->categories[] = $categories->current();
            $categories->next();
        }
        return $this->parseCategories();
    }

    public function parseCategories($categories = [], $list = [])
    {
        if (empty($categories)) {
            $categories = $this->categories;
        }
        foreach ($categories as $key => $category) {

        }
    }

}