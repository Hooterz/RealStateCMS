<?php
    declare(strict_types=1);    
    namespace controller\tools;
    use Illuminate\Database\Capsule\Manager as Capsule;
    
    class APIRealState{

        /**
         * Obtiene las propiedades con un límite (default 10) y un offset (default null)
         *
         * @param [type] $limit
         * @param [type] $offset
         * @return array
         */
        public static function getProperties($limit = 10, $offset = null): array{
            $limit_mod_sql = '';
            $sql_query = 'SELECT * FROM Property ';

            if($limit > 0){
                $limit_mod_sql .= "LIMIT $limit";
                if(isset($offset) && $offset > 0) $limit_mod_sql .= " OFFSET $offset";
                $sql_query .= "ORDER BY prop_pubDate $limit_mod_sql;";
            }
            else
                $sql_query .= 'ORDER BY prop_pubDate LIMIT 10;';

            $results = Capsule::select($sql_query);
            return $results;
        }

        /**
         * Obtiene los path a las imágenes arreglada a una propiedad
         *
         * @param [type] $property_id
         * @return array
         */
        public static function getPropertyImages($property_id): array{
            $results = Capsule::select("
                SELECT propImg_prop_id, img_path FROM Property_Image
                INNER JOIN Image on img_id = propImg_img_id
                having propImg_prop_id = '$property_id';
            ");
            return $results;
        }

        /**
         * Obtiene los contenidos de los features arreglados a una propiedad
         *
         * @param [type] $property_id
         * @return array
         */
        public static function getPropertyFeatures($property_id): array{
            $results = Capsule::select("
                SELECT propFeature_prop_id, feature_content FROM Property_Feature
                INNER JOIN Feature on feature_id = propFeatureg_feature_id
                having propFeature_prop_id = '$property_id';
            ");
            return $results;
        }

    }
?>