<?php

/**
 *
 */
class PremiumMember extends Member
{

    private $_indoorInterests = "";
    private $_outdoorInterests = "";


    /**
     * Sets indoor interests
     * @param array $indoor
     */
    public function setIndoorInterest( $indoor): void
    {
        $this->_indoorInterests = $indoor;
    }


    /**
     * Sets outdoor interests
     * @param array $outdoor
     */
    public function setOutdoorInterest( $outdoor): void
    {
        $this->_outdoorInterests = $outdoor;
    }


    /**
     * Gets indoor interests
     * @return string
     */
    public function getIndoorInterests(): string
    {
       return $this->_indoorInterests;
    }


    /**
     * Gets outdoor interests
     * @return string
     */
    public function getOutdoorInterests(): string
    {
        return $this->_outdoorInterests;
    }
}
