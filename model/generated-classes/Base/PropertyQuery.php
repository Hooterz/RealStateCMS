<?php

namespace Base;

use \Property as ChildProperty;
use \PropertyQuery as ChildPropertyQuery;
use \Exception;
use \PDO;
use Map\PropertyTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Property' table.
 *
 *
 *
 * @method     ChildPropertyQuery orderByPropId($order = Criteria::ASC) Order by the prop_id column
 * @method     ChildPropertyQuery orderByPropName($order = Criteria::ASC) Order by the prop_name column
 * @method     ChildPropertyQuery orderByPropAddress($order = Criteria::ASC) Order by the prop_address column
 * @method     ChildPropertyQuery orderByPropLocation($order = Criteria::ASC) Order by the prop_location column
 * @method     ChildPropertyQuery orderByPropDescription($order = Criteria::ASC) Order by the prop_description column
 * @method     ChildPropertyQuery orderByPropArea($order = Criteria::ASC) Order by the prop_area column
 * @method     ChildPropertyQuery orderByPropPrice($order = Criteria::ASC) Order by the prop_price column
 * @method     ChildPropertyQuery orderByPropPubdate($order = Criteria::ASC) Order by the prop_pubDate column
 * @method     ChildPropertyQuery orderByPropIshidden($order = Criteria::ASC) Order by the prop_isHidden column
 *
 * @method     ChildPropertyQuery groupByPropId() Group by the prop_id column
 * @method     ChildPropertyQuery groupByPropName() Group by the prop_name column
 * @method     ChildPropertyQuery groupByPropAddress() Group by the prop_address column
 * @method     ChildPropertyQuery groupByPropLocation() Group by the prop_location column
 * @method     ChildPropertyQuery groupByPropDescription() Group by the prop_description column
 * @method     ChildPropertyQuery groupByPropArea() Group by the prop_area column
 * @method     ChildPropertyQuery groupByPropPrice() Group by the prop_price column
 * @method     ChildPropertyQuery groupByPropPubdate() Group by the prop_pubDate column
 * @method     ChildPropertyQuery groupByPropIshidden() Group by the prop_isHidden column
 *
 * @method     ChildPropertyQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPropertyQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPropertyQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPropertyQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPropertyQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPropertyQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPropertyQuery leftJoinLocation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Location relation
 * @method     ChildPropertyQuery rightJoinLocation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Location relation
 * @method     ChildPropertyQuery innerJoinLocation($relationAlias = null) Adds a INNER JOIN clause to the query using the Location relation
 *
 * @method     ChildPropertyQuery joinWithLocation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Location relation
 *
 * @method     ChildPropertyQuery leftJoinWithLocation() Adds a LEFT JOIN clause and with to the query using the Location relation
 * @method     ChildPropertyQuery rightJoinWithLocation() Adds a RIGHT JOIN clause and with to the query using the Location relation
 * @method     ChildPropertyQuery innerJoinWithLocation() Adds a INNER JOIN clause and with to the query using the Location relation
 *
 * @method     ChildPropertyQuery leftJoinPropertyFeature($relationAlias = null) Adds a LEFT JOIN clause to the query using the PropertyFeature relation
 * @method     ChildPropertyQuery rightJoinPropertyFeature($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PropertyFeature relation
 * @method     ChildPropertyQuery innerJoinPropertyFeature($relationAlias = null) Adds a INNER JOIN clause to the query using the PropertyFeature relation
 *
 * @method     ChildPropertyQuery joinWithPropertyFeature($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PropertyFeature relation
 *
 * @method     ChildPropertyQuery leftJoinWithPropertyFeature() Adds a LEFT JOIN clause and with to the query using the PropertyFeature relation
 * @method     ChildPropertyQuery rightJoinWithPropertyFeature() Adds a RIGHT JOIN clause and with to the query using the PropertyFeature relation
 * @method     ChildPropertyQuery innerJoinWithPropertyFeature() Adds a INNER JOIN clause and with to the query using the PropertyFeature relation
 *
 * @method     ChildPropertyQuery leftJoinPropertyImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the PropertyImage relation
 * @method     ChildPropertyQuery rightJoinPropertyImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PropertyImage relation
 * @method     ChildPropertyQuery innerJoinPropertyImage($relationAlias = null) Adds a INNER JOIN clause to the query using the PropertyImage relation
 *
 * @method     ChildPropertyQuery joinWithPropertyImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PropertyImage relation
 *
 * @method     ChildPropertyQuery leftJoinWithPropertyImage() Adds a LEFT JOIN clause and with to the query using the PropertyImage relation
 * @method     ChildPropertyQuery rightJoinWithPropertyImage() Adds a RIGHT JOIN clause and with to the query using the PropertyImage relation
 * @method     ChildPropertyQuery innerJoinWithPropertyImage() Adds a INNER JOIN clause and with to the query using the PropertyImage relation
 *
 * @method     \LocationQuery|\PropertyFeatureQuery|\PropertyImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildProperty|null findOne(ConnectionInterface $con = null) Return the first ChildProperty matching the query
 * @method     ChildProperty findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProperty matching the query, or a new ChildProperty object populated from the query conditions when no match is found
 *
 * @method     ChildProperty|null findOneByPropId(string $prop_id) Return the first ChildProperty filtered by the prop_id column
 * @method     ChildProperty|null findOneByPropName(string $prop_name) Return the first ChildProperty filtered by the prop_name column
 * @method     ChildProperty|null findOneByPropAddress(string $prop_address) Return the first ChildProperty filtered by the prop_address column
 * @method     ChildProperty|null findOneByPropLocation(int $prop_location) Return the first ChildProperty filtered by the prop_location column
 * @method     ChildProperty|null findOneByPropDescription(string $prop_description) Return the first ChildProperty filtered by the prop_description column
 * @method     ChildProperty|null findOneByPropArea(double $prop_area) Return the first ChildProperty filtered by the prop_area column
 * @method     ChildProperty|null findOneByPropPrice(double $prop_price) Return the first ChildProperty filtered by the prop_price column
 * @method     ChildProperty|null findOneByPropPubdate(string $prop_pubDate) Return the first ChildProperty filtered by the prop_pubDate column
 * @method     ChildProperty|null findOneByPropIshidden(int $prop_isHidden) Return the first ChildProperty filtered by the prop_isHidden column *

 * @method     ChildProperty requirePk($key, ConnectionInterface $con = null) Return the ChildProperty by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOne(ConnectionInterface $con = null) Return the first ChildProperty matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProperty requireOneByPropId(string $prop_id) Return the first ChildProperty filtered by the prop_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropName(string $prop_name) Return the first ChildProperty filtered by the prop_name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropAddress(string $prop_address) Return the first ChildProperty filtered by the prop_address column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropLocation(int $prop_location) Return the first ChildProperty filtered by the prop_location column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropDescription(string $prop_description) Return the first ChildProperty filtered by the prop_description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropArea(double $prop_area) Return the first ChildProperty filtered by the prop_area column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropPrice(double $prop_price) Return the first ChildProperty filtered by the prop_price column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropPubdate(string $prop_pubDate) Return the first ChildProperty filtered by the prop_pubDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildProperty requireOneByPropIshidden(int $prop_isHidden) Return the first ChildProperty filtered by the prop_isHidden column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildProperty[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProperty objects based on current ModelCriteria
 * @method     ChildProperty[]|ObjectCollection findByPropId(string $prop_id) Return ChildProperty objects filtered by the prop_id column
 * @method     ChildProperty[]|ObjectCollection findByPropName(string $prop_name) Return ChildProperty objects filtered by the prop_name column
 * @method     ChildProperty[]|ObjectCollection findByPropAddress(string $prop_address) Return ChildProperty objects filtered by the prop_address column
 * @method     ChildProperty[]|ObjectCollection findByPropLocation(int $prop_location) Return ChildProperty objects filtered by the prop_location column
 * @method     ChildProperty[]|ObjectCollection findByPropDescription(string $prop_description) Return ChildProperty objects filtered by the prop_description column
 * @method     ChildProperty[]|ObjectCollection findByPropArea(double $prop_area) Return ChildProperty objects filtered by the prop_area column
 * @method     ChildProperty[]|ObjectCollection findByPropPrice(double $prop_price) Return ChildProperty objects filtered by the prop_price column
 * @method     ChildProperty[]|ObjectCollection findByPropPubdate(string $prop_pubDate) Return ChildProperty objects filtered by the prop_pubDate column
 * @method     ChildProperty[]|ObjectCollection findByPropIshidden(int $prop_isHidden) Return ChildProperty objects filtered by the prop_isHidden column
 * @method     ChildProperty[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PropertyQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PropertyQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RealState', $modelName = '\\Property', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPropertyQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPropertyQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPropertyQuery) {
            return $criteria;
        }
        $query = new ChildPropertyQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildProperty|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PropertyTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PropertyTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildProperty A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prop_id, prop_name, prop_address, prop_location, prop_description, prop_area, prop_price, prop_pubDate, prop_isHidden FROM Property WHERE prop_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildProperty $obj */
            $obj = new ChildProperty();
            $obj->hydrate($row);
            PropertyTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildProperty|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the prop_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPropId('fooValue');   // WHERE prop_id = 'fooValue'
     * $query->filterByPropId('%fooValue%', Criteria::LIKE); // WHERE prop_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropId($propId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_ID, $propId, $comparison);
    }

    /**
     * Filter the query on the prop_name column
     *
     * Example usage:
     * <code>
     * $query->filterByPropName('fooValue');   // WHERE prop_name = 'fooValue'
     * $query->filterByPropName('%fooValue%', Criteria::LIKE); // WHERE prop_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propName The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropName($propName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propName)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_NAME, $propName, $comparison);
    }

    /**
     * Filter the query on the prop_address column
     *
     * Example usage:
     * <code>
     * $query->filterByPropAddress('fooValue');   // WHERE prop_address = 'fooValue'
     * $query->filterByPropAddress('%fooValue%', Criteria::LIKE); // WHERE prop_address LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propAddress The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropAddress($propAddress = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propAddress)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_ADDRESS, $propAddress, $comparison);
    }

    /**
     * Filter the query on the prop_location column
     *
     * Example usage:
     * <code>
     * $query->filterByPropLocation(1234); // WHERE prop_location = 1234
     * $query->filterByPropLocation(array(12, 34)); // WHERE prop_location IN (12, 34)
     * $query->filterByPropLocation(array('min' => 12)); // WHERE prop_location > 12
     * </code>
     *
     * @see       filterByLocation()
     *
     * @param     mixed $propLocation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropLocation($propLocation = null, $comparison = null)
    {
        if (is_array($propLocation)) {
            $useMinMax = false;
            if (isset($propLocation['min'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_LOCATION, $propLocation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propLocation['max'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_LOCATION, $propLocation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_LOCATION, $propLocation, $comparison);
    }

    /**
     * Filter the query on the prop_description column
     *
     * Example usage:
     * <code>
     * $query->filterByPropDescription('fooValue');   // WHERE prop_description = 'fooValue'
     * $query->filterByPropDescription('%fooValue%', Criteria::LIKE); // WHERE prop_description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propDescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropDescription($propDescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propDescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_DESCRIPTION, $propDescription, $comparison);
    }

    /**
     * Filter the query on the prop_area column
     *
     * Example usage:
     * <code>
     * $query->filterByPropArea(1234); // WHERE prop_area = 1234
     * $query->filterByPropArea(array(12, 34)); // WHERE prop_area IN (12, 34)
     * $query->filterByPropArea(array('min' => 12)); // WHERE prop_area > 12
     * </code>
     *
     * @param     mixed $propArea The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropArea($propArea = null, $comparison = null)
    {
        if (is_array($propArea)) {
            $useMinMax = false;
            if (isset($propArea['min'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_AREA, $propArea['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propArea['max'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_AREA, $propArea['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_AREA, $propArea, $comparison);
    }

    /**
     * Filter the query on the prop_price column
     *
     * Example usage:
     * <code>
     * $query->filterByPropPrice(1234); // WHERE prop_price = 1234
     * $query->filterByPropPrice(array(12, 34)); // WHERE prop_price IN (12, 34)
     * $query->filterByPropPrice(array('min' => 12)); // WHERE prop_price > 12
     * </code>
     *
     * @param     mixed $propPrice The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropPrice($propPrice = null, $comparison = null)
    {
        if (is_array($propPrice)) {
            $useMinMax = false;
            if (isset($propPrice['min'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_PRICE, $propPrice['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propPrice['max'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_PRICE, $propPrice['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_PRICE, $propPrice, $comparison);
    }

    /**
     * Filter the query on the prop_pubDate column
     *
     * Example usage:
     * <code>
     * $query->filterByPropPubdate('2011-03-14'); // WHERE prop_pubDate = '2011-03-14'
     * $query->filterByPropPubdate('now'); // WHERE prop_pubDate = '2011-03-14'
     * $query->filterByPropPubdate(array('max' => 'yesterday')); // WHERE prop_pubDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $propPubdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropPubdate($propPubdate = null, $comparison = null)
    {
        if (is_array($propPubdate)) {
            $useMinMax = false;
            if (isset($propPubdate['min'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_PUBDATE, $propPubdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propPubdate['max'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_PUBDATE, $propPubdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_PUBDATE, $propPubdate, $comparison);
    }

    /**
     * Filter the query on the prop_isHidden column
     *
     * Example usage:
     * <code>
     * $query->filterByPropIshidden(1234); // WHERE prop_isHidden = 1234
     * $query->filterByPropIshidden(array(12, 34)); // WHERE prop_isHidden IN (12, 34)
     * $query->filterByPropIshidden(array('min' => 12)); // WHERE prop_isHidden > 12
     * </code>
     *
     * @param     mixed $propIshidden The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropIshidden($propIshidden = null, $comparison = null)
    {
        if (is_array($propIshidden)) {
            $useMinMax = false;
            if (isset($propIshidden['min'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_ISHIDDEN, $propIshidden['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propIshidden['max'])) {
                $this->addUsingAlias(PropertyTableMap::COL_PROP_ISHIDDEN, $propIshidden['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyTableMap::COL_PROP_ISHIDDEN, $propIshidden, $comparison);
    }

    /**
     * Filter the query by a related \Location object
     *
     * @param \Location|ObjectCollection $location The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByLocation($location, $comparison = null)
    {
        if ($location instanceof \Location) {
            return $this
                ->addUsingAlias(PropertyTableMap::COL_PROP_LOCATION, $location->getLoId(), $comparison);
        } elseif ($location instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PropertyTableMap::COL_PROP_LOCATION, $location->toKeyValue('PrimaryKey', 'LoId'), $comparison);
        } else {
            throw new PropelException('filterByLocation() only accepts arguments of type \Location or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Location relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function joinLocation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Location');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Location');
        }

        return $this;
    }

    /**
     * Use the Location relation Location object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \LocationQuery A secondary query class using the current class as primary query
     */
    public function useLocationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLocation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Location', '\LocationQuery');
    }

    /**
     * Use the Location relation Location object
     *
     * @param callable(\LocationQuery):\LocationQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withLocationQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::INNER_JOIN
    ) {
        $relatedQuery = $this->useLocationQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Location table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \LocationQuery The inner query object of the EXISTS statement
     */
    public function useLocationExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Location', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Location table for a NOT EXISTS query.
     *
     * @see useLocationExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \LocationQuery The inner query object of the NOT EXISTS statement
     */
    public function useLocationNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Location', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PropertyFeature object
     *
     * @param \PropertyFeature|ObjectCollection $propertyFeature the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropertyFeature($propertyFeature, $comparison = null)
    {
        if ($propertyFeature instanceof \PropertyFeature) {
            return $this
                ->addUsingAlias(PropertyTableMap::COL_PROP_ID, $propertyFeature->getPropfeaturePropId(), $comparison);
        } elseif ($propertyFeature instanceof ObjectCollection) {
            return $this
                ->usePropertyFeatureQuery()
                ->filterByPrimaryKeys($propertyFeature->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPropertyFeature() only accepts arguments of type \PropertyFeature or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PropertyFeature relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function joinPropertyFeature($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PropertyFeature');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PropertyFeature');
        }

        return $this;
    }

    /**
     * Use the PropertyFeature relation PropertyFeature object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropertyFeatureQuery A secondary query class using the current class as primary query
     */
    public function usePropertyFeatureQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPropertyFeature($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PropertyFeature', '\PropertyFeatureQuery');
    }

    /**
     * Use the PropertyFeature relation PropertyFeature object
     *
     * @param callable(\PropertyFeatureQuery):\PropertyFeatureQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPropertyFeatureQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePropertyFeatureQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to PropertyFeature table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropertyFeatureQuery The inner query object of the EXISTS statement
     */
    public function usePropertyFeatureExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('PropertyFeature', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to PropertyFeature table for a NOT EXISTS query.
     *
     * @see usePropertyFeatureExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropertyFeatureQuery The inner query object of the NOT EXISTS statement
     */
    public function usePropertyFeatureNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('PropertyFeature', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \PropertyImage object
     *
     * @param \PropertyImage|ObjectCollection $propertyImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPropertyQuery The current query, for fluid interface
     */
    public function filterByPropertyImage($propertyImage, $comparison = null)
    {
        if ($propertyImage instanceof \PropertyImage) {
            return $this
                ->addUsingAlias(PropertyTableMap::COL_PROP_ID, $propertyImage->getPropimgPropId(), $comparison);
        } elseif ($propertyImage instanceof ObjectCollection) {
            return $this
                ->usePropertyImageQuery()
                ->filterByPrimaryKeys($propertyImage->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPropertyImage() only accepts arguments of type \PropertyImage or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PropertyImage relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function joinPropertyImage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PropertyImage');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PropertyImage');
        }

        return $this;
    }

    /**
     * Use the PropertyImage relation PropertyImage object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropertyImageQuery A secondary query class using the current class as primary query
     */
    public function usePropertyImageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPropertyImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PropertyImage', '\PropertyImageQuery');
    }

    /**
     * Use the PropertyImage relation PropertyImage object
     *
     * @param callable(\PropertyImageQuery):\PropertyImageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPropertyImageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePropertyImageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to PropertyImage table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropertyImageQuery The inner query object of the EXISTS statement
     */
    public function usePropertyImageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('PropertyImage', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to PropertyImage table for a NOT EXISTS query.
     *
     * @see usePropertyImageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropertyImageQuery The inner query object of the NOT EXISTS statement
     */
    public function usePropertyImageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('PropertyImage', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildProperty $property Object to remove from the list of results
     *
     * @return $this|ChildPropertyQuery The current query, for fluid interface
     */
    public function prune($property = null)
    {
        if ($property) {
            $this->addUsingAlias(PropertyTableMap::COL_PROP_ID, $property->getPropId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Property table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PropertyTableMap::clearInstancePool();
            PropertyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PropertyTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PropertyTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PropertyTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PropertyQuery
