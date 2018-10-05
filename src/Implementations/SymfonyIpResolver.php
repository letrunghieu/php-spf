<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/5/2018
 * Time: 7:04 AM
 */

namespace HieuLe\PhpSPF\Implementations;


use HieuLe\PhpSPF\Common\IPResolverInterface;
use Symfony\Component\HttpFoundation\IpUtils;

class SymfonyIpResolver implements IPResolverInterface
{
    /**
     * @inheritdoc
     */
    public function check(string $requestIp, array $ips): bool
    {
        return IpUtils::checkIp($requestIp, $ips);
    }
}