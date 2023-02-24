<?php

namespace Bss\FAQ\Api;

use Bss\FAQ\Api\Data\CategoryInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryRepositoryInterface
{
   /**
    * @return mixed
    */
   public function save(CategoryInterface $category);
    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id);

    /**
     * @param CategoryInterface $category
     * @return mixed
     */
    public function delete(CategoryInterface $category);
}
