<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:20 PM
 */

namespace HieuLe\PhpSPF;


use HieuLe\PhpSPF\Common\DNSResolverInterface;
use HieuLe\PhpSPF\Common\IPResolverInterface;
use HieuLe\PhpSPF\Implementations\SimpleDNSResolver;
use HieuLe\PhpSPF\Implementations\SymfonyIpResolver;

class SPFBuilder
{
    /**
     * @var DNSResolverInterface
     */
    private $dnsResolver;

    /**
     * @var IPResolverInterface
     */
    private $ipResolver;

    /**
     * @var Level
     */
    private $level;

    public function __construct()
    {
        $this->dnsResolver = new SimpleDNSResolver();
        $this->ipResolver = new SymfonyIpResolver();
        $this->level = new Level();
    }

    /**
     * @return SPF
     */
    public function make(): SPF
    {
        return new SPF($this->dnsResolver, $this->ipResolver, $this->level);
    }


    /**
     * @return SPFBuilder
     */
    public static function init(): SPFBuilder
    {
        return new self();
    }
}