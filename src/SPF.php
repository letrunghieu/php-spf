<?php
/**
 * Created by PhpStorm.
 * User: hieul
 * Date: 10/4/2018
 * Time: 10:23 PM
 */

namespace HieuLe\PhpSPF;


use HieuLe\PhpSPF\Common\DNSResolverInterface;
use HieuLe\PhpSPF\Common\IPResolverInterface;
use HieuLe\PhpSPF\Exceptions\DNSResolutionException;

class SPF
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

    /**
     * @var SPFMechanismFactory
     */
    private $mechanismFactory;

    /**
     * SPF constructor.
     * @param DNSResolverInterface $dnsResolver
     * @param IPResolverInterface $ipResolver
     * @param Level $level
     */
    public function __construct(DNSResolverInterface $dnsResolver, IPResolverInterface $ipResolver, Level $level)
    {
        $this->dnsResolver = $dnsResolver;
        $this->ipResolver = $ipResolver;
        $this->level = $level;

        $this->mechanismFactory = new SPFMechanismFactory();
    }

    /**
     * @param $domain
     *
     * @return SPFRecord
     *
     * @throws DNSResolutionException
     */
    public function getSPFFromDomain(string $domain): SPFRecord
    {
        $record = $this->dnsResolver->getSPFRecordForDomain($domain);
        var_dump($record);

        return $this->parseSPFRecord($record);
    }

    /**
     * @param $record
     *
     * @return SPFRecord
     */
    public function parseSPFRecord(string $record): SPFRecord
    {
        $spfRecord = new SPFRecord();

        $recordParts = explode(" ", $record);
        array_shift($recordParts); // Remove first part (v=spf1)

        // If the spf record is empty, the default mechanism is '?all'
        if (count($recordParts) == 0) {
            $recordParts = ['?all'];
        }

        foreach ($recordParts as $part) {
            $mechanism = $this->mechanismFactory->make($part);

            $spfRecord->addMechanism($mechanism);
        }

        return $spfRecord;
    }
}