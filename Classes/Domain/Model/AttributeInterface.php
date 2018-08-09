<?php
namespace Drcsystems\ProductAdvertisement\Domain\Model;


interface AttributeInterface
{

    CONST ATTRIBUTE_TYPE_TEXT = 0;
    CONST ATTRIBUTE_TYPE_INT = 1;
    CONST ATTRIBUTE_TYPE_DATE = 2;
    CONST ATTRIBUTE_TYPE_BOOL = 3;

    CONST FILTER_TYPE_RANGE = 0; // minmax
    CONST FILTER_TYPE_BOOL = 1; // true/false
    CONST FILTER_TYPE_INPUT = 2; // input

}