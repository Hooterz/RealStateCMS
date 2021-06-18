<?php

namespace Map;

use \Property;
use \PropertyQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'Property' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PropertyTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PropertyTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'RealState';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Property';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Property';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Property';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the prop_id field
     */
    const COL_PROP_ID = 'Property.prop_id';

    /**
     * the column name for the prop_name field
     */
    const COL_PROP_NAME = 'Property.prop_name';

    /**
     * the column name for the prop_address field
     */
    const COL_PROP_ADDRESS = 'Property.prop_address';

    /**
     * the column name for the prop_location field
     */
    const COL_PROP_LOCATION = 'Property.prop_location';

    /**
     * the column name for the prop_description field
     */
    const COL_PROP_DESCRIPTION = 'Property.prop_description';

    /**
     * the column name for the prop_area field
     */
    const COL_PROP_AREA = 'Property.prop_area';

    /**
     * the column name for the prop_price field
     */
    const COL_PROP_PRICE = 'Property.prop_price';

    /**
     * the column name for the prop_pubDate field
     */
    const COL_PROP_PUBDATE = 'Property.prop_pubDate';

    /**
     * the column name for the prop_isHidden field
     */
    const COL_PROP_ISHIDDEN = 'Property.prop_isHidden';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('PropId', 'PropName', 'PropAddress', 'PropLocation', 'PropDescription', 'PropArea', 'PropPrice', 'PropPubdate', 'PropIshidden', ),
        self::TYPE_CAMELNAME     => array('propId', 'propName', 'propAddress', 'propLocation', 'propDescription', 'propArea', 'propPrice', 'propPubdate', 'propIshidden', ),
        self::TYPE_COLNAME       => array(PropertyTableMap::COL_PROP_ID, PropertyTableMap::COL_PROP_NAME, PropertyTableMap::COL_PROP_ADDRESS, PropertyTableMap::COL_PROP_LOCATION, PropertyTableMap::COL_PROP_DESCRIPTION, PropertyTableMap::COL_PROP_AREA, PropertyTableMap::COL_PROP_PRICE, PropertyTableMap::COL_PROP_PUBDATE, PropertyTableMap::COL_PROP_ISHIDDEN, ),
        self::TYPE_FIELDNAME     => array('prop_id', 'prop_name', 'prop_address', 'prop_location', 'prop_description', 'prop_area', 'prop_price', 'prop_pubDate', 'prop_isHidden', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PropId' => 0, 'PropName' => 1, 'PropAddress' => 2, 'PropLocation' => 3, 'PropDescription' => 4, 'PropArea' => 5, 'PropPrice' => 6, 'PropPubdate' => 7, 'PropIshidden' => 8, ),
        self::TYPE_CAMELNAME     => array('propId' => 0, 'propName' => 1, 'propAddress' => 2, 'propLocation' => 3, 'propDescription' => 4, 'propArea' => 5, 'propPrice' => 6, 'propPubdate' => 7, 'propIshidden' => 8, ),
        self::TYPE_COLNAME       => array(PropertyTableMap::COL_PROP_ID => 0, PropertyTableMap::COL_PROP_NAME => 1, PropertyTableMap::COL_PROP_ADDRESS => 2, PropertyTableMap::COL_PROP_LOCATION => 3, PropertyTableMap::COL_PROP_DESCRIPTION => 4, PropertyTableMap::COL_PROP_AREA => 5, PropertyTableMap::COL_PROP_PRICE => 6, PropertyTableMap::COL_PROP_PUBDATE => 7, PropertyTableMap::COL_PROP_ISHIDDEN => 8, ),
        self::TYPE_FIELDNAME     => array('prop_id' => 0, 'prop_name' => 1, 'prop_address' => 2, 'prop_location' => 3, 'prop_description' => 4, 'prop_area' => 5, 'prop_price' => 6, 'prop_pubDate' => 7, 'prop_isHidden' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'PropId' => 'PROP_ID',
        'Property.PropId' => 'PROP_ID',
        'propId' => 'PROP_ID',
        'property.propId' => 'PROP_ID',
        'PropertyTableMap::COL_PROP_ID' => 'PROP_ID',
        'COL_PROP_ID' => 'PROP_ID',
        'prop_id' => 'PROP_ID',
        'Property.prop_id' => 'PROP_ID',
        'PropName' => 'PROP_NAME',
        'Property.PropName' => 'PROP_NAME',
        'propName' => 'PROP_NAME',
        'property.propName' => 'PROP_NAME',
        'PropertyTableMap::COL_PROP_NAME' => 'PROP_NAME',
        'COL_PROP_NAME' => 'PROP_NAME',
        'prop_name' => 'PROP_NAME',
        'Property.prop_name' => 'PROP_NAME',
        'PropAddress' => 'PROP_ADDRESS',
        'Property.PropAddress' => 'PROP_ADDRESS',
        'propAddress' => 'PROP_ADDRESS',
        'property.propAddress' => 'PROP_ADDRESS',
        'PropertyTableMap::COL_PROP_ADDRESS' => 'PROP_ADDRESS',
        'COL_PROP_ADDRESS' => 'PROP_ADDRESS',
        'prop_address' => 'PROP_ADDRESS',
        'Property.prop_address' => 'PROP_ADDRESS',
        'PropLocation' => 'PROP_LOCATION',
        'Property.PropLocation' => 'PROP_LOCATION',
        'propLocation' => 'PROP_LOCATION',
        'property.propLocation' => 'PROP_LOCATION',
        'PropertyTableMap::COL_PROP_LOCATION' => 'PROP_LOCATION',
        'COL_PROP_LOCATION' => 'PROP_LOCATION',
        'prop_location' => 'PROP_LOCATION',
        'Property.prop_location' => 'PROP_LOCATION',
        'PropDescription' => 'PROP_DESCRIPTION',
        'Property.PropDescription' => 'PROP_DESCRIPTION',
        'propDescription' => 'PROP_DESCRIPTION',
        'property.propDescription' => 'PROP_DESCRIPTION',
        'PropertyTableMap::COL_PROP_DESCRIPTION' => 'PROP_DESCRIPTION',
        'COL_PROP_DESCRIPTION' => 'PROP_DESCRIPTION',
        'prop_description' => 'PROP_DESCRIPTION',
        'Property.prop_description' => 'PROP_DESCRIPTION',
        'PropArea' => 'PROP_AREA',
        'Property.PropArea' => 'PROP_AREA',
        'propArea' => 'PROP_AREA',
        'property.propArea' => 'PROP_AREA',
        'PropertyTableMap::COL_PROP_AREA' => 'PROP_AREA',
        'COL_PROP_AREA' => 'PROP_AREA',
        'prop_area' => 'PROP_AREA',
        'Property.prop_area' => 'PROP_AREA',
        'PropPrice' => 'PROP_PRICE',
        'Property.PropPrice' => 'PROP_PRICE',
        'propPrice' => 'PROP_PRICE',
        'property.propPrice' => 'PROP_PRICE',
        'PropertyTableMap::COL_PROP_PRICE' => 'PROP_PRICE',
        'COL_PROP_PRICE' => 'PROP_PRICE',
        'prop_price' => 'PROP_PRICE',
        'Property.prop_price' => 'PROP_PRICE',
        'PropPubdate' => 'PROP_PUBDATE',
        'Property.PropPubdate' => 'PROP_PUBDATE',
        'propPubdate' => 'PROP_PUBDATE',
        'property.propPubdate' => 'PROP_PUBDATE',
        'PropertyTableMap::COL_PROP_PUBDATE' => 'PROP_PUBDATE',
        'COL_PROP_PUBDATE' => 'PROP_PUBDATE',
        'prop_pubDate' => 'PROP_PUBDATE',
        'Property.prop_pubDate' => 'PROP_PUBDATE',
        'PropIshidden' => 'PROP_ISHIDDEN',
        'Property.PropIshidden' => 'PROP_ISHIDDEN',
        'propIshidden' => 'PROP_ISHIDDEN',
        'property.propIshidden' => 'PROP_ISHIDDEN',
        'PropertyTableMap::COL_PROP_ISHIDDEN' => 'PROP_ISHIDDEN',
        'COL_PROP_ISHIDDEN' => 'PROP_ISHIDDEN',
        'prop_isHidden' => 'PROP_ISHIDDEN',
        'Property.prop_isHidden' => 'PROP_ISHIDDEN',
    ];

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('Property');
        $this->setPhpName('Property');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Property');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addPrimaryKey('prop_id', 'PropId', 'VARCHAR', true, 25, null);
        $this->addColumn('prop_name', 'PropName', 'VARCHAR', true, 100, '-');
        $this->addColumn('prop_address', 'PropAddress', 'VARCHAR', true, 100, '-');
        $this->addForeignKey('prop_location', 'PropLocation', 'INTEGER', 'Location', 'lo_id', true, null, null);
        $this->addColumn('prop_description', 'PropDescription', 'LONGVARCHAR', false, null, null);
        $this->addColumn('prop_area', 'PropArea', 'FLOAT', false, null, null);
        $this->addColumn('prop_price', 'PropPrice', 'DOUBLE', true, null, 0);
        $this->addColumn('prop_pubDate', 'PropPubdate', 'DATE', false, null, null);
        $this->addColumn('prop_isHidden', 'PropIshidden', 'INTEGER', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Location', '\\Location', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':prop_location',
    1 => ':lo_id',
  ),
), null, null, null, false);
        $this->addRelation('PropertyFeature', '\\PropertyFeature', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':propFeature_prop_id',
    1 => ':prop_id',
  ),
), null, null, 'PropertyFeatures', false);
        $this->addRelation('PropertyImage', '\\PropertyImage', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':propImg_prop_id',
    1 => ':prop_id',
  ),
), null, null, 'PropertyImages', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? PropertyTableMap::CLASS_DEFAULT : PropertyTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Property object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PropertyTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PropertyTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PropertyTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PropertyTableMap::OM_CLASS;
            /** @var Property $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PropertyTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = PropertyTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PropertyTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Property $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PropertyTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_ID);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_NAME);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_ADDRESS);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_LOCATION);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_DESCRIPTION);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_AREA);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_PRICE);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_PUBDATE);
            $criteria->addSelectColumn(PropertyTableMap::COL_PROP_ISHIDDEN);
        } else {
            $criteria->addSelectColumn($alias . '.prop_id');
            $criteria->addSelectColumn($alias . '.prop_name');
            $criteria->addSelectColumn($alias . '.prop_address');
            $criteria->addSelectColumn($alias . '.prop_location');
            $criteria->addSelectColumn($alias . '.prop_description');
            $criteria->addSelectColumn($alias . '.prop_area');
            $criteria->addSelectColumn($alias . '.prop_price');
            $criteria->addSelectColumn($alias . '.prop_pubDate');
            $criteria->addSelectColumn($alias . '.prop_isHidden');
        }
    }

    /**
     * Remove all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be removed as they are only loaded on demand.
     *
     * @param Criteria $criteria object containing the columns to remove.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function removeSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_ID);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_NAME);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_ADDRESS);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_LOCATION);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_DESCRIPTION);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_AREA);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_PRICE);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_PUBDATE);
            $criteria->removeSelectColumn(PropertyTableMap::COL_PROP_ISHIDDEN);
        } else {
            $criteria->removeSelectColumn($alias . '.prop_id');
            $criteria->removeSelectColumn($alias . '.prop_name');
            $criteria->removeSelectColumn($alias . '.prop_address');
            $criteria->removeSelectColumn($alias . '.prop_location');
            $criteria->removeSelectColumn($alias . '.prop_description');
            $criteria->removeSelectColumn($alias . '.prop_area');
            $criteria->removeSelectColumn($alias . '.prop_price');
            $criteria->removeSelectColumn($alias . '.prop_pubDate');
            $criteria->removeSelectColumn($alias . '.prop_isHidden');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(PropertyTableMap::DATABASE_NAME)->getTable(PropertyTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a Property or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Property object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Property) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PropertyTableMap::DATABASE_NAME);
            $criteria->add(PropertyTableMap::COL_PROP_ID, (array) $values, Criteria::IN);
        }

        $query = PropertyQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PropertyTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PropertyTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Property table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PropertyQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Property or Criteria object.
     *
     * @param mixed               $criteria Criteria or Property object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Property object
        }


        // Set the correct dbName
        $query = PropertyQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PropertyTableMap
