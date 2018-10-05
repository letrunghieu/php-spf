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
        return "ip6";
    }
}