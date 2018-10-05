<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 8:04 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class AMechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "a";
    }

    public function validate(Level $level)
    {
        $this->validatePrefixLength($this->getOption(), $level);
    }
}