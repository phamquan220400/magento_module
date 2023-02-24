<?php

namespace Bss\FAQ\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface CategorySearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems(): array;

    /**
     * @param array $items
     * @return CategorySearchResultInterface
     */
    public function setItems(array $items): CategorySearchResultInterface;
}
