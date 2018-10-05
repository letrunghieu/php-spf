<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:47 PM
 */

namespace HieuLe\PhpSPF\Implementations;


use HieuLe\PhpSPF\Common\DNSResolverInterface;
use HieuLe\PhpSPF\Exceptions\DNSResolutionException;
use HieuLe\PhpSPF\Exceptions\NoSPFRecordException;

class SimpleDNSResolver implements DNSResolverInterface
{

    /**
     * @inheritdoc
     */
    public function getSPFRecordForDomain(string $domain): string
    {
        $records = dns_get_record($domain, DNS_TXT);

        if ($records === false) {
            throw new DNSResolutionException();
        }

        foreach ($records as $record) {
            $txt = strtolower($record['txt']);

            // An SPF record can be empty (no mechanism)
            if ($txt == 'v=spf1' || stripos($txt, 'v=spf1 ') === 0) {
                return $txt;
            }
        }

        throw new NoSPFRecordException();
    }
}