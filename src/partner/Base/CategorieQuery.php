<?php

namespace partner\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use partner\Categorie as ChildCategorie;
use partner\CategorieQuery as ChildCategorieQuery;
use partner\Map\CategorieTableMap;

/**
 * Base class that represents a query for the 'categories' table.
 *
 *
 *
 * @method     ChildCategorieQuery orderByCategorieID($order = Criteria::ASC) Order by the categorieId column
 * @method     ChildCategorieQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 * @method     ChildCategorieQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildCategorieQuery orderByCategorieMedia($order = Criteria::ASC) Order by the categorie_media column
 * @method     ChildCategorieQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCategorieQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildCategorieQuery groupByCategorieID() Group by the categorieId column
 * @method     ChildCategorieQuery groupByLibelle() Group by the libelle column
 * @method     ChildCategorieQuery groupByDescription() Group by the description column
 * @method     ChildCategorieQuery groupByCategorieMedia() Group by the categorie_media column
 * @method     ChildCategorieQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCategorieQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildCategorieQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCategorieQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCategorieQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCategorieQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildCategorieQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildCategorieQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildCategorieQuery leftJoinService($relationAlias = null) Adds a LEFT JOIN clause to the query using the Service relation
 * @method     ChildCategorieQuery rightJoinService($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Service relation
 * @method     ChildCategorieQuery innerJoinService($relationAlias = null) Adds a INNER JOIN clause to the query using the Service relation
 *
 * @method     ChildCategorieQuery joinWithService($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Service relation
 *
 * @method     ChildCategorieQuery leftJoinWithService() Adds a LEFT JOIN clause and with to the query using the Service relation
 * @method     ChildCategorieQuery rightJoinWithService() Adds a RIGHT JOIN clause and with to the query using the Service relation
 * @method     ChildCategorieQuery innerJoinWithService() Adds a INNER JOIN clause and with to the query using the Service relation
 *
 * @method     \partner\ServiceQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCategorie findOne(ConnectionInterface $con = null) Return the first ChildCategorie matching the query
 * @method     ChildCategorie findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCategorie matching the query, or a new ChildCategorie object populated from the query conditions when no match is found
 *
 * @method     ChildCategorie findOneByCategorieID(int $categorieId) Return the first ChildCategorie filtered by the categorieId column
 * @method     ChildCategorie findOneByLibelle(string $libelle) Return the first ChildCategorie filtered by the libelle column
 * @method     ChildCategorie findOneByDescription(string $description) Return the first ChildCategorie filtered by the description column
 * @method     ChildCategorie findOneByCategorieMedia(string $categorie_media) Return the first ChildCategorie filtered by the categorie_media column
 * @method     ChildCategorie findOneByCreatedAt(string $created_at) Return the first ChildCategorie filtered by the created_at column
 * @method     ChildCategorie findOneByLastUpdated(string $last_updated) Return the first ChildCategorie filtered by the last_updated column *

 * @method     ChildCategorie requirePk($key, ConnectionInterface $con = null) Return the ChildCategorie by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOne(ConnectionInterface $con = null) Return the first ChildCategorie matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategorie requireOneByCategorieID(int $categorieId) Return the first ChildCategorie filtered by the categorieId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOneByLibelle(string $libelle) Return the first ChildCategorie filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOneByDescription(string $description) Return the first ChildCategorie filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOneByCategorieMedia(string $categorie_media) Return the first ChildCategorie filtered by the categorie_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOneByCreatedAt(string $created_at) Return the first ChildCategorie filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCategorie requireOneByLastUpdated(string $last_updated) Return the first ChildCategorie filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCategorie[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCategorie objects based on current ModelCriteria
 * @method     ChildCategorie[]|ObjectCollection findByCategorieID(int $categorieId) Return ChildCategorie objects filtered by the categorieId column
 * @method     ChildCategorie[]|ObjectCollection findByLibelle(string $libelle) Return ChildCategorie objects filtered by the libelle column
 * @method     ChildCategorie[]|ObjectCollection findByDescription(string $description) Return ChildCategorie objects filtered by the description column
 * @method     ChildCategorie[]|ObjectCollection findByCategorieMedia(string $categorie_media) Return ChildCategorie objects filtered by the categorie_media column
 * @method     ChildCategorie[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildCategorie objects filtered by the created_at column
 * @method     ChildCategorie[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildCategorie objects filtered by the last_updated column
 * @method     ChildCategorie[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CategorieQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\CategorieQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Categorie', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCategorieQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCategorieQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCategorieQuery) {
            return $criteria;
        }
        $query = new ChildCategorieQuery();
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
     * @return ChildCategorie|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CategorieTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = CategorieTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildCategorie A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT categorieId, libelle, description, categorie_media, created_at, last_updated FROM categories WHERE categorieId = :p0';
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
            /** @var ChildCategorie $obj */
            $obj = new ChildCategorie();
            $obj->hydrate($row);
            CategorieTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildCategorie|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the categorieId column
     *
     * Example usage:
     * <code>
     * $query->filterByCategorieID(1234); // WHERE categorieId = 1234
     * $query->filterByCategorieID(array(12, 34)); // WHERE categorieId IN (12, 34)
     * $query->filterByCategorieID(array('min' => 12)); // WHERE categorieId > 12
     * </code>
     *
     * @param     mixed $categorieID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByCategorieID($categorieID = null, $comparison = null)
    {
        if (is_array($categorieID)) {
            $useMinMax = false;
            if (isset($categorieID['min'])) {
                $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $categorieID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categorieID['max'])) {
                $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $categorieID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $categorieID, $comparison);
    }

    /**
     * Filter the query on the libelle column
     *
     * Example usage:
     * <code>
     * $query->filterByLibelle('fooValue');   // WHERE libelle = 'fooValue'
     * $query->filterByLibelle('%fooValue%', Criteria::LIKE); // WHERE libelle LIKE '%fooValue%'
     * </code>
     *
     * @param     string $libelle The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByLibelle($libelle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_LIBELLE, $libelle, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%', Criteria::LIKE); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the categorie_media column
     *
     * Example usage:
     * <code>
     * $query->filterByCategorieMedia('fooValue');   // WHERE categorie_media = 'fooValue'
     * $query->filterByCategorieMedia('%fooValue%', Criteria::LIKE); // WHERE categorie_media LIKE '%fooValue%'
     * </code>
     *
     * @param     string $categorieMedia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByCategorieMedia($categorieMedia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($categorieMedia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_CATEGORIE_MEDIA, $categorieMedia, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CategorieTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CategorieTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the last_updated column
     *
     * Example usage:
     * <code>
     * $query->filterByLastUpdated('2011-03-14'); // WHERE last_updated = '2011-03-14'
     * $query->filterByLastUpdated('now'); // WHERE last_updated = '2011-03-14'
     * $query->filterByLastUpdated(array('max' => 'yesterday')); // WHERE last_updated > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastUpdated The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(CategorieTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(CategorieTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CategorieTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Service object
     *
     * @param \partner\Service|ObjectCollection $service the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildCategorieQuery The current query, for fluid interface
     */
    public function filterByService($service, $comparison = null)
    {
        if ($service instanceof \partner\Service) {
            return $this
                ->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $service->getCategorieID(), $comparison);
        } elseif ($service instanceof ObjectCollection) {
            return $this
                ->useServiceQuery()
                ->filterByPrimaryKeys($service->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByService() only accepts arguments of type \partner\Service or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Service relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function joinService($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Service');

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
            $this->addJoinObject($join, 'Service');
        }

        return $this;
    }

    /**
     * Use the Service relation Service object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\ServiceQuery A secondary query class using the current class as primary query
     */
    public function useServiceQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinService($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Service', '\partner\ServiceQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCategorie $categorie Object to remove from the list of results
     *
     * @return $this|ChildCategorieQuery The current query, for fluid interface
     */
    public function prune($categorie = null)
    {
        if ($categorie) {
            $this->addUsingAlias(CategorieTableMap::COL_CATEGORIEID, $categorie->getCategorieID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategorieTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CategorieTableMap::clearInstancePool();
            CategorieTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CategorieTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CategorieTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CategorieTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CategorieTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // CategorieQuery
