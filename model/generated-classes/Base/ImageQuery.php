<?php

namespace Base;

use \Image as ChildImage;
use \ImageQuery as ChildImageQuery;
use \Exception;
use \PDO;
use Map\ImageTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'Image' table.
 *
 *
 *
 * @method     ChildImageQuery orderByImgId($order = Criteria::ASC) Order by the img_id column
 * @method     ChildImageQuery orderByImgPath($order = Criteria::ASC) Order by the img_path column
 *
 * @method     ChildImageQuery groupByImgId() Group by the img_id column
 * @method     ChildImageQuery groupByImgPath() Group by the img_path column
 *
 * @method     ChildImageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildImageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildImageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildImageQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildImageQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildImageQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildImageQuery leftJoinPropertyImage($relationAlias = null) Adds a LEFT JOIN clause to the query using the PropertyImage relation
 * @method     ChildImageQuery rightJoinPropertyImage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PropertyImage relation
 * @method     ChildImageQuery innerJoinPropertyImage($relationAlias = null) Adds a INNER JOIN clause to the query using the PropertyImage relation
 *
 * @method     ChildImageQuery joinWithPropertyImage($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the PropertyImage relation
 *
 * @method     ChildImageQuery leftJoinWithPropertyImage() Adds a LEFT JOIN clause and with to the query using the PropertyImage relation
 * @method     ChildImageQuery rightJoinWithPropertyImage() Adds a RIGHT JOIN clause and with to the query using the PropertyImage relation
 * @method     ChildImageQuery innerJoinWithPropertyImage() Adds a INNER JOIN clause and with to the query using the PropertyImage relation
 *
 * @method     \PropertyImageQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildImage|null findOne(ConnectionInterface $con = null) Return the first ChildImage matching the query
 * @method     ChildImage findOneOrCreate(ConnectionInterface $con = null) Return the first ChildImage matching the query, or a new ChildImage object populated from the query conditions when no match is found
 *
 * @method     ChildImage|null findOneByImgId(int $img_id) Return the first ChildImage filtered by the img_id column
 * @method     ChildImage|null findOneByImgPath(string $img_path) Return the first ChildImage filtered by the img_path column *

 * @method     ChildImage requirePk($key, ConnectionInterface $con = null) Return the ChildImage by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOne(ConnectionInterface $con = null) Return the first ChildImage matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImage requireOneByImgId(int $img_id) Return the first ChildImage filtered by the img_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildImage requireOneByImgPath(string $img_path) Return the first ChildImage filtered by the img_path column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildImage[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildImage objects based on current ModelCriteria
 * @method     ChildImage[]|ObjectCollection findByImgId(int $img_id) Return ChildImage objects filtered by the img_id column
 * @method     ChildImage[]|ObjectCollection findByImgPath(string $img_path) Return ChildImage objects filtered by the img_path column
 * @method     ChildImage[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ImageQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ImageQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'RealState', $modelName = '\\Image', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildImageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildImageQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildImageQuery) {
            return $criteria;
        }
        $query = new ChildImageQuery();
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
     * @return ChildImage|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ImageTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ImageTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildImage A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT img_id, img_path FROM Image WHERE img_id = :p0';
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
            /** @var ChildImage $obj */
            $obj = new ChildImage();
            $obj->hydrate($row);
            ImageTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildImage|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the img_id column
     *
     * Example usage:
     * <code>
     * $query->filterByImgId(1234); // WHERE img_id = 1234
     * $query->filterByImgId(array(12, 34)); // WHERE img_id IN (12, 34)
     * $query->filterByImgId(array('min' => 12)); // WHERE img_id > 12
     * </code>
     *
     * @param     mixed $imgId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByImgId($imgId = null, $comparison = null)
    {
        if (is_array($imgId)) {
            $useMinMax = false;
            if (isset($imgId['min'])) {
                $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $imgId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($imgId['max'])) {
                $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $imgId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $imgId, $comparison);
    }

    /**
     * Filter the query on the img_path column
     *
     * Example usage:
     * <code>
     * $query->filterByImgPath('fooValue');   // WHERE img_path = 'fooValue'
     * $query->filterByImgPath('%fooValue%', Criteria::LIKE); // WHERE img_path LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imgPath The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function filterByImgPath($imgPath = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imgPath)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ImageTableMap::COL_IMG_PATH, $imgPath, $comparison);
    }

    /**
     * Filter the query by a related \PropertyImage object
     *
     * @param \PropertyImage|ObjectCollection $propertyImage the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildImageQuery The current query, for fluid interface
     */
    public function filterByPropertyImage($propertyImage, $comparison = null)
    {
        if ($propertyImage instanceof \PropertyImage) {
            return $this
                ->addUsingAlias(ImageTableMap::COL_IMG_ID, $propertyImage->getPropimgImgId(), $comparison);
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
     * @return $this|ChildImageQuery The current query, for fluid interface
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
     * @param   ChildImage $image Object to remove from the list of results
     *
     * @return $this|ChildImageQuery The current query, for fluid interface
     */
    public function prune($image = null)
    {
        if ($image) {
            $this->addUsingAlias(ImageTableMap::COL_IMG_ID, $image->getImgId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the Image table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ImageTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ImageTableMap::clearInstancePool();
            ImageTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ImageTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ImageTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ImageTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ImageTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ImageQuery
