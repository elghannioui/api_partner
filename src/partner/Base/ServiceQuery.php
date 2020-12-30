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
use partner\Service as ChildService;
use partner\ServiceQuery as ChildServiceQuery;
use partner\Map\ServiceTableMap;

/**
 * Base class that represents a query for the 'services' table.
 *
 *
 *
 * @method     ChildServiceQuery orderByServiceID($order = Criteria::ASC) Order by the serviceId column
 * @method     ChildServiceQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 * @method     ChildServiceQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildServiceQuery orderByServiceMedia($order = Criteria::ASC) Order by the service_media column
 * @method     ChildServiceQuery orderByCategorieID($order = Criteria::ASC) Order by the categorieId column
 * @method     ChildServiceQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildServiceQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildServiceQuery groupByServiceID() Group by the serviceId column
 * @method     ChildServiceQuery groupByLibelle() Group by the libelle column
 * @method     ChildServiceQuery groupByDescription() Group by the description column
 * @method     ChildServiceQuery groupByServiceMedia() Group by the service_media column
 * @method     ChildServiceQuery groupByCategorieID() Group by the categorieId column
 * @method     ChildServiceQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildServiceQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildServiceQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildServiceQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildServiceQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildServiceQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildServiceQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildServiceQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildServiceQuery leftJoinCategorie($relationAlias = null) Adds a LEFT JOIN clause to the query using the Categorie relation
 * @method     ChildServiceQuery rightJoinCategorie($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Categorie relation
 * @method     ChildServiceQuery innerJoinCategorie($relationAlias = null) Adds a INNER JOIN clause to the query using the Categorie relation
 *
 * @method     ChildServiceQuery joinWithCategorie($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Categorie relation
 *
 * @method     ChildServiceQuery leftJoinWithCategorie() Adds a LEFT JOIN clause and with to the query using the Categorie relation
 * @method     ChildServiceQuery rightJoinWithCategorie() Adds a RIGHT JOIN clause and with to the query using the Categorie relation
 * @method     ChildServiceQuery innerJoinWithCategorie() Adds a INNER JOIN clause and with to the query using the Categorie relation
 *
 * @method     ChildServiceQuery leftJoinPrestation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestation relation
 * @method     ChildServiceQuery rightJoinPrestation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestation relation
 * @method     ChildServiceQuery innerJoinPrestation($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestation relation
 *
 * @method     ChildServiceQuery joinWithPrestation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestation relation
 *
 * @method     ChildServiceQuery leftJoinWithPrestation() Adds a LEFT JOIN clause and with to the query using the Prestation relation
 * @method     ChildServiceQuery rightJoinWithPrestation() Adds a RIGHT JOIN clause and with to the query using the Prestation relation
 * @method     ChildServiceQuery innerJoinWithPrestation() Adds a INNER JOIN clause and with to the query using the Prestation relation
 *
 * @method     \partner\CategorieQuery|\partner\PrestationQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildService findOne(ConnectionInterface $con = null) Return the first ChildService matching the query
 * @method     ChildService findOneOrCreate(ConnectionInterface $con = null) Return the first ChildService matching the query, or a new ChildService object populated from the query conditions when no match is found
 *
 * @method     ChildService findOneByServiceID(int $serviceId) Return the first ChildService filtered by the serviceId column
 * @method     ChildService findOneByLibelle(string $libelle) Return the first ChildService filtered by the libelle column
 * @method     ChildService findOneByDescription(string $description) Return the first ChildService filtered by the description column
 * @method     ChildService findOneByServiceMedia(string $service_media) Return the first ChildService filtered by the service_media column
 * @method     ChildService findOneByCategorieID(int $categorieId) Return the first ChildService filtered by the categorieId column
 * @method     ChildService findOneByCreatedAt(string $created_at) Return the first ChildService filtered by the created_at column
 * @method     ChildService findOneByLastUpdated(string $last_updated) Return the first ChildService filtered by the last_updated column *

 * @method     ChildService requirePk($key, ConnectionInterface $con = null) Return the ChildService by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOne(ConnectionInterface $con = null) Return the first ChildService matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildService requireOneByServiceID(int $serviceId) Return the first ChildService filtered by the serviceId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByLibelle(string $libelle) Return the first ChildService filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByDescription(string $description) Return the first ChildService filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByServiceMedia(string $service_media) Return the first ChildService filtered by the service_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByCategorieID(int $categorieId) Return the first ChildService filtered by the categorieId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByCreatedAt(string $created_at) Return the first ChildService filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildService requireOneByLastUpdated(string $last_updated) Return the first ChildService filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildService[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildService objects based on current ModelCriteria
 * @method     ChildService[]|ObjectCollection findByServiceID(int $serviceId) Return ChildService objects filtered by the serviceId column
 * @method     ChildService[]|ObjectCollection findByLibelle(string $libelle) Return ChildService objects filtered by the libelle column
 * @method     ChildService[]|ObjectCollection findByDescription(string $description) Return ChildService objects filtered by the description column
 * @method     ChildService[]|ObjectCollection findByServiceMedia(string $service_media) Return ChildService objects filtered by the service_media column
 * @method     ChildService[]|ObjectCollection findByCategorieID(int $categorieId) Return ChildService objects filtered by the categorieId column
 * @method     ChildService[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildService objects filtered by the created_at column
 * @method     ChildService[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildService objects filtered by the last_updated column
 * @method     ChildService[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ServiceQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\ServiceQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Service', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildServiceQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildServiceQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildServiceQuery) {
            return $criteria;
        }
        $query = new ChildServiceQuery();
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
     * @return ChildService|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ServiceTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ServiceTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildService A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT serviceId, libelle, description, service_media, categorieId, created_at, last_updated FROM services WHERE serviceId = :p0';
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
            /** @var ChildService $obj */
            $obj = new ChildService();
            $obj->hydrate($row);
            ServiceTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildService|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the serviceId column
     *
     * Example usage:
     * <code>
     * $query->filterByServiceID(1234); // WHERE serviceId = 1234
     * $query->filterByServiceID(array(12, 34)); // WHERE serviceId IN (12, 34)
     * $query->filterByServiceID(array('min' => 12)); // WHERE serviceId > 12
     * </code>
     *
     * @param     mixed $serviceID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByServiceID($serviceID = null, $comparison = null)
    {
        if (is_array($serviceID)) {
            $useMinMax = false;
            if (isset($serviceID['min'])) {
                $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serviceID['max'])) {
                $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $serviceID, $comparison);
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByLibelle($libelle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_LIBELLE, $libelle, $comparison);
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the service_media column
     *
     * Example usage:
     * <code>
     * $query->filterByServiceMedia('fooValue');   // WHERE service_media = 'fooValue'
     * $query->filterByServiceMedia('%fooValue%', Criteria::LIKE); // WHERE service_media LIKE '%fooValue%'
     * </code>
     *
     * @param     string $serviceMedia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByServiceMedia($serviceMedia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($serviceMedia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_SERVICE_MEDIA, $serviceMedia, $comparison);
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
     * @see       filterByCategorie()
     *
     * @param     mixed $categorieID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByCategorieID($categorieID = null, $comparison = null)
    {
        if (is_array($categorieID)) {
            $useMinMax = false;
            if (isset($categorieID['min'])) {
                $this->addUsingAlias(ServiceTableMap::COL_CATEGORIEID, $categorieID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categorieID['max'])) {
                $this->addUsingAlias(ServiceTableMap::COL_CATEGORIEID, $categorieID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_CATEGORIEID, $categorieID, $comparison);
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ServiceTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ServiceTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(ServiceTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(ServiceTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ServiceTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Categorie object
     *
     * @param \partner\Categorie|ObjectCollection $categorie The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildServiceQuery The current query, for fluid interface
     */
    public function filterByCategorie($categorie, $comparison = null)
    {
        if ($categorie instanceof \partner\Categorie) {
            return $this
                ->addUsingAlias(ServiceTableMap::COL_CATEGORIEID, $categorie->getCategorieID(), $comparison);
        } elseif ($categorie instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ServiceTableMap::COL_CATEGORIEID, $categorie->toKeyValue('PrimaryKey', 'CategorieID'), $comparison);
        } else {
            throw new PropelException('filterByCategorie() only accepts arguments of type \partner\Categorie or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Categorie relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function joinCategorie($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Categorie');

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
            $this->addJoinObject($join, 'Categorie');
        }

        return $this;
    }

    /**
     * Use the Categorie relation Categorie object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\CategorieQuery A secondary query class using the current class as primary query
     */
    public function useCategorieQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategorie($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Categorie', '\partner\CategorieQuery');
    }

    /**
     * Filter the query by a related \partner\Prestation object
     *
     * @param \partner\Prestation|ObjectCollection $prestation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildServiceQuery The current query, for fluid interface
     */
    public function filterByPrestation($prestation, $comparison = null)
    {
        if ($prestation instanceof \partner\Prestation) {
            return $this
                ->addUsingAlias(ServiceTableMap::COL_SERVICEID, $prestation->getServiceID(), $comparison);
        } elseif ($prestation instanceof ObjectCollection) {
            return $this
                ->usePrestationQuery()
                ->filterByPrimaryKeys($prestation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrestation() only accepts arguments of type \partner\Prestation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prestation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function joinPrestation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prestation');

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
            $this->addJoinObject($join, 'Prestation');
        }

        return $this;
    }

    /**
     * Use the Prestation relation Prestation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\PrestationQuery A secondary query class using the current class as primary query
     */
    public function usePrestationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrestation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prestation', '\partner\PrestationQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildService $service Object to remove from the list of results
     *
     * @return $this|ChildServiceQuery The current query, for fluid interface
     */
    public function prune($service = null)
    {
        if ($service) {
            $this->addUsingAlias(ServiceTableMap::COL_SERVICEID, $service->getServiceID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ServiceTableMap::clearInstancePool();
            ServiceTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ServiceTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ServiceTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ServiceTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ServiceQuery
