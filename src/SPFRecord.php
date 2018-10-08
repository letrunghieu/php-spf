<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:40 PM
 */

namespace HieuLe\PhpSPF;


use HieuLe\PhpSPF\Mechanisms\AbstractMechanism;
use HieuLe\PhpSPF\Mechanisms\AllMechanism;
use HieuLe\PhpSPF\Mechanisms\IncludeMechanism;

class SPFRecord
{
    private $mechanisms = [];

    /**
     * @param AbstractMechanism $mechanism
     *
     * @return $this
     */
    public function addMechanism(AbstractMechanism $mechanism)
    {
        $this->mechanisms[] = $mechanism;

        return $this;
    }

    /**
     * @return array
     */
    public function getMechanisms(): array
    {
        return $this->mechanisms;
    }

    /**
     * @param AbstractMechanism $mechanism
     *
     * @return SPFRecord
     */
    public function addMechanismNicely(AbstractMechanism $mechanism): SPFRecord
    {
        if (empty($this->mechanisms)) {
            $this->mechanisms = [$mechanism];
            return $this;
        }

        // Find tha last mechanism that is not 'all', then insert the new mechanism after it
        $lastIndex = 0;
        for ($l = count($this->mechanisms), $i = $l - 1; $i >= 0; $i--) {
            if (!$this->mechanisms[$i] instanceof AllMechanism) {
                $lastIndex = $i + 1;
                break;
            }
        }

        array_splice($this->mechanisms, $lastIndex, 0, [$mechanism]);

        return $this;
    }

    public function getText()
    {
        $mechanisms = array_map(function (AbstractMechanism $mechanism) {
            return $mechanism->getText();
        }, $this->mechanisms);

        $valueText = implode(" ", $mechanisms);

        return "v=spf1" . ($valueText ? " {$valueText}" : "");
    }
}