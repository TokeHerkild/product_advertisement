<?php
namespace Drcsystems\ProductAdvertisement\Domain\Model;


use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class Attribute extends AbstractDomainObject implements AttributeInterface
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var int
     */
    protected $attributeType;

    /**
     * @var \Drcsystems\ProductAdvertisement\Domain\Model\Category
     */
    protected $category;

    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param string $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return int
     */
    public function getAttributeType()
    {
        return $this->attributeType;
    }

    /**
     * @param int $attributeType
     */
    public function setAttributeType($attributeType)
    {
        $this->attributeType = $attributeType;
    }

    /**
     * @return \Drcsystems\ProductAdvertisement\Domain\Model\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @param string $dateFormat
     */
    public function setDateFormat(string $dateFormat)
    {
        $this->dateFormat = $dateFormat;
    }

}