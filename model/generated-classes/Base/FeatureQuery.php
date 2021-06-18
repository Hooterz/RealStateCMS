<?php

namespace Base;

use \Feature as ChildFeature;
use \FeatureQuery as ChildFeatureQuery;
use \Exception;
use \PDO;
use Map\FeatureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Feature' table.
 *
 *
 *
 * @method     ChildFeatureQuery orderByFeatureId($order = Criteria::ASC) Order by the feature_id column
 * @method     ChildFeatureQuery orderByFeatureContent($order = Criteria::ASC) Order by the feature_content column
 *
 * @method     ChildFeatureQuery groupByFeatureId() Group by the feature_id column
 * @method     ChildFeatureQuery groupByFeatureContent() Group by the feature_content column
 *
 * @method     ChildFeatureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFeatureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFeatureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFeatureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFeatureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFeatureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFeatureQuery leftJoinPropertyFeature($relationAlias = null) Adds a LEFT JOIN clause to the query using the PropertyFeature relation
 * @method     ChildFeatureQuery rightJoinPropertyFeature($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PropertyFeature relation
 * @method     ChildFeatureQuery innerJoinPropertyFeature($relationAlias = null) Adds a INNER JOIN clause to the query using the PropertyFeature relation
 *
 * @method     ChildFeatureQuery joinWithPropertyFeature($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PropertyFeature relation
 *
 * @method     ChildFeatureQuery leftJoinWithPropertyFeature() Adds a LEFT JOIN clause and with to the query using the PropertyFeature relation
 * @method     ChildFeatureQuery rightJoinWithPropertyFeature() Adds a RIGHT JOIN clause and with to the query using the PropertyFeature relation
 * @method     ChildFeatureQuery innerJoinWithPropertyFeature() Adds a INNER JOIN clause and with to the query using the PropertyFeature relation
 *
 * @method     \PropertyFeatureQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFeature|null findOne(ConnectionInterface $con = null) Return the first ChildFeature matching the query
 * @method     ChildFeature findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFeature matching the query, or a new ChildFeature object populated from the query conditions when no match is found
 *
 * @method     ChildFeature|null findOneByFeatureId(int $feature_id) Return the first ChildFeature filtered by the feature_id column
 * @method     ChildFeature|null findOneByFeatureContent(string $feature_content) Return the first ChildFeature filtered by the feature_content column *

 * @method     ChildFeature requirePk($key, ConnectionInterface $con = null) Return the ChildFeature by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFeature requireOne(ConnectionInterface $con = null) Return the first ChildFeature matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFeature requireOneByFeatureId(int $feature_id) Return the first ChildFeature filtered by the feature_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFeature requireOneByFeatureContent(string $feature_content) Return the first ChildFeature filtered by the feature_content column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFeature[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFeature objects based on current ModelCriteria
 * @method     ChildFeature[]|ObjectCollection findByFeatureId(int $feature_id) Return ChildFeature objects filtered by the feature_id column
 * @method     ChildFeature[]|ObjectCollection findByFeatureContent(string $feature_content) Return ChildFeature objects filtered by the feature_content column
 * @method     ChildFeature[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FeatureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\FeatureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RealState', $modelName = '\\Feature', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFeatureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFeatureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFeatureQuery) {
            return $criteria;
        }
        $query = new ChildFeatureQuery();
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
     * @return ChildFeature|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FeatureTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FeatureTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildFeature A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT feature_id, feature_content FROM Feature WHERE feature_id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFeature $obj */
            $obj = new ChildFeature();
            $obj->hydrate($row);
            FeatureTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildFeature|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildFeatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFeatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the feature_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFeatureId(1234); // WHERE feature_id = 1234
     * $query->filterByFeatureId(array(12, 34)); // WHERE feature_id IN (12, 34)
     * $query->filterByFeatureId(array('min' => 12)); // WHERE feature_id > 12
     * </code>
     *
     * @param     mixed $featureId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFeatureQuery The current query, for fluid interface
     */
    public function filterByFeatureId($featureId = null, $comparison = null)
    {
        if (is_array($featureId)) {
            $useMinMax = false;
            if (isset($featureId['min'])) {
                $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $featureId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($featureId['max'])) {
                $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $featureId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $featureId, $comparison);
    }

    /**
     * Filter the query on the feature_content column
     *
     * Example usage:
     * <code>
     * $query->filterByFeatureContent('fooValue');   // WHERE feature_content = 'fooValue'
     * $query->filterByFeatureContent('%fooValue%', Criteria::LIKE); // WHERE feature_content LIKE '%fooValue%'
     * </code>
     *
     * @param     string $featureContent The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFeatureQuery The current query, for fluid interface
     */
    public function filterByFeatureContent($featureContent = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($featureContent)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FeatureTableMap::COL_FEATURE_CONTENT, $featureContent, $comparison);
    }

    /**
     * Filter the query by a related \PropertyFeature object
     *
     * @param \PropertyFeature|ObjectCollection $propertyFeature the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFeatureQuery The current query, for fluid interface
     */
    public function filterByPropertyFeature($propertyFeature, $comparison = null)
    {
        if ($propertyFeature instanceof \PropertyFeature) {
            return $this
                ->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $propertyFeature->getPropfeaturegFeatureId(), $comparison);
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
     * @return $this|ChildFeatureQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildFeature $feature Object to remove from the list of results
     *
     * @return $this|ChildFeatureQuery The current query, for fluid interface
     */
    public function prune($feature = null)
    {
        if ($feature) {
            $this->addUsingAlias(FeatureTableMap::COL_FEATURE_ID, $feature->getFeatureId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Feature table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FeatureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FeatureTableMap::clearInstancePool();
            FeatureTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(FeatureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FeatureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FeatureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FeatureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FeatureQuery
