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
use HieuLe\PhpSPF\Mechanisms\AMechanism;
use HieuLe\PhpSPF\Mechanisms\Ip4Mechanism;

class SPFMechanismFactory
{
    private $supportedMechanisms;

    public function __construct()
    {
        $this->registerSupportedMechanisms();
    }

    /**
     * @param string $text
     * @param string $currentDomain
     * @param Level $level
     * @return AbstractMechanism
     */
    public function make(string $text, string $currentDomain, Level $level): AbstractMechanism
    {
        $text = trim($text);

        $qualifier = substr($text, 0, 1);
        if (!in_array($qualifier, AbstractMechanism::getValidModifiers())) {
            $qualifier = AbstractMechanism::RESULT_PASS;
            $condition = $text;
        } else {
            $condition = substr($text, 1);
        }

        $operand = "";
        if (1 == preg_match('/:|=|\//', $condition)) {
            list($mechanism, $operand) = preg_split('/:|=|\//', $condition, 2);
        } else {
            $mechanism = $condition;
        }

        switch ($mechanism) {
            case AbstractMechanism::MECHANISM_IP4:

                $mech = new Ip4Mechanism();
                break;

            case AbstractMechanism::MECHANISM_A:
                if (!$operand) {
                    $operand = $currentDomain;
                }

                $mech = new AMechanism();
                break;

            default:
                throw new InvalidMechanismException("[$text] is not a supported mechanism");
        }

        $mech->fromText($operand, $level);
        return $mech;
    }

    protected function registerSupportedMechanisms()
    {
        $this->supportedMechanisms = [
            new AMechanism(),
        ];
    }
}