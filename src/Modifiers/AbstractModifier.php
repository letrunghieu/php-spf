<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 10:08 AM
 */

namespace HieuLe\PhpSPF\Modifiers;

use HieuLe\PhpSPF\Mechanisms\AbstractMechanism;

abstract class AbstractModifier extends AbstractMechanism
{
    public function getText(): string
    {
        return $this->getName() . "=" . $this->getValue();
    }
}