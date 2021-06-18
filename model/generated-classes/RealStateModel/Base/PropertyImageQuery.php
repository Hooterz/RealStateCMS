<?php

namespace RealStateModel\Base;

use \Exception;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use RealStateModel\PropertyImage as ChildPropertyImage;
use RealStateModel\PropertyImageQuery as ChildPropertyImageQuery;
use RealStateModel\Map\PropertyImageTableMap;

/**
 * Base class that represents a query for the 'Property_Image' table.
 *
 *
 *
 * @method     ChildPropertyImageQuery orderByPropimgPropId($order = Criteria::ASC) Order by the propImg_prop_id column
 * @method     ChildPropertyImageQuery orderByPropimgImgId($order = Criteria::ASC) Order by the propImg_img_id column
 *
 * @method     ChildPropertyImageQuery groupByPropimgPropId() Group by the propImg_prop_id column
 * @method     ChildPropertyImageQuery groupByPropimgImgId() Group by the propImg_img_id column
 *
 * @method     ChildPropertyImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPropertyImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPropertyImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPropertyImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPropertyImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPropertyImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPropertyImageQuery leftJoinProperty($relationAlias = null) Adds a LEFT JOIN clause to the query using the Property relation
 * @method     ChildPropertyImageQuery rightJoinProperty($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Property relation
 * @method     ChildPropertyImageQuery innerJoinProperty($relationAlias = null) Adds a INNER JOIN clause to the query using the Property relation
 *
 * @method     ChildPropertyImageQuery joinWithProperty($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Property relation
 *
 * @method     ChildPropertyImageQuery leftJoinWithProperty() Adds a LEFT JOIN clause and with to the query using the Property relation
 * @method     ChildPropertyImageQuery rightJoinWithProperty() Adds a RIGHT JOIN clause and with to the query using the Property relation
 * @method     ChildPropertyImageQuery innerJoinWithProperty() Adds a INNER JOIN clause and with to the query using the Property relation
 *
 * @method     ChildPropertyImageQuery leftJoinImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the Image relation
 * @method     ChildPropertyImageQuery rightJoinImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Image relation
 * @method     ChildPropertyImageQuery innerJoinImage($relationAlias = null) Adds a INNER JOIN clause to the query using the Image relation
 *
 * @method     ChildPropertyImageQuery joinWithImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Image relation
 *
 * @method     ChildPropertyImageQuery leftJoinWithImage() Adds a LEFT JOIN clause and with to the query using the Image relation
 * @method     ChildPropertyImageQuery rightJoinWithImage() Adds a RIGHT JOIN clause and with to the query using the Image relation
 * @method     ChildPropertyImageQuery innerJoinWithImage() Adds a INNER JOIN clause and with to the query using the Image relation
 *
 * @method     \RealStateModel\PropertyQuery|\RealStateModel\ImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPropertyImage|null findOne(ConnectionInterface $con = null) Return the first ChildPropertyImage matching the query
 * @method     ChildPropertyImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPropertyImage matching the query, or a new ChildPropertyImage object populated from the query conditions when no match is found
 *
 * @method     ChildPropertyImage|null findOneByPropimgPropId(string $propImg_prop_id) Return the first ChildPropertyImage filtered by the propImg_prop_id column
 * @method     ChildPropertyImage|null findOneByPropimgImgId(int $propImg_img_id) Return the first ChildPropertyImage filtered by the propImg_img_id column *

 * @method     ChildPropertyImage requirePk($key, ConnectionInterface $con = null) Return the ChildPropertyImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertyImage requireOne(ConnectionInterface $con = null) Return the first ChildPropertyImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertyImage requireOneByPropimgPropId(string $propImg_prop_id) Return the first ChildPropertyImage filtered by the propImg_prop_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPropertyImage requireOneByPropimgImgId(int $propImg_img_id) Return the first ChildPropertyImage filtered by the propImg_img_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPropertyImage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPropertyImage objects based on current ModelCriteria
 * @method     ChildPropertyImage[]|ObjectCollection findByPropimgPropId(string $propImg_prop_id) Return ChildPropertyImage objects filtered by the propImg_prop_id column
 * @method     ChildPropertyImage[]|ObjectCollection findByPropimgImgId(int $propImg_img_id) Return ChildPropertyImage objects filtered by the propImg_img_id column
 * @method     ChildPropertyImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PropertyImageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \RealStateModel\Base\PropertyImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RealState', $modelName = '\\RealStateModel\\PropertyImage', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPropertyImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPropertyImageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPropertyImageQuery) {
            return $criteria;
        }
        $query = new ChildPropertyImageQuery();
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
     * @return ChildPropertyImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        throw new LogicException('The PropertyImage object has no primary key');
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
        throw new LogicException('The PropertyImage object has no primary key');
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        throw new LogicException('The PropertyImage object has no primary key');
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        throw new LogicException('The PropertyImage object has no primary key');
    }

    /**
     * Filter the query on the propImg_prop_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPropimgPropId('fooValue');   // WHERE propImg_prop_id = 'fooValue'
     * $query->filterByPropimgPropId('%fooValue%', Criteria::LIKE); // WHERE propImg_prop_id LIKE '%fooValue%'
     * </code>
     *
     * @param     string $propimgPropId The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByPropimgPropId($propimgPropId = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($propimgPropId)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_PROP_ID, $propimgPropId, $comparison);
    }

    /**
     * Filter the query on the propImg_img_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPropimgImgId(1234); // WHERE propImg_img_id = 1234
     * $query->filterByPropimgImgId(array(12, 34)); // WHERE propImg_img_id IN (12, 34)
     * $query->filterByPropimgImgId(array('min' => 12)); // WHERE propImg_img_id > 12
     * </code>
     *
     * @see       filterByImage()
     *
     * @param     mixed $propimgImgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByPropimgImgId($propimgImgId = null, $comparison = null)
    {
        if (is_array($propimgImgId)) {
            $useMinMax = false;
            if (isset($propimgImgId['min'])) {
                $this->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_IMG_ID, $propimgImgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($propimgImgId['max'])) {
                $this->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_IMG_ID, $propimgImgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_IMG_ID, $propimgImgId, $comparison);
    }

    /**
     * Filter the query by a related \RealStateModel\Property object
     *
     * @param \RealStateModel\Property|ObjectCollection $property The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByProperty($property, $comparison = null)
    {
        if ($property instanceof \RealStateModel\Property) {
            return $this
                ->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_PROP_ID, $property->getPropId(), $comparison);
        } elseif ($property instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_PROP_ID, $property->toKeyValue('PrimaryKey', 'PropId'), $comparison);
        } else {
            throw new PropelException('filterByProperty() only accepts arguments of type \RealStateModel\Property or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Property relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
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
     * @return \RealStateModel\PropertyQuery A secondary query class using the current class as primary query
     */
    public function usePropertyQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinProperty($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Property', '\RealStateModel\PropertyQuery');
    }

    /**
     * Use the Property relation Property object
     *
     * @param callable(\RealStateModel\PropertyQuery):\RealStateModel\PropertyQuery $callable A function working on the related query
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
     * @return \RealStateModel\PropertyQuery The inner query object of the EXISTS statement
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
     * @return \RealStateModel\PropertyQuery The inner query object of the NOT EXISTS statement
     */
    public function usePropertyNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Property', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Filter the query by a related \RealStateModel\Image object
     *
     * @param \RealStateModel\Image|ObjectCollection $image The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPropertyImageQuery The current query, for fluid interface
     */
    public function filterByImage($image, $comparison = null)
    {
        if ($image instanceof \RealStateModel\Image) {
            return $this
                ->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_IMG_ID, $image->getImgId(), $comparison);
        } elseif ($image instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PropertyImageTableMap::COL_PROPIMG_IMG_ID, $image->toKeyValue('PrimaryKey', 'ImgId'), $comparison);
        } else {
            throw new PropelException('filterByImage() only accepts arguments of type \RealStateModel\Image or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Image relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function joinImage($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Image');

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
            $this->addJoinObject($join, 'Image');
        }

        return $this;
    }

    /**
     * Use the Image relation Image object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \RealStateModel\ImageQuery A secondary query class using the current class as primary query
     */
    public function useImageQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinImage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Image', '\RealStateModel\ImageQuery');
    }

    /**
     * Use the Image relation Image object
     *
     * @param callable(\RealStateModel\ImageQuery):\RealStateModel\ImageQuery $callable A function working on the related query
     *
     * @param string|null $relationAlias optional alias for the relation
     *
     * @param string|null $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this
     */
    public function withImageQuery(
        callable $callable,
        string $relationAlias = null,
        ?string $joinType = Criteria::LEFT_JOIN
    ) {
        $relatedQuery = $this->useImageQuery(
            $relationAlias,
            $joinType
        );
        $callable($relatedQuery);
        $relatedQuery->endUse();

        return $this;
    }
    /**
     * Use the relation to Image table for an EXISTS query.
     *
     * @see \Propel\Runtime\ActiveQuery\ModelCriteria::useExistsQuery()
     *
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string $typeOfExists Either ExistsCriterion::TYPE_EXISTS or ExistsCriterion::TYPE_NOT_EXISTS
     *
     * @return \RealStateModel\ImageQuery The inner query object of the EXISTS statement
     */
    public function useImageExistsQuery($modelAlias = null, $queryClass = null, $typeOfExists = 'EXISTS')
    {
        return $this->useExistsQuery('Image', $modelAlias, $queryClass, $typeOfExists);
    }

    /**
     * Use the relation to Image table for a NOT EXISTS query.
     *
     * @see useImageExistsQuery()
     *
     * @param string|null $modelAlias sets an alias for the nested query
     * @param string|null $queryClass Allows to use a custom query class for the exists query, like ExtendedBookQuery::class
     *
     * @return \RealStateModel\ImageQuery The inner query object of the NOT EXISTS statement
     */
    public function useImageNotExistsQuery($modelAlias = null, $queryClass = null)
    {
        return $this->useExistsQuery('Image', $modelAlias, $queryClass, 'NOT EXISTS');
    }
    /**
     * Exclude object from result
     *
     * @param   ChildPropertyImage $propertyImage Object to remove from the list of results
     *
     * @return $this|ChildPropertyImageQuery The current query, for fluid interface
     */
    public function prune($propertyImage = null)
    {
        if ($propertyImage) {
            throw new LogicException('PropertyImage object has no primary key');

        }

        return $this;
    }

    /**
     * Deletes all rows from the Property_Image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PropertyImageTableMap::clearInstancePool();
            PropertyImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PropertyImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PropertyImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PropertyImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PropertyImageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PropertyImageQuery
