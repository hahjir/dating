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


    /**
     * @param string $_first
     * @param string $_last
     * @param string $_age
     * @param string $_gender
     * @param string $_phone
     */
    public function __construct($first = "", $last = "", $age = "", $gender = "", $phone = "")
    {
        $this->_first = $first;
        $this->_last = $last;
        $this->_age = $age;
        $this->_gender = $gender;
        $this->_phone = $phone;

    }


    /**
     * @param string $first
     */
    public function setFirst(string $first): void
    {
        $this->_first = $first;
    }

    /**
     * @return string
     */
    public function getFirst(): string
    {
        return $this->_first;
    }


    /**
     * @param string $last
     */
    public function setLast(string $last): void
    {

        $this->_last = $last;
    }


    /**
     * @return string
     */
    public function getLast(): string
    {
        return $this->_last;
    }


    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->_age = $age;
    }


    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->_age;
    }


    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->_gender = $gender;
    }


    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->_gender;
    }


    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }


    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->_phone;
    }


    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->_email;
    }



    /**
     * @param string $state
     */

   public function setState(string $state): void
   {
       $this->_state = $state;
   }


   /**
    * @return string
    */

    public function getState(): string
    {
        return $this->_state;
    }




    /**
     * @param string $seeking
     */

   public function setSeeking(string $seeking): void
   {
       $this->_seeking = $seeking;
   }



   /**
    * @return string
    */

    public function getSeeking(): string
    {
        return $this->_seeking;
    }


    /**
     * @param string $bio
     */
    public function setBio(string $bio): void
    {
        $this->_bio = $bio;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->_bio;
    }




}
