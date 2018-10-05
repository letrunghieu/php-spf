<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 10:26 AM
 */

namespace HieuLe\PhpSPF\Modifiers;


use HieuLe\PhpSPF\Level;

class NotSupportedModifier extends AbstractModifier
{
    private $name;

    /**
     * NotSupportedModifier constructor.
     *
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function fromText(string $text, Level $level)
    {
        $this->setValue($text);
    }
}