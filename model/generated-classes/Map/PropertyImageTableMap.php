<?php

namespace Map;

use \PropertyImage;
use \PropertyImageQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'Property_Image' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PropertyImageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.PropertyImageTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'RealState';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'Property_Image';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\PropertyImage';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'PropertyImage';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 2;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 2;

    /**
     * the column name for the propImg_prop_id field
     */
    const COL_PROPIMG_PROP_ID = 'Property_Image.propImg_prop_id';

    /**
     * the column name for the propImg_img_id field
     */
    const COL_PROPIMG_IMG_ID = 'Property_Image.propImg_img_id';

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
        self::TYPE_PHPNAME       => array('PropimgPropId', 'PropimgImgId', ),
        self::TYPE_CAMELNAME     => array('propimgPropId', 'propimgImgId', ),
        self::TYPE_COLNAME       => array(PropertyImageTableMap::COL_PROPIMG_PROP_ID, PropertyImageTableMap::COL_PROPIMG_IMG_ID, ),
        self::TYPE_FIELDNAME     => array('propImg_prop_id', 'propImg_img_id', ),
        self::TYPE_NUM           => array(0, 1, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PropimgPropId' => 0, 'PropimgImgId' => 1, ),
        self::TYPE_CAMELNAME     => array('propimgPropId' => 0, 'propimgImgId' => 1, ),
        self::TYPE_COLNAME       => array(PropertyImageTableMap::COL_PROPIMG_PROP_ID => 0, PropertyImageTableMap::COL_PROPIMG_IMG_ID => 1, ),
        self::TYPE_FIELDNAME     => array('propImg_prop_id' => 0, 'propImg_img_id' => 1, ),
        self::TYPE_NUM           => array(0, 1, )
    );

    /**
     * Holds a list of column names and their normalized version.
     *
     * @var string[]
     */
    protected $normalizedColumnNameMap = [
        'PropimgPropId' => 'PROPIMG_PROP_ID',
        'PropertyImage.PropimgPropId' => 'PROPIMG_PROP_ID',
        'propimgPropId' => 'PROPIMG_PROP_ID',
        'propertyImage.propimgPropId' => 'PROPIMG_PROP_ID',
        'PropertyImageTableMap::COL_PROPIMG_PROP_ID' => 'PROPIMG_PROP_ID',
        'COL_PROPIMG_PROP_ID' => 'PROPIMG_PROP_ID',
        'propImg_prop_id' => 'PROPIMG_PROP_ID',
        'Property_Image.propImg_prop_id' => 'PROPIMG_PROP_ID',
        'PropimgImgId' => 'PROPIMG_IMG_ID',
        'PropertyImage.PropimgImgId' => 'PROPIMG_IMG_ID',
        'propimgImgId' => 'PROPIMG_IMG_ID',
        'propertyImage.propimgImgId' => 'PROPIMG_IMG_ID',
        'PropertyImageTableMap::COL_PROPIMG_IMG_ID' => 'PROPIMG_IMG_ID',
        'COL_PROPIMG_IMG_ID' => 'PROPIMG_IMG_ID',
        'propImg_img_id' => 'PROPIMG_IMG_ID',
        'Property_Image.propImg_img_id' => 'PROPIMG_IMG_ID',
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
        $this->setName('Property_Image');
        $this->setPhpName('PropertyImage');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\PropertyImage');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignKey('propImg_prop_id', 'PropimgPropId', 'VARCHAR', 'Property', 'prop_id', false, 25, null);
        $this->addForeignKey('propImg_img_id', 'PropimgImgId', 'INTEGER', 'Image', 'img_id', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Property', '\\Property', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':propImg_prop_id',
    1 => ':prop_id',
  ),
), null, null, null, false);
        $this->addRelation('Image', '\\Image', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':propImg_img_id',
    1 => ':img_id',
  ),
), null, null, null, false);
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
        return null;
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
        return '';
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
        return $withPrefix ? PropertyImageTableMap::CLASS_DEFAULT : PropertyImageTableMap::OM_CLASS;
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
     * @return array           (PropertyImage object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PropertyImageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PropertyImageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PropertyImageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PropertyImageTableMap::OM_CLASS;
            /** @var PropertyImage $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PropertyImageTableMap::addInstanceToPool($obj, $key);
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
            $key = PropertyImageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PropertyImageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var PropertyImage $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PropertyImageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PropertyImageTableMap::COL_PROPIMG_PROP_ID);
            $criteria->addSelectColumn(PropertyImageTableMap::COL_PROPIMG_IMG_ID);
        } else {
            $criteria->addSelectColumn($alias . '.propImg_prop_id');
            $criteria->addSelectColumn($alias . '.propImg_img_id');
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
            $criteria->removeSelectColumn(PropertyImageTableMap::COL_PROPIMG_PROP_ID);
            $criteria->removeSelectColumn(PropertyImageTableMap::COL_PROPIMG_IMG_ID);
        } else {
            $criteria->removeSelectColumn($alias . '.propImg_prop_id');
            $criteria->removeSelectColumn($alias . '.propImg_img_id');
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
        return Propel::getServiceContainer()->getDatabaseMap(PropertyImageTableMap::DATABASE_NAME)->getTable(PropertyImageTableMap::TABLE_NAME);
    }

    /**
     * Performs a DELETE on the database, given a PropertyImage or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or PropertyImage object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyImageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \PropertyImage) { // it's a model object
            // create criteria based on pk value
            $criteria = $values->buildCriteria();
        } else { // it's a primary key, or an array of pks
            throw new LogicException('The PropertyImage object has no primary key');
        }

        $query = PropertyImageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PropertyImageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PropertyImageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the Property_Image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PropertyImageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a PropertyImage or Criteria object.
     *
     * @param mixed               $criteria Criteria or PropertyImage object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyImageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from PropertyImage object
        }


        // Set the correct dbName
        $query = PropertyImageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PropertyImageTableMap
