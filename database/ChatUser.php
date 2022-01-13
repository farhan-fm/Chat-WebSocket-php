<?php


class ChatUser
{
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;
    private $user_profile;
    private $user_status;
    private $user_created_on;
    private $user_verification_code;
    private $user_login_status;
    public $connect;

    public function __construct()
    {
        require_once('DatabaseConection.php');

        $database_object = new DatabaseConection;

        $this->connect = $database_object->connect();
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }


    public function getUserName()
    {
        return $this->user_name;
    }

    public function setUserName($user_name)
    {
        $this->user_name = $user_name;
    }


    public function getUserEmail()
    {
        return $this->user_email;
    }

    public function setUserEmail($user_email)
    {
        $this->user_email = $user_email;
    }


    public function getUserPassword()
    {
        return $this->user_password;
    }

    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }


    public function getUserProfile()
    {
        return $this->user_profile;
    }

    public function setUserProfile($user_profile)
    {
        $this->user_profile = $user_profile;
    }


    public function getUserStatus()
    {
        return $this->user_status;
    }

    public function setUserStatus($user_status)
    {
        $this->user_status = $user_status;
    }


    public function getUserCreatedOn()
    {
        return $this->user_created_on;
    }

    public function setUserCreatedOn($user_created_on)
    {
        $this->user_created_on = $user_created_on;
    }


    public function getUserVerificationCode()
    {
        return $this->user_verification_code;
    }

    public function setUserVerificationCode($user_verification_code)
    {
        $this->user_verification_code = $user_verification_code;
    }


    public function getUserLoginStatus()
    {
        return $this->user_login_status;
    }

    public function setUserLoginStatus($user_login_status)
    {
        $this->user_login_status = $user_login_status;
    }

}