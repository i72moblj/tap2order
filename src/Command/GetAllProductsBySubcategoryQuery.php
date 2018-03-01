<?php

namespace App\Command;


/**
 * Class GetAllProductsBySubcategoryQuery
 * @package App\Command
 */
class GetAllProductsBySubcategoryQuery
{
    /**
     * @var int
     */
    private $subcategoryId;


    /**
     * GetAllProductsBySubcategoryQuery constructor.
     * @param int $subcategoryId
     */
    public function __construct(int $subcategoryId = 1)
    {
        $this->subcategoryId = $subcategoryId;
    }

    /**
     * @return int
     */
    public function getSubcategoryId(): int
    {
        return $this->subcategoryId;
    }
}