<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:56 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class Ip6Mechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "ip6";
    }

    public function validate(Level $level)
    {
        $this->validateValueIsRequired();

        $this->validatePrefixLength($this->getOption(), $level);
    }
}