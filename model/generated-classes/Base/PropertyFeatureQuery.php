<?php

namespace Base;

use \PropertyFeature as ChildPropertyFeature;
use \PropertyFeatureQuery as ChildPropertyFeatureQuery;
use \Exception;
use Map\PropertyFeatureTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Property_Feature' table.
 *
 *
 *
 * @method     ChildPropertyFeatureQuery orderByPropfeaturePropId($order = Criteria::ASC) Order by the propFeature_prop_id column
 * @method     ChildPropertyFeatureQuery orderByPropfeaturegFeatureId($order = Criteria::ASC) Order by the propFeatureg_feature_id column
 *
 * @method     ChildPropertyFeatureQuery groupByPropfeaturePropId() Group by the propFeature_prop_id column
 * @method     ChildPropertyFeatureQuery groupByPropfeaturegFeatureId() Group by the propFeatureg_feature_id column
 *
 * @method     ChildPropertyFeatureQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPropertyFeatureQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPropertyFeatureQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPropertyFeatureQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPropertyFeatureQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPropertyFeatureQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPropertyFeatureQuery leftJoinProperty($relationAlias = null) Adds a LEFT JOIN clause to the query using the Property relation
 * @method     ChildPropertyFeatureQuery rightJoinProperty($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Property relation
 * @method     ChildPropertyFeatureQuery innerJoinProperty($relationAlias = null) Adds a INNER JOIN clause to the query using the Property relation
 *
 * @method     ChildPropertyFeatureQuery joinWithProperty($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Property relation
 *
 * @method     ChildPropertyFeatureQuery leftJoinWithProperty() Adds a LEFT JOIN clause and with to the query using the Property relation
 * @method     ChildPropertyFeatureQuery rightJoinWithProperty() Adds a RIGHT JOIN clause and with to the query using the Property relation
 * @method     ChildPropertyFeatureQuery innerJoinWithProperty() Adds a INNER JOIN clause and with to the query using the Property relation
 *
 * @method     ChildPropertyFeatureQuery leftJoinFeature($relationAlias = null) Adds a LEFT JOIN clause to the query using the Feature relation
 * @method     ChildPropertyFeatureQuery rightJoinFeature($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Feature relation
 * @method     ChildPropertyFeatureQuery innerJoinFeature($relationAlias = null) Adds a INNER JOIN clause to the query using the Feature relation
 *
 * @method     ChildPropertyFeatureQuery joinWithFeature($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Feature relation
 *
 * @method     ChildPropertyFeatureQuery leftJoinWithFeature() Adds a LEFT JOIN clause and with to the query using the Feature relation
 * @method     ChildPropertyFeatureQuery rightJoinWithFeature() Adds a RIGHT JOIN clause and with to the query using the Feature relation
 * @method     ChildPropertyFeatureQuery innerJoinWithFeature() Adds a INNER JOIN clause and with to the query using the Feature relation
 *
 * @method     \PropertyQuery|\FeatureQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPropertyFeature|null findOne(ConnectionInterface $con = null) Return the first ChildPropertyFeature matching the query
 * @method     ChildPropertyFeature findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPropertyFeature matching the query, or a new ChildPropertyFeature object populated from the query conditions when no match is found
 *
 * @method     ChildPropertyFeature|null findOneByPropfeaturePropId(string $propFeature_prop_id) Return the first ChildPropertyFeature filtered by the propFeature_prop_id column
 * @method     ChildPropertyFeature|null findOneByPropfeaturegFeatureId(int $propFeatureg_feature_id) Return the first ChildPropertyFeature filtered by the propFeatureg_feature_id column *

 * @method     ChildPropertyFeature requirePk($key, ConnectionInterface $con = null) Return the ChildPropertyFeature by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertyFeature requireOne(ConnectionInterface $con = null) Return the first ChildPropertyFeature matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertyFeature requireOneByPropfeaturePropId(string $propFeature_prop_id) Return the first ChildPropertyFeature filtered by the propFeature_prop_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertyFeature requireOneByPropfeaturegFeatureId(int $propFeatureg_feature_id) Return the first ChildPropertyFeature filtered by the propFeatureg_feature_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertyFeature[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPropertyFeature objects based on current ModelCriteria
 * @method     ChildPropertyFeature[]|ObjectCollection findByPropfeaturePropId(string $propFeature_prop_id) Return ChildPropertyFeature objects filtered by the propFeature_prop_id column
 * @method     ChildPropertyFeature[]|ObjectCollection findByPropfeaturegFeatureId(int $propFeatureg_feature_id) Return ChildPropertyFeature objects filtered by the propFeatureg_feature_id column
 * @method     ChildPropertyFeature[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PropertyFeatureQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\PropertyFeatureQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RealState', $modelName = '\\PropertyFeature', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPropertyFeatureQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPropertyFeatureQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPropertyFeatureQuery) {
            return $criteria;
        }
        $query = new ChildPropertyFeatureQuery();
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
     * @return ChildPropertyFeature|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The PropertyFeature object has no primary key');
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        throw new LogicException('The PropertyFeature object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The PropertyFeature object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The PropertyFeature object has no primary key');
    }

    /**
     * Filter the query on the propFeature_prop_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPropfeaturePropId('fooValue');   // WHERE propFeature_prop_id = 'fooValue'
     * $query->filterByPropfeaturePropId('%fooValue%', Criteria::LIKE); // WHERE propFeature_prop_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propfeaturePropId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByPropfeaturePropId($propfeaturePropId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propfeaturePropId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATURE_PROP_ID, $propfeaturePropId, $comparison);
    }

    /**
     * Filter the query on the propFeatureg_feature_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPropfeaturegFeatureId(1234); // WHERE propFeatureg_feature_id = 1234
     * $query->filterByPropfeaturegFeatureId(array(12, 34)); // WHERE propFeatureg_feature_id IN (12, 34)
     * $query->filterByPropfeaturegFeatureId(array('min' => 12)); // WHERE propFeatureg_feature_id > 12
     * </code>
     *
     * @see       filterByFeature()
     *
     * @param     mixed $propfeaturegFeatureId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByPropfeaturegFeatureId($propfeaturegFeatureId = null, $comparison = null)
    {
        if (is_array($propfeaturegFeatureId)) {
            $useMinMax = false;
            if (isset($propfeaturegFeatureId['min'])) {
                $this->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATUREG_FEATURE_ID, $propfeaturegFeatureId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propfeaturegFeatureId['max'])) {
                $this->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATUREG_FEATURE_ID, $propfeaturegFeatureId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATUREG_FEATURE_ID, $propfeaturegFeatureId, $comparison);
    }

    /**
     * Filter the query by a related \Property object
     *
     * @param \Property|ObjectCollection $property The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByProperty($property, $comparison = null)
    {
        if ($property instanceof \Property) {
            return $this
                ->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATURE_PROP_ID, $property->getPropId(), $comparison);
        } elseif ($property instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATURE_PROP_ID, $property->toKeyValue('PrimaryKey', 'PropId'), $comparison);
        } else {
            throw new PropelException('filterByProperty() only accepts arguments of type \Property or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Property relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function joinProperty($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Property');

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
            $this->addJoinObject($join, 'Property');
        }

        return $this;
    }

    /**
     * Use the Property relation Property object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \PropertyQuery A secondary query class using the current class as primary query
     */
    public function usePropertyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProperty($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Property', '\PropertyQuery');
    }

    /**
     * Use the Property relation Property object
     *
     * @param callable(\PropertyQuery):\PropertyQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withPropertyQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->usePropertyQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Property table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \PropertyQuery The inner query object of the EXISTS statement
     */
    public function usePropertyExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Property', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Property table for a NOT EXISTS query.
     *
     * @see usePropertyExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \PropertyQuery The inner query object of the NOT EXISTS statement
     */
    public function usePropertyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Property', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \Feature object
     *
     * @param \Feature|ObjectCollection $feature The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function filterByFeature($feature, $comparison = null)
    {
        if ($feature instanceof \Feature) {
            return $this
                ->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATUREG_FEATURE_ID, $feature->getFeatureId(), $comparison);
        } elseif ($feature instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PropertyFeatureTableMap::COL_PROPFEATUREG_FEATURE_ID, $feature->toKeyValue('PrimaryKey', 'FeatureId'), $comparison);
        } else {
            throw new PropelException('filterByFeature() only accepts arguments of type \Feature or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Feature relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function joinFeature($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Feature');

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
            $this->addJoinObject($join, 'Feature');
        }

        return $this;
    }

    /**
     * Use the Feature relation Feature object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \FeatureQuery A secondary query class using the current class as primary query
     */
    public function useFeatureQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFeature($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Feature', '\FeatureQuery');
    }

    /**
     * Use the Feature relation Feature object
     *
     * @param callable(\FeatureQuery):\FeatureQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withFeatureQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useFeatureQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Feature table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \FeatureQuery The inner query object of the EXISTS statement
     */
    public function useFeatureExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Feature', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Feature table for a NOT EXISTS query.
     *
     * @see useFeatureExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \FeatureQuery The inner query object of the NOT EXISTS statement
     */
    public function useFeatureNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Feature', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildPropertyFeature $propertyFeature Object to remove from the list of results
     *
     * @return $this|ChildPropertyFeatureQuery The current query, for fluid interface
     */
    public function prune($propertyFeature = null)
    {
        if ($propertyFeature) {
            throw new LogicException('PropertyFeature object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the Property_Feature table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyFeatureTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PropertyFeatureTableMap::clearInstancePool();
            PropertyFeatureTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyFeatureTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PropertyFeatureTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PropertyFeatureTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PropertyFeatureTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PropertyFeatureQuery
