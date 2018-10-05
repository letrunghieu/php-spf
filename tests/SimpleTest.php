<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 7:47 AM
 */

namespace HieuLe\PhpSPFTest;


use HieuLe\PhpSPF\SPFBuilder;
use PHPUnit\Framework\TestCase;

class SimpleTest extends TestCase
{
    public function testSimeple() {
        SPFBuilder::init()->make()->getSPFFromDomain("resales-online.com");
    }
}