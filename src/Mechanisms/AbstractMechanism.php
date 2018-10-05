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

    public static function getValidModifiers(): array
    {
        return [self::RESULT_PASS, self::RESULT_FAIL, self::RESULT_SOFTFAIL, self::RESULT_NEUTRAL];
    }

    /**
     * @var string
     */
    private $qualifier;

    /**
     * @var string
     */
    private $value = "";

    /**
     * @var string
     */
    private $option = "";

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
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getOption(): string
    {
        return $this->option;
    }

    /**
     * @param string $option
     */
    public function setOption(string $option)
    {
        $this->option = $option;
    }

    public function getText(): string
    {
        $text = $this->getName();

        if ($this->getQualifier() === AbstractMechanism::RESULT_PASS) {
            $qualifier = "";
        } else {
            $qualifier = $this->getQualifier();
        }

        $value = $this->getValue();
        if ($value) {
            $text .= ":{$value}";
        }

        $option = $this->getOption();
        if ($option) {
            $text .= "/{$option}";
        }

        return "{$qualifier}{$text}";
    }

    /**
     * @param string $text
     * @param Level  $level
     *
     */
    public abstract function fromText(string $text, Level $level);

    /**
     * @return string
     */
    public abstract function getName(): string;
}