<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 7:59 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Level;

abstract class AbstractMechanism
{
    const RESULT_PASS = '+';
    const RESULT_FAIL = '-';
    const RESULT_SOFTFAIL = '~';
    const RESULT_NEUTRAL = '?';

    const MECHANISM_ALL = 'all';
    const MECHANISM_IP4 = 'ip4';
    const MECHANISM_IP6 = 'ip6';
    const MECHANISM_A = 'a';
    const MECHANISM_MX = 'mx';
    const MECHANISM_PTR = 'ptr';
    const MECHANISM_EXISTS = 'exists';
    const MECHANISM_INCLUDE = 'include';
    const MODIFIER_REDIRECT = 'redirect';
    const MODIFIER_EXP = 'exp';

    public static function getValidModifiers(): array
    {
        return [self::RESULT_PASS, self::RESULT_FAIL, self::RESULT_SOFTFAIL, self::RESULT_NEUTRAL];
    }

    /**
     * @var string
     */
    private $qualifier;

    /**
     * @return string
     */
    public function getQualifier(): string
    {
        return $this->qualifier;
    }

    /**
     * @param string $qualifier
     */
    public function setQualifier(string $qualifier)
    {
        $this->qualifier = $qualifier;
    }


    /**
     * @param string $text
     * @param Level $level
     *
     */
    public abstract function fromText(string $text, Level $level);
}