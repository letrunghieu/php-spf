<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:31 PM
 */

namespace HieuLe\PhpSPF\Common;


interface IPResolverInterface
{
    /**
     * Check an IP (v4 or v6) against an array of CIDR blocks
     *
     * @param string $requestIp
     * @param array $ips
     * @return bool
     */
    public function check(string $requestIp, array $ips): bool;
}