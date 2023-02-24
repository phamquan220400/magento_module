<?php

namespace Bss\FAQ\Model\DataProvider\Question;

use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory;

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
        CollectionFactory $questionCollection,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $questionCollection->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $question) {
            $this->_loadedData[$question->getId()] = $question->getData();
        }
        return $this->_loadedData;
    }
}
