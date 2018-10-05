<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 7:59 AM
 */

namespace HieuLe\PhpSPF\Mechanisms;


use HieuLe\PhpSPF\Exceptions\InvalidMechanismException;
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
    private $qualifier = "";

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
     *
     * @return static
     */
    public function setQualifier(string $qualifier)
    {
        $this->qualifier = $qualifier;

        return $this;
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
     *
     * @return static
     */
    public function setValue(string $value)
    {
        $this->value = $value;

        return $this;
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
     *
     * @return static
     */
    public function setOption(string $option)
    {
        $this->option = $option;

        return $this;
    }

    public function getOperand(): string
    {
        $value = $this->getValue();
        $option = $this->getOption();
        if ($option) {
            $value = "{$value}/{$option}";
        }

        return $value;
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

    public abstract function validate(Level $level);

    /**
     * @return string
     */
    public abstract function getName(): string;

    protected function throwInvalidValue(string $reason = "")
    {
        $name = $this->getName();
        $value = $this->getOperand();

        $message = "Invalid value [{$value}] for mechanism [{$name}]";
        if ($reason) {
            $message .= " Reason: {$reason}";
        }

        throw new InvalidMechanismException($message);
    }

    protected function validatePrefixLength($option, Level $level)
    {

    }

    protected function validateValueIsRequired()
    {
        if (!$this->getValue()) {
            $this->throwInvalidValue("value is required");
        }
    }

    protected function validateOptionDoesNotExist()
    {
        if ($this->getOption()) {
            $this->throwInvalidValue("option must be empty");
        }
    }
}