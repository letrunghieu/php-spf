<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 8:49 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class Ip4Mechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "ip4";
    }

    public function validate(Level $level)
    {
        $this->validateValueIsRequired();
        $this->validatePrefixLength($this->getOption(), $level);
    }
}