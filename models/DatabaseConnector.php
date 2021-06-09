<?php
    use \config\DatabaseConnection;
    use \config\Redirection;
    require('./config/autoload.php');
    (new Autoloader())->load();

    trait Database_Methods
    {
        public function queryExecuter($query)
        {
            $con = DatabaseConnection::getInstance();
            $result = $con->query($query);

            //Check if any results were returned
            if (!$result)
                Redirection::Error404();

            if($result->num_rows === 0)
                return null;

            return $result->fetch_assoc();
        }

        public function ExecuteRawQuery($query){
            $cleaned_query= htmlspecialchars($query);
            $this->queryExecuter($query);
        }
    }

    abstract class Database_Connector
    {
        public abstract function findById($id);
        public abstract function ExecuteRawQuery($query);

    }

    class Database_PropertyConnector extends DatabaseConnector
    {
        use DatabaseMethods;

        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);
            return $this->queryExecuter("SELECT * FROM Propiedades WHERE prop_id = $cleanedId");
        }
    }

    class Database_LocationConnector extends DatabaseConnector
    {
        use DatabaseMethods;

        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);
            return $this->queryExecuter("SELECT * FROM Location WHERE lo_id = $cleanedId");
        }
    }

    class Database_ImageConnector extends DatabaseConnector
    {
        use DatabaseMethods;

        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);
            return $this->queryExecuter("SELECT * FROM Image WHERE img_id = $cleanedId");
        }
    }

    class Database_Property_ImageConnector extends DatabaseConnector
    {
        use DatabaseMethods;

        /**
         * @param $id
         * Esta función nos va a devolver cada referencia relacionada a una propiedad;
         */
        public function findById($id)
        {
            $cleanedId = htmlspecialchars($id);
            return $this->queryExecuter("SELECT propImg_img_id FROM Property_Image WHERE propImg_prop_id = $cleanedId");
        }

        p
    }
?>
