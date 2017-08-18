<?php

namespace Clarkeash\Swig;

use GuzzleHttp\TransferStats;

/**
 * Class Timer
 *
 * @package \Clarkeash\Swig
 */
class Timer
{
    /**
     * @var \GuzzleHttp\TransferStats
     */
    private $stats;

    /**
     * Timer constructor.
     *
     * @param \GuzzleHttp\TransferStats $stats
     */
    public function __construct(TransferStats $stats)
    {
        $this->stats = $stats;
    }

    public function lessThan(int $ms)
    {
        $taken = round(1000 * $this->stats->getTransferTime());

        return $taken < $ms;
    }

    public function moreThan(int $ms)
    {
        $taken = round(1000 * $this->stats->getTransferTime());

        return $taken > $ms;
    }
}
