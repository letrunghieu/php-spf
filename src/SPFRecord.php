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
    private $mechanisms = [];

    public function addMechanism(AbstractMechanism $mechanism)
    {
        $this->mechanisms[] = $mechanism;
    }

    public function getText()
    {
        $mechanisms = array_map(function (AbstractMechanism $mechanism) {
            return $mechanism->getText();
        }, $this->mechanisms);

        $valueText = implode(" ", $mechanisms);

        return "v=spf1" . ($valueText ? " {$valueText}" : "");
    }
}