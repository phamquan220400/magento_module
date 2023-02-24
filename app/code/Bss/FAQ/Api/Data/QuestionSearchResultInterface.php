<?php

namespace Bss\FAQ\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface QuestionSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems(): array;
    /**
     * @param array $items
     * @return QuestionSearchResultInterface
     */
    public function setItems(array $items): QuestionSearchResultInterface;
}
