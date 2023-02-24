<?php

namespace Bss\FAQ\Model\DataProvider\Category;

use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
    protected $_loadedData;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $categoryCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $categoryCollection->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $category) {
            $this->_loadedData[$category->getId()] = $category->getData();
        }
        return $this->_loadedData;
    }
}
