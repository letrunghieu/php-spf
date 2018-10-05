<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:55 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class AllMechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "all";
    }

    public function validate(Level $level)
    {
        if ($this->getValue()) {
            $this->throwInvalidValue("'all' mechanism accepts no value");
        }
    }
}