<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:58 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class IncludeMechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "include";
    }

    public function validate(Level $level)
    {
        $this->validateOptionDoesNotExist();
    }
}