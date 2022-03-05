<?php

/**
 *
 */
class PremiumMember extends Member
{

    private $_indoorInterests = "";
    private $_outdoorInterests = "";


    /**
     * @param array $indoor
     */
    public function setIndoorInterest( $indoor): void
    {
        $this->_indoorInterests = $indoor;
    }


    /**
     * @param array $outdoor
     */
    public function setOutdoorInterest( $outdoor): void
    {
        $this->_outdoorInterests = $outdoor;
    }


    /**
     * @return string
     */
    public function getIndoorInterests(): string
    {
       return $this->_indoorInterests;
    }


    /**
     * @return string
     */
    public function getOutdoorInterests(): string
    {
        return $this->_outdoorInterests;
    }
}
