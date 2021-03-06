<?php
    declare(strict_types=1);    
    namespace controller\tools;
    use Illuminate\Database\Capsule\Manager as Capsule;
    use stdClass;

class APIRealState{
        /**
         * Obtiene la cantidad de propiedades disponibles en la base de datos
         *
         * @return void
         */
        public static function countProperties(){
            return Capsule::select('SELECT COUNT(*) as value FROM Property;')[0]->value;
        }

        public static function showHideProperty($id): bool{
            $property = self::getProperty($id);
            $hiden_value = $property->prop_isHidden !== 0 ? 0 : 1;
            Capsule::select("UPDATE Property SET prop_isHidden = $hiden_value WHERE prop_id = '$id';");
            return $hiden_value === 0 ? false : true;
        }

        /**
         * Obtiene las propiedades con un límite (default 10) y un offset (default null)
         *
         * @param int $limit
         * @param int $offset
         * @return array
         */
        public static function getProperties($limit = 10, $offset = null, $all=false): array{
            $limit_mod_sql = '';
            $sql_query = '
            SELECT
                prop_id, prop_name, prop_address, lo_name as prop_location,
                prop_description, prop_area, prop_price, prop_pubDate,
                prop_isHidden, cat_name as prop_category  FROM Property
            INNER JOIN Location ON prop_location = lo_id
            INNER JOIN Category ON prop_category = Category.cat_id 
            ';

            if(!$all) $sql_query.=' HAVING prop_isHidden = 0 ';

            if($limit > 0){
                $limit_mod_sql .= "LIMIT $limit";
                if(isset($offset) && $offset > 0) $limit_mod_sql .= " OFFSET $offset";
                $sql_query .= "ORDER BY prop_pubDate DESC $limit_mod_sql;";
            }
            else
                $sql_query .= 'ORDER BY prop_pubDate DESC LIMIT 10;';

            $results = Capsule::select($sql_query);
            return $results;
        }

        /**
         * Obtiene las propiedades con un límite (default 10) y un offset (default null) 
         * siempre que cumpla con los filtros especificados
         *
         * @param [type] $id
         * @param [type] $name
         * @param [type] $date
         * @return array
         */
        public static function getPropertiesFiltered($id=null, $name=null, $date=null): array{
            $sql_query = '
            SELECT
                prop_id, prop_name, prop_address, lo_name as prop_location,
                prop_description, prop_area, prop_price, prop_pubDate,
                prop_isHidden, cat_name as prop_category  FROM Property
            INNER JOIN Location ON prop_location = lo_id
            INNER JOIN Category ON prop_category = Category.cat_id 
            ';

            // Procesamiento de los filtros
            $filter_params = [
                'id' => $id,
                'name' => $name,
                'date' => $date
            ];
            $aplyFilter = false;
            $filter_syntax = ' HAVING ';
            foreach ($filter_params as $param => $value) {
                if(!isset($value)) continue;
                if($aplyFilter) $filter_syntax .= ' AND ';
                $aplyFilter = true;
                switch($param){
                    case 'id':
                        $filter_syntax .= "prop_id = '$value' ";
                        break;
                    case 'name':
                        $filter_syntax .= "prop_name LIKE '%$value%' ";
                        break;
                    case 'date':
                        $filter_syntax .= "DATE(prop_pubDate) = '$date' ";
                        break;
                }
            }

            if($aplyFilter) $sql_query .= " $filter_syntax ";

            $sql_query .= 'ORDER BY prop_pubDate DESC;';
            $results = Capsule::select($sql_query);
            return $results;
        }

        /**
         * Obtiene los path a las imágenes arreglada a una propiedad
         *
         * @param string $property_id
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
         * @param string $property_id
         * @return array
         */
        public static function getPropertyFeatures($property_id): array{
            $results = Capsule::select("
                SELECT propFeature_prop_id, feature_id, feature_content FROM Property_Feature
                INNER JOIN Feature on feature_id = propFeatureg_feature_id
                having propFeature_prop_id = '$property_id';
            ");
            return $results;
        }

        /**
         * Comprueba si exsite una propiedad de cualquier tipo usando su nombre como referencia
         *
         * @param string $name
         * @return array
         */
        public static function doesPropertyNameExist($name): bool{
            $results = Capsule::select("
                SELECT '$name' in (SELECT prop_name FROM Property) as value;
            ");
            return boolval($results[0]->value);
        }

        /**
         * Comprueba si exsite una propiedad de cualquier tipo usando su id como referencia
         *
         * @param string $id
         * @return array
         */
        public static function doesPropertyIdExist($id): bool{
            $results = Capsule::select("
                SELECT '$id' in (SELECT prop_id FROM Property) as value;
            ");
            return boolval($results[0]->value);
        }

        /**
         * Obtiene una propiedad si es que esta existe
         *
         * @param string $id
         * @return stdClass|null
         */
        public static function getProperty($id): mixed {
            if(!self::doesPropertyIdExist($id)) return null;
            $sql_query = "
                SELECT
                    prop_id, prop_name, prop_address, lo_name as prop_location,
                    prop_description, prop_area, prop_price, prop_pubDate,
                    prop_isHidden, cat_name as prop_category  
                FROM Property
                INNER JOIN Location ON prop_location = lo_id
                INNER JOIN Category ON prop_category = Category.cat_id
                HAVING prop_id = '$id'
                LIMIT 1;
            ";
            $results = Capsule::select($sql_query);
            return $results[0];
        }

        /**
         * Obtiene todas las propiedades en una categoría, contando como límite y offset
         *
         * @param string $id
         * @return stdClass|null
         */
        public static function getPropertiesByCategory($cat_id, $limit, $offset, $all=false): mixed {
            $limit_mod_sql = '';
            $sql_query = "
            SELECT
                prop_id, prop_name, prop_address, lo_name as prop_location,
                prop_description, prop_area, prop_price, prop_pubDate,
                prop_isHidden, cat_name as prop_category FROM Property
            INNER JOIN Location ON prop_location = lo_id
            INNER JOIN Category ON prop_category = cat_id
            HAVING prop_category = (SELECT cat_name FROM Category WHERE cat_id = $cat_id LIMIT 1)
            "; 

            if(!$all) $sql_query.=' && prop_isHidden = 0 ';

            if($limit > 0){
                $limit_mod_sql .= "LIMIT $limit";
                if(isset($offset) && $offset > 0) $limit_mod_sql .= " OFFSET $offset";
                $sql_query .= "ORDER BY prop_pubDate DESC $limit_mod_sql;";
            }
            else{
                $sql_query .= 'ORDER BY prop_pubDate DESC LIMIT 10;';
            }
            $results = Capsule::select($sql_query);
            return $results;
        }

    }
?>