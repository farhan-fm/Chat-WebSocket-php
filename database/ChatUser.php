<?php


class ChatUser
{
    private $user_id;
    private $user_name;
    private $user_email;
    private $user_password;
    private $user_profile;
    private $user_created_on;
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


    public function getUserCreatedOn()
    {
        return $this->user_created_on;
    }

    public function setUserCreatedOn($user_created_on)
    {
        $this->user_created_on = $user_created_on;
    }

    public function getUserLoginStatus()
    {
        return $this->user_login_status;
    }

    public function setUserLoginStatus($user_login_status)
    {
        $this->user_login_status = $user_login_status;
    }

    function make_avatar($character)
    {
        $character =strtolower($character);
        $path = "images/" . $character . ".png";
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);

        $font = dirname(__FILE__) . '/font/arial.ttf';

        imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }

    function update_data()
    {
        $query = "
		UPDATE chat_user_table 
		SET user_name = :user_name, 
		user_email = :user_email, 
		user_password = :user_password, 
		user_profile = :user_profile  
		WHERE user_id = :user_id
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_name', $this->user_name);

        $statement->bindParam(':user_email', $this->user_email);

        $statement->bindParam(':user_password', $this->user_password);

        $statement->bindParam(':user_profile', $this->user_profile);

        $statement->bindParam(':user_id', $this->user_id);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    function get_user_data_by_email()
    {
        $query = "
		SELECT * FROM chat_user_table 
		WHERE user_email = :user_email
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_email', $this->user_email);

        if ($statement->execute()) {
            $user_data = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $user_data;
    }

    function save_data()
    {
        $query = "
		INSERT INTO chat_user_table (user_name, user_email, user_password, user_profile, user_created_on) 
		VALUES (:user_name, :user_email, :user_password, :user_profile, :user_created_on)
		";
        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_name', $this->user_name);

        $statement->bindParam(':user_email', $this->user_email);

        $statement->bindParam(':user_password', $this->user_password);

        $statement->bindParam(':user_profile', $this->user_profile);

        $statement->bindParam(':user_created_on', $this->user_created_on);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function update_user_login_data()
    {
        $query = "
		UPDATE chat_user_table 
		SET user_login_status = :user_login_status  
		WHERE user_id = :user_id
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_login_status', $this->user_login_status);

        $statement->bindParam(':user_id', $this->user_id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    function get_user_data_by_id()
    {
        $query = "
		SELECT * FROM chat_user_table 
		WHERE user_id = :user_id";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_id', $this->user_id);

        try {
            if ($statement->execute()) {
                $user_data = $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                $user_data = array();
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
        return $user_data;
    }

    function upload_image($user_profile)
    {
        $extension = explode('.', $user_profile['name']);
        $new_name = rand() . '.' . $extension[1];
        $destination = 'images/' . $new_name;
        move_uploaded_file($user_profile['tmp_name'], $destination);
        return $destination;
    }

    function get_user_all_data()
    {
        $query = "
		SELECT * FROM chat_user_table 
		";

        $statement = $this->connect->prepare($query);

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    function get_user_all_data_with_status_count()
    {
        $query = "
		SELECT user_id, user_name, user_profile, user_login_status, (SELECT COUNT(*) FROM chat_message WHERE to_user_id = :user_id AND from_user_id = chat_user_table.user_id AND status = 'No') AS count_status FROM chat_user_table
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':user_id', $this->user_id);

        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}