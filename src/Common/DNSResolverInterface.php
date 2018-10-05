<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:18 PM
 */

namespace HieuLe\PhpSPF\Common;


use HieuLe\PhpSPF\Exceptions\DNSResolutionException;
use HieuLe\PhpSPF\Exceptions\NoSPFRecordException;

interface DNSResolverInterface
{
    /**
     * Get the SPF record for a domain
     *
     * @param string $domain the domain to be checked
     * @return string
     *
     * @throws DNSResolutionException
     * @throws NoSPFRecordException
     */
    public function getSPFRecordForDomain(string $domain): string;
}