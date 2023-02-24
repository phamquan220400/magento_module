<?php

namespace Bss\FAQ\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface CategoryInterface extends ExtensibleDataInterface
{
    const CATEGORY_ID = 'category_id';
    const TITLE = 'title';
    const CREATED_AT = 'created_at';
    const SORT_ORDER = 'sort_order';
    const ENABLE = 'enable';
    const UPDATED_AT = 'updated_at';
    const CREATED_BY = "created_by";

    /**
     * @return int
     */
    public function getCategoryId();

    /**
     * @param $id
     * @return int
     */
    public function setCategoryId($id);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $create
     * @return mixed
     */
    public function setCreatedAt($create);

    /**
     * @return mixed
     */
    public function getCreatedBy();

    /**
     * @param $create
     * @return mixed
     */
    public function setCreatedBy($create);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $create
     * @return mixed
     */
    public function setUpdatedAt($create);

    /**
     * @return mixed
     */
    public function getSortOrder();

    /**
     * @param $sortOder
     * @return mixed
     */
    public function setSortOrder($sortOder);

    /**
     * @return mixed
     */
    public function getEnable();

    /**
     * @param $enable
     * @return mixed
     */
    public function setEnable($enable);

}
