<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:57 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class ExistsMechanism extends AbstractMechanism
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return "exists";
    }

    public function validate(Level $level)
    {
        $this->validateOptionDoesNotExist();
    }
}