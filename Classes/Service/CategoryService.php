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
     * @return array
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

    /**
     * @param array $categories
     * @param array $list
     * @param string $preFix
     * @return array
     */
    public function parseCategories($categories = [], $list = [], $preFix = '')
    {
        if (empty($categories)) {
            $categories = $this->categories;
        }
        /** @var \Drcsystems\ProductAdvertisement\Domain\Model\Category $category */
        foreach ($categories as $category) {
            $list[] = [
                'preFix' => $preFix,
                'item' => $category,
            ];
            if ($category->hasSubCategories()) {
                $list = $this->parseCategories($category->getSubCategories(), $list, $preFix . '-- ');
            }
        }
        return $list;
    }

}