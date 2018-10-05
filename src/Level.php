<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:32 PM
 */

namespace HieuLe\PhpSPF;


class Level
{
    /**
     * @var bool
     */
    private $doValidate;

    /**
     * @var bool
     */
    private $doExpand;

    /**
     * @param bool $doValidate
     */
    public function setDoValidate(bool $doValidate)
    {
        $this->doValidate = $doValidate;
    }

    /**
     * @param bool $doExpand
     */
    public function setDoExpand(bool $doExpand)
    {
        $this->doExpand = $doExpand;
    }

    public function willValidate(): bool
    {
        return $this->doValidate;
    }

    public function willExpand(): bool
    {
        return $this->doExpand;
    }
}