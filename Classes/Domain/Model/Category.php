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

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

/**
 * Category
 */
class Category extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

	/**
	 * Category name
	 * name
	 * @var string
	 */
	protected $name = '';

	/**
	 * Category description
	 * description
	 * @var string
	 */
	protected $description = '';

    /**
     * @var \Drcsystems\ProductAdvertisement\Domain\Model\Category
     */
	protected $parent;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\Category>
     */
	protected $subCategories;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Drcsystems\ProductAdvertisement\Domain\Model\Attribute>
     */
	protected $attributes;

	public function __construct()
    {
        $this->subCategories = new ObjectStorage();
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
	 * @param string $description 
	 * @return void
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}

    /**
     * @return \Drcsystems\ProductAdvertisement\Domain\Model\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getSubCategories()
    {
        return $this->subCategories;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $subCategories
     */
    public function setSubCategories($subCategories)
    {
        $this->subCategories = $subCategories;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category
     */
    public function addSubCategory(Category $category)
    {
        $this->subCategories->attach($category);
    }

    /**
     * @return bool
     */
    public function hasParent()
    {
        return (bool) $this->getParent();
    }

    /**
     * @return bool
     */
    public function hasSubCategories()
    {
        return (bool) ($this->getSubCategories()->count() > 0);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $attributes
     */
    public function setAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Attribute $attribute
     */
    public function addAttribute(Attribute $attribute)
    {
        if (!$this->attributes) {
            $this->attributes = new ObjectStorage();
        }
        $this->attributes->attach($attribute);
    }

}