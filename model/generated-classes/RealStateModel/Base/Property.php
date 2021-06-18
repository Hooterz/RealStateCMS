<?php

namespace RealStateModel\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use RealStateModel\Location as ChildLocation;
use RealStateModel\LocationQuery as ChildLocationQuery;
use RealStateModel\Property as ChildProperty;
use RealStateModel\PropertyFeature as ChildPropertyFeature;
use RealStateModel\PropertyFeatureQuery as ChildPropertyFeatureQuery;
use RealStateModel\PropertyImage as ChildPropertyImage;
use RealStateModel\PropertyImageQuery as ChildPropertyImageQuery;
use RealStateModel\PropertyQuery as ChildPropertyQuery;
use RealStateModel\Map\PropertyFeatureTableMap;
use RealStateModel\Map\PropertyImageTableMap;
use RealStateModel\Map\PropertyTableMap;

/**
 * Base class that represents a row from the 'Property' table.
 *
 *
 *
 * @package    propel.generator.RealStateModel.Base
 */
abstract class Property implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\RealStateModel\\Map\\PropertyTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the prop_id field.
     *
     * @var        string
     */
    protected $prop_id;

    /**
     * The value for the prop_name field.
     *
     * Note: this column has a database default value of: '-'
     * @var        string
     */
    protected $prop_name;

    /**
     * The value for the prop_address field.
     *
     * Note: this column has a database default value of: '-'
     * @var        string
     */
    protected $prop_address;

    /**
     * The value for the prop_location field.
     *
     * @var        int
     */
    protected $prop_location;

    /**
     * The value for the prop_description field.
     *
     * @var        string|null
     */
    protected $prop_description;

    /**
     * The value for the prop_area field.
     *
     * @var        double|null
     */
    protected $prop_area;

    /**
     * The value for the prop_price field.
     *
     * Note: this column has a database default value of: 0.0
     * @var        double
     */
    protected $prop_price;

    /**
     * The value for the prop_pubdate field.
     *
     * @var        DateTime|null
     */
    protected $prop_pubdate;

    /**
     * The value for the prop_ishidden field.
     *
     * @var        int|null
     */
    protected $prop_ishidden;

    /**
     * @var        ChildLocation
     */
    protected $aLocation;

    /**
     * @var        ObjectCollection|ChildPropertyFeature[] Collection to store aggregation of ChildPropertyFeature objects.
     */
    protected $collPropertyFeatures;
    protected $collPropertyFeaturesPartial;

    /**
     * @var        ObjectCollection|ChildPropertyImage[] Collection to store aggregation of ChildPropertyImage objects.
     */
    protected $collPropertyImages;
    protected $collPropertyImagesPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPropertyFeature[]
     */
    protected $propertyFeaturesScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPropertyImage[]
     */
    protected $propertyImagesScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->prop_name = '-';
        $this->prop_address = '-';
        $this->prop_price = 0.0;
    }

    /**
     * Initializes internal state of RealStateModel\Base\Property object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Property</code> instance.  If
     * <code>obj</code> is an instance of <code>Property</code>, delegates to
     * <code>equals(Property)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @param  string  $keyType                (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME, TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM. Defaults to TableMap::TYPE_PHPNAME.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray($keyType, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [prop_id] column value.
     *
     * @return string
     */
    public function getPropId()
    {
        return $this->prop_id;
    }

    /**
     * Get the [prop_name] column value.
     *
     * @return string
     */
    public function getPropName()
    {
        return $this->prop_name;
    }

    /**
     * Get the [prop_address] column value.
     *
     * @return string
     */
    public function getPropAddress()
    {
        return $this->prop_address;
    }

    /**
     * Get the [prop_location] column value.
     *
     * @return int
     */
    public function getPropLocation()
    {
        return $this->prop_location;
    }

    /**
     * Get the [prop_description] column value.
     *
     * @return string|null
     */
    public function getPropDescription()
    {
        return $this->prop_description;
    }

    /**
     * Get the [prop_area] column value.
     *
     * @return double|null
     */
    public function getPropArea()
    {
        return $this->prop_area;
    }

    /**
     * Get the [prop_price] column value.
     *
     * @return double
     */
    public function getPropPrice()
    {
        return $this->prop_price;
    }

    /**
     * Get the [optionally formatted] temporal [prop_pubdate] column value.
     *
     *
     * @param string|null $format The date/time format string (either date()-style or strftime()-style).
     *   If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime|null Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     *
     * @psalm-return ($format is null ? DateTime|null : string|null)
     */
    public function getPropPubdate($format = null)
    {
        if ($format === null) {
            return $this->prop_pubdate;
        } else {
            return $this->prop_pubdate instanceof \DateTimeInterface ? $this->prop_pubdate->format($format) : null;
        }
    }

    /**
     * Get the [prop_ishidden] column value.
     *
     * @return int|null
     */
    public function getPropIshidden()
    {
        return $this->prop_ishidden;
    }

    /**
     * Set the value of [prop_id] column.
     *
     * @param string $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prop_id !== $v) {
            $this->prop_id = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_ID] = true;
        }

        return $this;
    } // setPropId()

    /**
     * Set the value of [prop_name] column.
     *
     * @param string $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prop_name !== $v) {
            $this->prop_name = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_NAME] = true;
        }

        return $this;
    } // setPropName()

    /**
     * Set the value of [prop_address] column.
     *
     * @param string $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropAddress($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prop_address !== $v) {
            $this->prop_address = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_ADDRESS] = true;
        }

        return $this;
    } // setPropAddress()

    /**
     * Set the value of [prop_location] column.
     *
     * @param int $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropLocation($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prop_location !== $v) {
            $this->prop_location = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_LOCATION] = true;
        }

        if ($this->aLocation !== null && $this->aLocation->getLoId() !== $v) {
            $this->aLocation = null;
        }

        return $this;
    } // setPropLocation()

    /**
     * Set the value of [prop_description] column.
     *
     * @param string|null $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->prop_description !== $v) {
            $this->prop_description = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_DESCRIPTION] = true;
        }

        return $this;
    } // setPropDescription()

    /**
     * Set the value of [prop_area] column.
     *
     * @param double|null $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropArea($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->prop_area !== $v) {
            $this->prop_area = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_AREA] = true;
        }

        return $this;
    } // setPropArea()

    /**
     * Set the value of [prop_price] column.
     *
     * @param double $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropPrice($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->prop_price !== $v) {
            $this->prop_price = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_PRICE] = true;
        }

        return $this;
    } // setPropPrice()

    /**
     * Sets the value of [prop_pubdate] column to a normalized version of the date/time value specified.
     *
     * @param  string|integer|\DateTimeInterface|null $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropPubdate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->prop_pubdate !== null || $dt !== null) {
            if ($this->prop_pubdate === null || $dt === null || $dt->format("Y-m-d") !== $this->prop_pubdate->format("Y-m-d")) {
                $this->prop_pubdate = $dt === null ? null : clone $dt;
                $this->modifiedColumns[PropertyTableMap::COL_PROP_PUBDATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPropPubdate()

    /**
     * Set the value of [prop_ishidden] column.
     *
     * @param int|null $v New value
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function setPropIshidden($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->prop_ishidden !== $v) {
            $this->prop_ishidden = $v;
            $this->modifiedColumns[PropertyTableMap::COL_PROP_ISHIDDEN] = true;
        }

        return $this;
    } // setPropIshidden()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->prop_name !== '-') {
                return false;
            }

            if ($this->prop_address !== '-') {
                return false;
            }

            if ($this->prop_price !== 0.0) {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : PropertyTableMap::translateFieldName('PropId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : PropertyTableMap::translateFieldName('PropName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : PropertyTableMap::translateFieldName('PropAddress', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_address = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : PropertyTableMap::translateFieldName('PropLocation', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_location = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : PropertyTableMap::translateFieldName('PropDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : PropertyTableMap::translateFieldName('PropArea', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_area = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : PropertyTableMap::translateFieldName('PropPrice', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_price = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : PropertyTableMap::translateFieldName('PropPubdate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->prop_pubdate = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : PropertyTableMap::translateFieldName('PropIshidden', TableMap::TYPE_PHPNAME, $indexType)];
            $this->prop_ishidden = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 9; // 9 = PropertyTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\RealStateModel\\Property'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aLocation !== null && $this->prop_location !== $this->aLocation->getLoId()) {
            $this->aLocation = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PropertyTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildPropertyQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aLocation = null;
            $this->collPropertyFeatures = null;

            $this->collPropertyImages = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Property::setDeleted()
     * @see Property::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildPropertyQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PropertyTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aLocation !== null) {
                if ($this->aLocation->isModified() || $this->aLocation->isNew()) {
                    $affectedRows += $this->aLocation->save($con);
                }
                $this->setLocation($this->aLocation);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->propertyFeaturesScheduledForDeletion !== null) {
                if (!$this->propertyFeaturesScheduledForDeletion->isEmpty()) {
                    foreach ($this->propertyFeaturesScheduledForDeletion as $propertyFeature) {
                        // need to save related object because we set the relation to null
                        $propertyFeature->save($con);
                    }
                    $this->propertyFeaturesScheduledForDeletion = null;
                }
            }

            if ($this->collPropertyFeatures !== null) {
                foreach ($this->collPropertyFeatures as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->propertyImagesScheduledForDeletion !== null) {
                if (!$this->propertyImagesScheduledForDeletion->isEmpty()) {
                    foreach ($this->propertyImagesScheduledForDeletion as $propertyImage) {
                        // need to save related object because we set the relation to null
                        $propertyImage->save($con);
                    }
                    $this->propertyImagesScheduledForDeletion = null;
                }
            }

            if ($this->collPropertyImages !== null) {
                foreach ($this->collPropertyImages as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ID)) {
            $modifiedColumns[':p' . $index++]  = 'prop_id';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'prop_name';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ADDRESS)) {
            $modifiedColumns[':p' . $index++]  = 'prop_address';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_LOCATION)) {
            $modifiedColumns[':p' . $index++]  = 'prop_location';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'prop_description';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_AREA)) {
            $modifiedColumns[':p' . $index++]  = 'prop_area';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_PRICE)) {
            $modifiedColumns[':p' . $index++]  = 'prop_price';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_PUBDATE)) {
            $modifiedColumns[':p' . $index++]  = 'prop_pubDate';
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ISHIDDEN)) {
            $modifiedColumns[':p' . $index++]  = 'prop_isHidden';
        }

        $sql = sprintf(
            'INSERT INTO Property (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'prop_id':
                        $stmt->bindValue($identifier, $this->prop_id, PDO::PARAM_STR);
                        break;
                    case 'prop_name':
                        $stmt->bindValue($identifier, $this->prop_name, PDO::PARAM_STR);
                        break;
                    case 'prop_address':
                        $stmt->bindValue($identifier, $this->prop_address, PDO::PARAM_STR);
                        break;
                    case 'prop_location':
                        $stmt->bindValue($identifier, $this->prop_location, PDO::PARAM_INT);
                        break;
                    case 'prop_description':
                        $stmt->bindValue($identifier, $this->prop_description, PDO::PARAM_STR);
                        break;
                    case 'prop_area':
                        $stmt->bindValue($identifier, $this->prop_area, PDO::PARAM_STR);
                        break;
                    case 'prop_price':
                        $stmt->bindValue($identifier, $this->prop_price, PDO::PARAM_STR);
                        break;
                    case 'prop_pubDate':
                        $stmt->bindValue($identifier, $this->prop_pubdate ? $this->prop_pubdate->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'prop_isHidden':
                        $stmt->bindValue($identifier, $this->prop_ishidden, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PropertyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPropId();
                break;
            case 1:
                return $this->getPropName();
                break;
            case 2:
                return $this->getPropAddress();
                break;
            case 3:
                return $this->getPropLocation();
                break;
            case 4:
                return $this->getPropDescription();
                break;
            case 5:
                return $this->getPropArea();
                break;
            case 6:
                return $this->getPropPrice();
                break;
            case 7:
                return $this->getPropPubdate();
                break;
            case 8:
                return $this->getPropIshidden();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Property'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Property'][$this->hashCode()] = true;
        $keys = PropertyTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPropId(),
            $keys[1] => $this->getPropName(),
            $keys[2] => $this->getPropAddress(),
            $keys[3] => $this->getPropLocation(),
            $keys[4] => $this->getPropDescription(),
            $keys[5] => $this->getPropArea(),
            $keys[6] => $this->getPropPrice(),
            $keys[7] => $this->getPropPubdate(),
            $keys[8] => $this->getPropIshidden(),
        );
        if ($result[$keys[7]] instanceof \DateTimeInterface) {
            $result[$keys[7]] = $result[$keys[7]]->format('Y-m-d');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aLocation) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'location';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Location';
                        break;
                    default:
                        $key = 'Location';
                }

                $result[$key] = $this->aLocation->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPropertyFeatures) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'propertyFeatures';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Property_Features';
                        break;
                    default:
                        $key = 'PropertyFeatures';
                }

                $result[$key] = $this->collPropertyFeatures->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPropertyImages) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'propertyImages';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'Property_Images';
                        break;
                    default:
                        $key = 'PropertyImages';
                }

                $result[$key] = $this->collPropertyImages->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\RealStateModel\Property
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = PropertyTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\RealStateModel\Property
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPropId($value);
                break;
            case 1:
                $this->setPropName($value);
                break;
            case 2:
                $this->setPropAddress($value);
                break;
            case 3:
                $this->setPropLocation($value);
                break;
            case 4:
                $this->setPropDescription($value);
                break;
            case 5:
                $this->setPropArea($value);
                break;
            case 6:
                $this->setPropPrice($value);
                break;
            case 7:
                $this->setPropPubdate($value);
                break;
            case 8:
                $this->setPropIshidden($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return     $this|\RealStateModel\Property
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = PropertyTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPropId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPropName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPropAddress($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPropLocation($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPropDescription($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPropArea($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPropPrice($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPropPubdate($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setPropIshidden($arr[$keys[8]]);
        }

        return $this;
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\RealStateModel\Property The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PropertyTableMap::DATABASE_NAME);

        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ID)) {
            $criteria->add(PropertyTableMap::COL_PROP_ID, $this->prop_id);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_NAME)) {
            $criteria->add(PropertyTableMap::COL_PROP_NAME, $this->prop_name);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ADDRESS)) {
            $criteria->add(PropertyTableMap::COL_PROP_ADDRESS, $this->prop_address);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_LOCATION)) {
            $criteria->add(PropertyTableMap::COL_PROP_LOCATION, $this->prop_location);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_DESCRIPTION)) {
            $criteria->add(PropertyTableMap::COL_PROP_DESCRIPTION, $this->prop_description);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_AREA)) {
            $criteria->add(PropertyTableMap::COL_PROP_AREA, $this->prop_area);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_PRICE)) {
            $criteria->add(PropertyTableMap::COL_PROP_PRICE, $this->prop_price);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_PUBDATE)) {
            $criteria->add(PropertyTableMap::COL_PROP_PUBDATE, $this->prop_pubdate);
        }
        if ($this->isColumnModified(PropertyTableMap::COL_PROP_ISHIDDEN)) {
            $criteria->add(PropertyTableMap::COL_PROP_ISHIDDEN, $this->prop_ishidden);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildPropertyQuery::create();
        $criteria->add(PropertyTableMap::COL_PROP_ID, $this->prop_id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getPropId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getPropId();
    }

    /**
     * Generic method to set the primary key (prop_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPropId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPropId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \RealStateModel\Property (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPropId($this->getPropId());
        $copyObj->setPropName($this->getPropName());
        $copyObj->setPropAddress($this->getPropAddress());
        $copyObj->setPropLocation($this->getPropLocation());
        $copyObj->setPropDescription($this->getPropDescription());
        $copyObj->setPropArea($this->getPropArea());
        $copyObj->setPropPrice($this->getPropPrice());
        $copyObj->setPropPubdate($this->getPropPubdate());
        $copyObj->setPropIshidden($this->getPropIshidden());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPropertyFeatures() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPropertyFeature($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPropertyImages() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPropertyImage($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \RealStateModel\Property Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildLocation object.
     *
     * @param  ChildLocation $v
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLocation(ChildLocation $v = null)
    {
        if ($v === null) {
            $this->setPropLocation(NULL);
        } else {
            $this->setPropLocation($v->getLoId());
        }

        $this->aLocation = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildLocation object, it will not be re-added.
        if ($v !== null) {
            $v->addProperty($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildLocation object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildLocation The associated ChildLocation object.
     * @throws PropelException
     */
    public function getLocation(ConnectionInterface $con = null)
    {
        if ($this->aLocation === null && ($this->prop_location != 0)) {
            $this->aLocation = ChildLocationQuery::create()->findPk($this->prop_location, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLocation->addProperties($this);
             */
        }

        return $this->aLocation;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PropertyFeature' === $relationName) {
            $this->initPropertyFeatures();
            return;
        }
        if ('PropertyImage' === $relationName) {
            $this->initPropertyImages();
            return;
        }
    }

    /**
     * Clears out the collPropertyFeatures collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPropertyFeatures()
     */
    public function clearPropertyFeatures()
    {
        $this->collPropertyFeatures = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPropertyFeatures collection loaded partially.
     */
    public function resetPartialPropertyFeatures($v = true)
    {
        $this->collPropertyFeaturesPartial = $v;
    }

    /**
     * Initializes the collPropertyFeatures collection.
     *
     * By default this just sets the collPropertyFeatures collection to an empty array (like clearcollPropertyFeatures());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPropertyFeatures($overrideExisting = true)
    {
        if (null !== $this->collPropertyFeatures && !$overrideExisting) {
            return;
        }

        $collectionClassName = PropertyFeatureTableMap::getTableMap()->getCollectionClassName();

        $this->collPropertyFeatures = new $collectionClassName;
        $this->collPropertyFeatures->setModel('\RealStateModel\PropertyFeature');
    }

    /**
     * Gets an array of ChildPropertyFeature objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProperty is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPropertyFeature[] List of ChildPropertyFeature objects
     * @throws PropelException
     */
    public function getPropertyFeatures(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPropertyFeaturesPartial && !$this->isNew();
        if (null === $this->collPropertyFeatures || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPropertyFeatures) {
                    $this->initPropertyFeatures();
                } else {
                    $collectionClassName = PropertyFeatureTableMap::getTableMap()->getCollectionClassName();

                    $collPropertyFeatures = new $collectionClassName;
                    $collPropertyFeatures->setModel('\RealStateModel\PropertyFeature');

                    return $collPropertyFeatures;
                }
            } else {
                $collPropertyFeatures = ChildPropertyFeatureQuery::create(null, $criteria)
                    ->filterByProperty($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPropertyFeaturesPartial && count($collPropertyFeatures)) {
                        $this->initPropertyFeatures(false);

                        foreach ($collPropertyFeatures as $obj) {
                            if (false == $this->collPropertyFeatures->contains($obj)) {
                                $this->collPropertyFeatures->append($obj);
                            }
                        }

                        $this->collPropertyFeaturesPartial = true;
                    }

                    return $collPropertyFeatures;
                }

                if ($partial && $this->collPropertyFeatures) {
                    foreach ($this->collPropertyFeatures as $obj) {
                        if ($obj->isNew()) {
                            $collPropertyFeatures[] = $obj;
                        }
                    }
                }

                $this->collPropertyFeatures = $collPropertyFeatures;
                $this->collPropertyFeaturesPartial = false;
            }
        }

        return $this->collPropertyFeatures;
    }

    /**
     * Sets a collection of ChildPropertyFeature objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $propertyFeatures A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProperty The current object (for fluent API support)
     */
    public function setPropertyFeatures(Collection $propertyFeatures, ConnectionInterface $con = null)
    {
        /** @var ChildPropertyFeature[] $propertyFeaturesToDelete */
        $propertyFeaturesToDelete = $this->getPropertyFeatures(new Criteria(), $con)->diff($propertyFeatures);


        $this->propertyFeaturesScheduledForDeletion = $propertyFeaturesToDelete;

        foreach ($propertyFeaturesToDelete as $propertyFeatureRemoved) {
            $propertyFeatureRemoved->setProperty(null);
        }

        $this->collPropertyFeatures = null;
        foreach ($propertyFeatures as $propertyFeature) {
            $this->addPropertyFeature($propertyFeature);
        }

        $this->collPropertyFeatures = $propertyFeatures;
        $this->collPropertyFeaturesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PropertyFeature objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PropertyFeature objects.
     * @throws PropelException
     */
    public function countPropertyFeatures(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPropertyFeaturesPartial && !$this->isNew();
        if (null === $this->collPropertyFeatures || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPropertyFeatures) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPropertyFeatures());
            }

            $query = ChildPropertyFeatureQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProperty($this)
                ->count($con);
        }

        return count($this->collPropertyFeatures);
    }

    /**
     * Method called to associate a ChildPropertyFeature object to this object
     * through the ChildPropertyFeature foreign key attribute.
     *
     * @param  ChildPropertyFeature $l ChildPropertyFeature
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function addPropertyFeature(ChildPropertyFeature $l)
    {
        if ($this->collPropertyFeatures === null) {
            $this->initPropertyFeatures();
            $this->collPropertyFeaturesPartial = true;
        }

        if (!$this->collPropertyFeatures->contains($l)) {
            $this->doAddPropertyFeature($l);

            if ($this->propertyFeaturesScheduledForDeletion and $this->propertyFeaturesScheduledForDeletion->contains($l)) {
                $this->propertyFeaturesScheduledForDeletion->remove($this->propertyFeaturesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPropertyFeature $propertyFeature The ChildPropertyFeature object to add.
     */
    protected function doAddPropertyFeature(ChildPropertyFeature $propertyFeature)
    {
        $this->collPropertyFeatures[]= $propertyFeature;
        $propertyFeature->setProperty($this);
    }

    /**
     * @param  ChildPropertyFeature $propertyFeature The ChildPropertyFeature object to remove.
     * @return $this|ChildProperty The current object (for fluent API support)
     */
    public function removePropertyFeature(ChildPropertyFeature $propertyFeature)
    {
        if ($this->getPropertyFeatures()->contains($propertyFeature)) {
            $pos = $this->collPropertyFeatures->search($propertyFeature);
            $this->collPropertyFeatures->remove($pos);
            if (null === $this->propertyFeaturesScheduledForDeletion) {
                $this->propertyFeaturesScheduledForDeletion = clone $this->collPropertyFeatures;
                $this->propertyFeaturesScheduledForDeletion->clear();
            }
            $this->propertyFeaturesScheduledForDeletion[]= $propertyFeature;
            $propertyFeature->setProperty(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Property is new, it will return
     * an empty collection; or if this Property has previously
     * been saved, it will retrieve related PropertyFeatures from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Property.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPropertyFeature[] List of ChildPropertyFeature objects
     */
    public function getPropertyFeaturesJoinFeature(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPropertyFeatureQuery::create(null, $criteria);
        $query->joinWith('Feature', $joinBehavior);

        return $this->getPropertyFeatures($query, $con);
    }

    /**
     * Clears out the collPropertyImages collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPropertyImages()
     */
    public function clearPropertyImages()
    {
        $this->collPropertyImages = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPropertyImages collection loaded partially.
     */
    public function resetPartialPropertyImages($v = true)
    {
        $this->collPropertyImagesPartial = $v;
    }

    /**
     * Initializes the collPropertyImages collection.
     *
     * By default this just sets the collPropertyImages collection to an empty array (like clearcollPropertyImages());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPropertyImages($overrideExisting = true)
    {
        if (null !== $this->collPropertyImages && !$overrideExisting) {
            return;
        }

        $collectionClassName = PropertyImageTableMap::getTableMap()->getCollectionClassName();

        $this->collPropertyImages = new $collectionClassName;
        $this->collPropertyImages->setModel('\RealStateModel\PropertyImage');
    }

    /**
     * Gets an array of ChildPropertyImage objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildProperty is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPropertyImage[] List of ChildPropertyImage objects
     * @throws PropelException
     */
    public function getPropertyImages(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPropertyImagesPartial && !$this->isNew();
        if (null === $this->collPropertyImages || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPropertyImages) {
                    $this->initPropertyImages();
                } else {
                    $collectionClassName = PropertyImageTableMap::getTableMap()->getCollectionClassName();

                    $collPropertyImages = new $collectionClassName;
                    $collPropertyImages->setModel('\RealStateModel\PropertyImage');

                    return $collPropertyImages;
                }
            } else {
                $collPropertyImages = ChildPropertyImageQuery::create(null, $criteria)
                    ->filterByProperty($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPropertyImagesPartial && count($collPropertyImages)) {
                        $this->initPropertyImages(false);

                        foreach ($collPropertyImages as $obj) {
                            if (false == $this->collPropertyImages->contains($obj)) {
                                $this->collPropertyImages->append($obj);
                            }
                        }

                        $this->collPropertyImagesPartial = true;
                    }

                    return $collPropertyImages;
                }

                if ($partial && $this->collPropertyImages) {
                    foreach ($this->collPropertyImages as $obj) {
                        if ($obj->isNew()) {
                            $collPropertyImages[] = $obj;
                        }
                    }
                }

                $this->collPropertyImages = $collPropertyImages;
                $this->collPropertyImagesPartial = false;
            }
        }

        return $this->collPropertyImages;
    }

    /**
     * Sets a collection of ChildPropertyImage objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $propertyImages A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildProperty The current object (for fluent API support)
     */
    public function setPropertyImages(Collection $propertyImages, ConnectionInterface $con = null)
    {
        /** @var ChildPropertyImage[] $propertyImagesToDelete */
        $propertyImagesToDelete = $this->getPropertyImages(new Criteria(), $con)->diff($propertyImages);


        $this->propertyImagesScheduledForDeletion = $propertyImagesToDelete;

        foreach ($propertyImagesToDelete as $propertyImageRemoved) {
            $propertyImageRemoved->setProperty(null);
        }

        $this->collPropertyImages = null;
        foreach ($propertyImages as $propertyImage) {
            $this->addPropertyImage($propertyImage);
        }

        $this->collPropertyImages = $propertyImages;
        $this->collPropertyImagesPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PropertyImage objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related PropertyImage objects.
     * @throws PropelException
     */
    public function countPropertyImages(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPropertyImagesPartial && !$this->isNew();
        if (null === $this->collPropertyImages || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPropertyImages) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPropertyImages());
            }

            $query = ChildPropertyImageQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByProperty($this)
                ->count($con);
        }

        return count($this->collPropertyImages);
    }

    /**
     * Method called to associate a ChildPropertyImage object to this object
     * through the ChildPropertyImage foreign key attribute.
     *
     * @param  ChildPropertyImage $l ChildPropertyImage
     * @return $this|\RealStateModel\Property The current object (for fluent API support)
     */
    public function addPropertyImage(ChildPropertyImage $l)
    {
        if ($this->collPropertyImages === null) {
            $this->initPropertyImages();
            $this->collPropertyImagesPartial = true;
        }

        if (!$this->collPropertyImages->contains($l)) {
            $this->doAddPropertyImage($l);

            if ($this->propertyImagesScheduledForDeletion and $this->propertyImagesScheduledForDeletion->contains($l)) {
                $this->propertyImagesScheduledForDeletion->remove($this->propertyImagesScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPropertyImage $propertyImage The ChildPropertyImage object to add.
     */
    protected function doAddPropertyImage(ChildPropertyImage $propertyImage)
    {
        $this->collPropertyImages[]= $propertyImage;
        $propertyImage->setProperty($this);
    }

    /**
     * @param  ChildPropertyImage $propertyImage The ChildPropertyImage object to remove.
     * @return $this|ChildProperty The current object (for fluent API support)
     */
    public function removePropertyImage(ChildPropertyImage $propertyImage)
    {
        if ($this->getPropertyImages()->contains($propertyImage)) {
            $pos = $this->collPropertyImages->search($propertyImage);
            $this->collPropertyImages->remove($pos);
            if (null === $this->propertyImagesScheduledForDeletion) {
                $this->propertyImagesScheduledForDeletion = clone $this->collPropertyImages;
                $this->propertyImagesScheduledForDeletion->clear();
            }
            $this->propertyImagesScheduledForDeletion[]= $propertyImage;
            $propertyImage->setProperty(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Property is new, it will return
     * an empty collection; or if this Property has previously
     * been saved, it will retrieve related PropertyImages from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Property.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPropertyImage[] List of ChildPropertyImage objects
     */
    public function getPropertyImagesJoinImage(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPropertyImageQuery::create(null, $criteria);
        $query->joinWith('Image', $joinBehavior);

        return $this->getPropertyImages($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aLocation) {
            $this->aLocation->removeProperty($this);
        }
        $this->prop_id = null;
        $this->prop_name = null;
        $this->prop_address = null;
        $this->prop_location = null;
        $this->prop_description = null;
        $this->prop_area = null;
        $this->prop_price = null;
        $this->prop_pubdate = null;
        $this->prop_ishidden = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPropertyFeatures) {
                foreach ($this->collPropertyFeatures as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPropertyImages) {
                foreach ($this->collPropertyImages as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPropertyFeatures = null;
        $this->collPropertyImages = null;
        $this->aLocation = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PropertyTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);
            $inputData = $params[0];
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->importFrom($format, $inputData, $keyType);
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = $params[0] ?? true;
            $keyType = $params[1] ?? TableMap::TYPE_PHPNAME;

            return $this->exportTo($format, $includeLazyLoadColumns, $keyType);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
