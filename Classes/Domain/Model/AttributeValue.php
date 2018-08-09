<?php
namespace Drcsystems\ProductAdvertisement\Domain\Model;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;

class AttributeValue extends AbstractDomainObject implements AttributeInterface
{

    /**
     * @var \Drcsystems\ProductAdvertisement\Domain\Model\Attribute
     */
    protected $attribute;

    /**
     * @var \Drcsystems\ProductAdvertisement\Domain\Model\Products
     */
    protected $product;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return \Drcsystems\ProductAdvertisement\Domain\Model\Attribute
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Attribute $attribute
     */
    public function setAttribute(\Drcsystems\ProductAdvertisement\Domain\Model\Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return \Drcsystems\ProductAdvertisement\Domain\Model\Products
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param \Drcsystems\ProductAdvertisement\Domain\Model\Products $product
     */
    public function setProduct(\Drcsystems\ProductAdvertisement\Domain\Model\Products $product)
    {
        $this->product = $product;
    }

    /**
     * @return bool|\DateTime|int|string
     */
    public function getValue()
    {
        switch ($this->getAttribute()->getAttributeType()) {

            case self::ATTRIBUTE_TYPE_INT:
                return (int) $this->value;
                break;

            case self::ATTRIBUTE_TYPE_DATE:
                $result = \DateTime::createFromFormat($this->getAttribute()->getDateFormat(), $this->value);
                return $result;

            case self::ATTRIBUTE_TYPE_BOOL:
                return (bool) $this->value;

            default:
                return $this->value;

        }
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->attribute->getCaption();
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->attribute->getUnit();
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->getAttribute()->getDateFormat();
    }

}