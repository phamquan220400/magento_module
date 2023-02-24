<?php

namespace Bss\FAQ\Model\Source;

use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory;

/**
 *
 */
class FormOptions implements \Magento\Framework\Data\OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array|string[]
     */
    public function toOptionArray()
    {

        $categoryModel = $this->collectionFactory->create();
        $categoryModel->addFieldToSelect('*');
        $options[] = ['label' => '----Please select----- ', 'value' => '', 'disable'=>'true'];
        foreach ($categoryModel as $category) {
            $options[] = [
                'label' => ucfirst($category['title']),
                'value' => $category['category_id']
            ];
        }
        return $options;
    }
}
