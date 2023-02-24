<?php

namespace Bss\FAQ\Model;

use Bss\FAQ\Api\Data\CategoryInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Category extends AbstractModel implements CategoryInterface, IdentityInterface

{
    const CACHE_TAG = 'faq_faq_category';

    public function _construct()
    {
        $this->_init("Bss\FAQ\Model\ResourceModel\Category");
    }

    public function getIdentities(): array
    {
        return [self::CACHE_TAG . '_' . $this->getCategoryId()];
    }

    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    public function setCategoryId($id)
    {
        $this->setData(self::CATEGORY_ID, $id);
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($create)
    {
        $this->setData(self::CREATED_AT, $create);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($create)
    {
        $this->setData(self::UPDATED_AT, $create);
    }

    public function getCreatedBy()
    {
        return $this->getData(self::CREATED_BY);
    }

    public function setCreatedBy($create)
    {
        $this->setData(self::CREATED_BY, $create);
    }

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);

    }

    public function setSortOrder($sortOder)
    {
        $this->setData(self::SORT_ORDER, $sortOder);
    }

    public function getEnable()
    {
        return $this->getData(self::ENABLE);
    }

    public function setEnable($enable)
    {
        $this->setData(self::ENABLE, $enable);
    }
}
