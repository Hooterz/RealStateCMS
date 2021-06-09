<?php
    use \config\DatabaseConnection;
    require('./config/database.php');

    trait DatabaseMethods
    {
        public function queryExecuter($query)
        {
            $con = DatabaseConnection::getInstance();
            $result = $con->query($query);

            //Check if any results were returned
            if (!$result)
            {
                echo($con->error); // <- Implementar 404 en esto
            }
        }
    }

    abstract class DatabaseConnector
    {
        use DatabaseMethods;

        public abstract function findById($id);
    }

    class DatabasePropertyConnector extends DatabaseConnector
    {
        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);

            $this->queryExecuter("SELECT * FROM Propiedades WHERE prop_id = $cleanedId");
        }
    }

    class DatabaseLocationConnector extends DatabaseConnector
    {
        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);

            $this->queryExecuter("SELECT * FROM Location WHERE lo_id = $cleanedId");
        }
    }

    class DatabaseImageConnector extends DatabaseConnector
    {
        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);

            $this->queryExecuter("SELECT * FROM Image WHERE img_id = $cleanedId");
        }
    }
?>
