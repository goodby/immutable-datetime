<?php

namespace Goodby\ImmutableDatetime;

class DateTime
{
    /**
     * @var int
     */
    private $timestamp;

    /**
     * @param int $timestamp
     */
    public function __construct($timestamp = null)
    {
        $this->constructWithTimestamp($timestamp);
    }

    /**
     * @return int
     */
    public function timestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $format
     * @return string
     */
    public function format($format)
    {
        return date($format, $this->timestamp);
    }

    /**
     * @param DateTime $another
     * @return bool
     */
    public function before(DateTime $another)
    {
        return ($this->timestamp() < $another->timestamp());
    }

    /**
     * @param DateTime $another
     * @return bool
     */
    public function after(DateTime $another)
    {
        return ($another->timestamp() < $this->timestamp());
    }

    /**
     * @param DateTime $another
     * @return bool
     */
    public function equals(DateTime $another)
    {
        return ($this->timestamp() === $another->timestamp());
    }

    /**
     * @param int $timestamp
     */
    private function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    }

    /**
     * @param int $timestamp
     */
    private function constructWithTimestamp($timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = time();
        }

        $this->setTimestamp($timestamp);
    }
}
