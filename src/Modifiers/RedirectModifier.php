<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 10:10 AM
 */

namespace HieuLe\PhpSPF\Modifiers;


use HieuLe\PhpSPF\Level;

class RedirectModifier extends AbstractModifier
{
    public function getName(): string
    {
        return "redirect";
    }

    public function validate(Level $level)
    {
        // TODO: Implement validate() method.
    }
}