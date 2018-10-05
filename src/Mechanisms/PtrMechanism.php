<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:56 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class PtrMechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "ptr";
    }

    public function validate(Level $level)
    {
        $this->validateOptionDoesNotExist();
    }
}