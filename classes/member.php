<?php

/**
 *
 */
class Member
{
    private $_first;
    private $_last;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;
    /*
     private $_member;
     */


    /**
     * @param string $_first
     * @param string $_last
     * @param string $_age
     * @param string $_gender
     * @param string $_phone
     */
    public function __construct($first = "", $last = "", $age = "", $gender = "", $phone = "", $email="", $state="", $seeking="", $bio="")
    {
        $this->_first = $first;
        $this->_last = $last;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;
        $this->_email = $email;
        $this->_state = $state;
        $this->_seeking = $seeking;
        $this->_bio = $bio;
        /*
          $this->_member = $_member;
         */

    }


    /**
     * Sets first name
     * @param string $first
     */
    public function setFirst(string $first): void
    {
        $this->_first = $first;
    }

    /**
     * Gets first name
     * @return string
     */
    public function getFirst(): string
    {
        return $this->_first;
    }


    /**
     * Sets last name
     * @param string $last
     */
    public function setLast(string $last): void
    {

        $this->_last = $last;
    }


    /**
     * Gets last name
     * @return string
     */
    public function getLast(): string
    {
        return $this->_last;
    }


    /**
     * Sets age
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->_age = $age;
    }


    /**
     * Gets age
     * @return int
     */
    public function getAge(): int
    {
        return $this->_age;
    }


    /**
     * Sets gender
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }



    /**
     * Gets gender
     * @return string
     */
    public function getGender(): string
    {
        return $this->_gender;
    }


    /**
     * Sets phone number
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }


    /**
     * gets phone number
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }


    /**
     * Sets email
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }


    /**
     * Gets email
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }



    /**
     * Sets state
     * @param string $state
     */

   public function setState(string $state): void
   {
       $this->_state = $state;
   }


   /**
    * Gets state
    * @return string
    */

    public function getState(): string
    {
        return $this->_state;
    }




    /**
     * Sets seeking
     * @param string $seeking
     */

   public function setSeeking(string $seeking): void
   {
       $this->_seeking = $seeking;
   }



   /**
    * Gets seeking
    * @return string
    */

    public function getSeeking(): string
    {
        return $this->_seeking;
    }


    /**
     * Sets bio
     * @param string $bio
     */
    public function setBio(string $bio): void
    {
        $this->_bio = $bio;
    }

    /**
     * Gets bio
     * @return string
     */
    public function getBio(): string
    {
        return $this->_bio;
    }


    /*
    public function isMember(): bool
    {
        return $this->_member;
    }
    */


}
