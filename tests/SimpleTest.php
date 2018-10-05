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
        $record = SPFBuilder::init()->make()->parseSPFRecord("v=spf1 a mx/24 redirect=foo.com -all");

        var_dump($record, $record->getText());
    }
}