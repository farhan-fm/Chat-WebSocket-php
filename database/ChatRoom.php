<?php


class ChatRoom
{
    private $chat_id;
    private $user_id;
    private $message;
    private $created_on;
    protected $connect;

    public function __construct()
    {
        require_once("DatabaseConection.php");

        $database_object = new DatabaseConection();

        $this->connect = $database_object->connect();
    }

    public function getChatId()
    {
        return $this->chat_id;
    }

    public function setChatId($chat_id)
    {
        $this->chat_id = $chat_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getCreatedOn()
    {
        return $this->created_on;
    }

    public function setCreatedOn($created_on)
    {
        $this->created_on = $created_on;
    }

    function save_chat()
    {
        $query = "
		INSERT INTO chatrooms 
			(userid, msg, created_on) 
			VALUES (:userid, :msg, :created_on)
		";

        $statement = $this->connect->prepare($query);

        $statement->bindParam(':userid', $this->user_id);

        $statement->bindParam(':msg', $this->message);

        $statement->bindParam(':created_on', $this->created_on);

        $statement->execute();
    }

    function get_all_chat_data()
    {
        $query = "
		SELECT * FROM chatrooms 
			INNER JOIN chat_user_table 
			ON chat_user_table.user_id = chatrooms.userid 
			ORDER BY chatrooms.id ASC
		";

        $statement = $this->connect->prepare($query);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}