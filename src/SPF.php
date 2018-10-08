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
use HieuLe\PhpSPF\Mechanisms\AbstractMechanism;
use HieuLe\PhpSPF\Mechanisms\IncludeMechanism;

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
     *
     * @param DNSResolverInterface $dnsResolver
     * @param IPResolverInterface  $ipResolver
     * @param Level                $level
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

        foreach ($recordParts as $part) {
            $mechanism = $this->buildSPFPart($part);

            $spfRecord->addMechanism($mechanism);
        }

        return $spfRecord;
    }

    public function buildSPFPart(string $text): AbstractMechanism
    {
        return $this->mechanismFactory->make($text, "", $this->level);
    }

    /**
     * If a domain is included in an SPF record
     *
     * @param SPFRecord $spfRecord
     * @param string    $domain
     *
     * @return bool
     */
    public function isDomainIncluded(SPFRecord $spfRecord, string $domain): bool
    {
        foreach ($spfRecord->getMechanisms() as $mechanism) {
            if (($mechanism instanceof IncludeMechanism) && $mechanism->getValue() === $domain) {
                return true;
            }
        }
        return false;
    }
}