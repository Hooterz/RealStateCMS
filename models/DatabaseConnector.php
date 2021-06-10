<?php
    declare(strict_types=1);
    use \config\Autoloader;
    use \config\DatabaseConnection;
    use \config\Redirection;

    require('./config/autoload.php');
    (new Autoloader())->Load();

    trait Database_Methods
    {
        private function QueryExecuter($query)
        {
            $con = DatabaseConnection::GetInstance();
            $result = $con->query($query);

            //Check if any results were returned
            if (!$result)
                Redirection::Error404();

            if($result->num_rows === 0)
                return null;

            return $result->fetch_assoc();
        }

        public function ExecuteRawQuery($query){
            return $this->QueryExecuter($query);
        }
    }

    abstract class Database_Model
    {   
        public abstract function FindById($id);

        public function Exists($id): bool {
            $cleanedId = htmlspecialchars($id);
            $db_response = (array) $this->FindById($cleanedId);
            return count($db_response) === 0 ? false : true;
        }
    }

    class Database_PropertyModel extends Database_Model
    {
        use Database_Methods;

        public function FindById($id) : array
        {
            $cleanedId = htmlspecialchars($id);
            return $this->QueryExecuter("SELECT * FROM Propiedades WHERE prop_id = $cleanedId");
        }
    }

    class Database_LocationModel extends Database_Model
    {
        use Database_Methods;

        public function FindById($id) : array
        {
            $cleanedId = htmlspecialchars($id);
            return $this->QueryExecuter("SELECT * FROM Location WHERE lo_id = $cleanedId");
        }
    }

    class Database_ImageModel extends Database_Model
    {
        use Database_Methods;

        public function FindById($id) : array
        {
            $cleanedId = htmlspecialchars($id);
            return $this->QueryExecuter("SELECT * FROM Image WHERE img_id = $cleanedId");
        }
    }

    class Database_Property_ImageModel extends Database_Model
    {
        use Database_Methods;

        /**
         * @param $id
         * Esta función nos va a devolver cada referencia relacionada a una propiedad;
         */
        public function FindById($id) : array
        {
            $cleanedId = htmlspecialchars($id);
            return $this->QueryExecuter("SELECT propImg_img_id FROM Property_Image WHERE propImg_prop_id = $cleanedId");
        }

    }
?>
