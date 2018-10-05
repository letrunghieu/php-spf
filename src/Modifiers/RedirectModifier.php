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

    /**
     * @param string $text
     * @param Level  $level
     *
     */
    public function fromText(string $text, Level $level)
    {
        $this->setValue($text);
    }

    public function getName(): string
    {
        return "redirect";
    }
}