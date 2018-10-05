<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/18
 * Time: 9:40 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

class MxMechanism extends AbstractMechanism
{

    /**
     * @param string $text
     * @param Level  $level
     *
     */
    public function fromText(string $text, Level $level)
    {
        // TODO: Implement fromText() method.
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return "mx";
    }
}