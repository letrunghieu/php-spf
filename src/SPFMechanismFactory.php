<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 7:58 AM
 */

namespace HieuLe\PhpSPF;


use HieuLe\PhpSPF\Exceptions\InvalidMechanismException;
use HieuLe\PhpSPF\Mechanisms\AbstractMechanism;
use HieuLe\PhpSPF\Mechanisms\AllMechanism;
use HieuLe\PhpSPF\Mechanisms\AMechanism;
use HieuLe\PhpSPF\Mechanisms\ExistsMechanism;
use HieuLe\PhpSPF\Mechanisms\IncludeMechanism;
use HieuLe\PhpSPF\Mechanisms\Ip4Mechanism;
use HieuLe\PhpSPF\Mechanisms\Ip6Mechanism;
use HieuLe\PhpSPF\Mechanisms\MxMechanism;
use HieuLe\PhpSPF\Modifiers\AbstractModifier;
use HieuLe\PhpSPF\Modifiers\ExpModifier;
use HieuLe\PhpSPF\Modifiers\NotSupportedModifier;
use HieuLe\PhpSPF\Modifiers\RedirectModifier;

class SPFMechanismFactory
{
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

    private $supportedMechanisms;

    public function __construct()
    {
        $this->registerSupportedMechanisms();
    }

    /**
     * @param string $text
     * @param string $currentDomain
     * @param Level  $level
     *
     * @return AbstractMechanism
     */
    public function make(string $text, string $currentDomain, Level $level): AbstractMechanism
    {
        $text = trim($text);

        // detect modifiers
        if (preg_match('/=/', $text)) {
            list ($name, $value) = preg_split('/=/', $text, 2);
            return $this->createModifier($name, $value, $level);
        }

        // if this is not a modifier, parse it as a mechanism
        $qualifier = substr($text, 0, 1);
        if (!in_array($qualifier, AbstractMechanism::getValidModifiers())) {
            $qualifier = AbstractMechanism::RESULT_PASS;
            $condition = $text;
        } else {
            $condition = substr($text, 1);
        }

        $matches = null;
        if (!preg_match('/^(?<name>[a-z]+)(?:\:(?<value>[^\/]+))?(?:\/(?<option>\d+))?$/m', $condition, $matches)) {
            throw new InvalidMechanismException("[$text] is not a supported mechanism");
        }

        $mechanism = $matches['name'];
        $value = isset($matches['value']) ? $matches['value'] : "";
        $option = isset($matches['option']) ? $matches['option'] : "";

        switch ($mechanism) {
            case self::MECHANISM_ALL:
                $mech = new AllMechanism();
                break;

            case self::MECHANISM_IP4:
                $mech = new Ip4Mechanism();
                break;

            case self::MECHANISM_IP6:
                $mech = new Ip6Mechanism();
                break;

            case self::MECHANISM_A:
                $mech = new AMechanism();
                break;

            case self::MECHANISM_MX:
                $mech = new MxMechanism();
                break;

            case self::MECHANISM_PTR:
                $mech = new MxMechanism();
                break;

            case self::MECHANISM_EXISTS:
                $mech = new ExistsMechanism();
                break;

            case self::MECHANISM_INCLUDE:
                $mech = new IncludeMechanism();
                break;

            default:
                throw new InvalidMechanismException("[$text] is not a supported mechanism");
        }

        $mech->setValue($value);
        $mech->setOption($option);
        $mech->validate($level);
        $mech->setQualifier($qualifier);
        return $mech;
    }

    protected function createModifier(string $name, string $value, Level $level): AbstractModifier
    {
        switch ($name) {
            case self::MODIFIER_EXP:
                $modifier = new ExpModifier();
                break;

            case self::MODIFIER_REDIRECT:
                $modifier = new RedirectModifier();
                break;

            default:
                $modifier = new NotSupportedModifier($name);
        }

        $modifier->setValue($value);
        $modifier->validate($level);
        return $modifier;
    }

    protected function registerSupportedMechanisms()
    {
        $this->supportedMechanisms = [
            new AMechanism(),
        ];
    }
}