<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:40 PM
 */

namespace HieuLe\PhpSPF;


use HieuLe\PhpSPF\Mechanisms\AbstractMechanism;

class SPFRecord
{
    private $mechanism = [];

    public function addMechanism(AbstractMechanism $mechanism)
    {
        $this->mechanism[] = $mechanism;
    }
}