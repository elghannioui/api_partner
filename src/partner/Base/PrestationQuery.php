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
use partner\Prestation as ChildPrestation;
use partner\PrestationQuery as ChildPrestationQuery;
use partner\Map\PrestationTableMap;

/**
 * Base class that represents a query for the 'prestations' table.
 *
 *
 *
 * @method     ChildPrestationQuery orderByPrestationID($order = Criteria::ASC) Order by the prestationId column
 * @method     ChildPrestationQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 * @method     ChildPrestationQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildPrestationQuery orderByPrestationMedia($order = Criteria::ASC) Order by the prestation_media column
 * @method     ChildPrestationQuery orderByPrixVente($order = Criteria::ASC) Order by the prix_vente column
 * @method     ChildPrestationQuery orderByServiceID($order = Criteria::ASC) Order by the serviceId column
 * @method     ChildPrestationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildPrestationQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildPrestationQuery groupByPrestationID() Group by the prestationId column
 * @method     ChildPrestationQuery groupByLibelle() Group by the libelle column
 * @method     ChildPrestationQuery groupByDescription() Group by the description column
 * @method     ChildPrestationQuery groupByPrestationMedia() Group by the prestation_media column
 * @method     ChildPrestationQuery groupByPrixVente() Group by the prix_vente column
 * @method     ChildPrestationQuery groupByServiceID() Group by the serviceId column
 * @method     ChildPrestationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildPrestationQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildPrestationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrestationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrestationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrestationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrestationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrestationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrestationQuery leftJoinService($relationAlias = null) Adds a LEFT JOIN clause to the query using the Service relation
 * @method     ChildPrestationQuery rightJoinService($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Service relation
 * @method     ChildPrestationQuery innerJoinService($relationAlias = null) Adds a INNER JOIN clause to the query using the Service relation
 *
 * @method     ChildPrestationQuery joinWithService($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Service relation
 *
 * @method     ChildPrestationQuery leftJoinWithService() Adds a LEFT JOIN clause and with to the query using the Service relation
 * @method     ChildPrestationQuery rightJoinWithService() Adds a RIGHT JOIN clause and with to the query using the Service relation
 * @method     ChildPrestationQuery innerJoinWithService() Adds a INNER JOIN clause and with to the query using the Service relation
 *
 * @method     ChildPrestationQuery leftJoinUserprestation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Userprestation relation
 * @method     ChildPrestationQuery rightJoinUserprestation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Userprestation relation
 * @method     ChildPrestationQuery innerJoinUserprestation($relationAlias = null) Adds a INNER JOIN clause to the query using the Userprestation relation
 *
 * @method     ChildPrestationQuery joinWithUserprestation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Userprestation relation
 *
 * @method     ChildPrestationQuery leftJoinWithUserprestation() Adds a LEFT JOIN clause and with to the query using the Userprestation relation
 * @method     ChildPrestationQuery rightJoinWithUserprestation() Adds a RIGHT JOIN clause and with to the query using the Userprestation relation
 * @method     ChildPrestationQuery innerJoinWithUserprestation() Adds a INNER JOIN clause and with to the query using the Userprestation relation
 *
 * @method     ChildPrestationQuery leftJoinPrestationdevis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestationdevis relation
 * @method     ChildPrestationQuery rightJoinPrestationdevis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestationdevis relation
 * @method     ChildPrestationQuery innerJoinPrestationdevis($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestationdevis relation
 *
 * @method     ChildPrestationQuery joinWithPrestationdevis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestationdevis relation
 *
 * @method     ChildPrestationQuery leftJoinWithPrestationdevis() Adds a LEFT JOIN clause and with to the query using the Prestationdevis relation
 * @method     ChildPrestationQuery rightJoinWithPrestationdevis() Adds a RIGHT JOIN clause and with to the query using the Prestationdevis relation
 * @method     ChildPrestationQuery innerJoinWithPrestationdevis() Adds a INNER JOIN clause and with to the query using the Prestationdevis relation
 *
 * @method     \partner\ServiceQuery|\partner\UserprestationQuery|\partner\PrestationdevisQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrestation findOne(ConnectionInterface $con = null) Return the first ChildPrestation matching the query
 * @method     ChildPrestation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPrestation matching the query, or a new ChildPrestation object populated from the query conditions when no match is found
 *
 * @method     ChildPrestation findOneByPrestationID(int $prestationId) Return the first ChildPrestation filtered by the prestationId column
 * @method     ChildPrestation findOneByLibelle(string $libelle) Return the first ChildPrestation filtered by the libelle column
 * @method     ChildPrestation findOneByDescription(string $description) Return the first ChildPrestation filtered by the description column
 * @method     ChildPrestation findOneByPrestationMedia(string $prestation_media) Return the first ChildPrestation filtered by the prestation_media column
 * @method     ChildPrestation findOneByPrixVente(double $prix_vente) Return the first ChildPrestation filtered by the prix_vente column
 * @method     ChildPrestation findOneByServiceID(int $serviceId) Return the first ChildPrestation filtered by the serviceId column
 * @method     ChildPrestation findOneByCreatedAt(string $created_at) Return the first ChildPrestation filtered by the created_at column
 * @method     ChildPrestation findOneByLastUpdated(string $last_updated) Return the first ChildPrestation filtered by the last_updated column *

 * @method     ChildPrestation requirePk($key, ConnectionInterface $con = null) Return the ChildPrestation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOne(ConnectionInterface $con = null) Return the first ChildPrestation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestation requireOneByPrestationID(int $prestationId) Return the first ChildPrestation filtered by the prestationId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByLibelle(string $libelle) Return the first ChildPrestation filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByDescription(string $description) Return the first ChildPrestation filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByPrestationMedia(string $prestation_media) Return the first ChildPrestation filtered by the prestation_media column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByPrixVente(double $prix_vente) Return the first ChildPrestation filtered by the prix_vente column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByServiceID(int $serviceId) Return the first ChildPrestation filtered by the serviceId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByCreatedAt(string $created_at) Return the first ChildPrestation filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestation requireOneByLastUpdated(string $last_updated) Return the first ChildPrestation filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPrestation objects based on current ModelCriteria
 * @method     ChildPrestation[]|ObjectCollection findByPrestationID(int $prestationId) Return ChildPrestation objects filtered by the prestationId column
 * @method     ChildPrestation[]|ObjectCollection findByLibelle(string $libelle) Return ChildPrestation objects filtered by the libelle column
 * @method     ChildPrestation[]|ObjectCollection findByDescription(string $description) Return ChildPrestation objects filtered by the description column
 * @method     ChildPrestation[]|ObjectCollection findByPrestationMedia(string $prestation_media) Return ChildPrestation objects filtered by the prestation_media column
 * @method     ChildPrestation[]|ObjectCollection findByPrixVente(double $prix_vente) Return ChildPrestation objects filtered by the prix_vente column
 * @method     ChildPrestation[]|ObjectCollection findByServiceID(int $serviceId) Return ChildPrestation objects filtered by the serviceId column
 * @method     ChildPrestation[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildPrestation objects filtered by the created_at column
 * @method     ChildPrestation[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildPrestation objects filtered by the last_updated column
 * @method     ChildPrestation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PrestationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\PrestationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Prestation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrestationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrestationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPrestationQuery) {
            return $criteria;
        }
        $query = new ChildPrestationQuery();
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
     * @return ChildPrestation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrestationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrestationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPrestation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prestationId, libelle, description, prestation_media, prix_vente, serviceId, created_at, last_updated FROM prestations WHERE prestationId = :p0';
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
            /** @var ChildPrestation $obj */
            $obj = new ChildPrestation();
            $obj->hydrate($row);
            PrestationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPrestation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the prestationId column
     *
     * Example usage:
     * <code>
     * $query->filterByPrestationID(1234); // WHERE prestationId = 1234
     * $query->filterByPrestationID(array(12, 34)); // WHERE prestationId IN (12, 34)
     * $query->filterByPrestationID(array('min' => 12)); // WHERE prestationId > 12
     * </code>
     *
     * @param     mixed $prestationID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrestationID($prestationID = null, $comparison = null)
    {
        if (is_array($prestationID)) {
            $useMinMax = false;
            if (isset($prestationID['min'])) {
                $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $prestationID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prestationID['max'])) {
                $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $prestationID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $prestationID, $comparison);
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByLibelle($libelle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_LIBELLE, $libelle, $comparison);
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query on the prestation_media column
     *
     * Example usage:
     * <code>
     * $query->filterByPrestationMedia('fooValue');   // WHERE prestation_media = 'fooValue'
     * $query->filterByPrestationMedia('%fooValue%', Criteria::LIKE); // WHERE prestation_media LIKE '%fooValue%'
     * </code>
     *
     * @param     string $prestationMedia The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrestationMedia($prestationMedia = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($prestationMedia)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_PRESTATION_MEDIA, $prestationMedia, $comparison);
    }

    /**
     * Filter the query on the prix_vente column
     *
     * Example usage:
     * <code>
     * $query->filterByPrixVente(1234); // WHERE prix_vente = 1234
     * $query->filterByPrixVente(array(12, 34)); // WHERE prix_vente IN (12, 34)
     * $query->filterByPrixVente(array('min' => 12)); // WHERE prix_vente > 12
     * </code>
     *
     * @param     mixed $prixVente The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrixVente($prixVente = null, $comparison = null)
    {
        if (is_array($prixVente)) {
            $useMinMax = false;
            if (isset($prixVente['min'])) {
                $this->addUsingAlias(PrestationTableMap::COL_PRIX_VENTE, $prixVente['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prixVente['max'])) {
                $this->addUsingAlias(PrestationTableMap::COL_PRIX_VENTE, $prixVente['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_PRIX_VENTE, $prixVente, $comparison);
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
     * @see       filterByService()
     *
     * @param     mixed $serviceID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByServiceID($serviceID = null, $comparison = null)
    {
        if (is_array($serviceID)) {
            $useMinMax = false;
            if (isset($serviceID['min'])) {
                $this->addUsingAlias(PrestationTableMap::COL_SERVICEID, $serviceID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($serviceID['max'])) {
                $this->addUsingAlias(PrestationTableMap::COL_SERVICEID, $serviceID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_SERVICEID, $serviceID, $comparison);
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PrestationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PrestationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(PrestationTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(PrestationTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Service object
     *
     * @param \partner\Service|ObjectCollection $service The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByService($service, $comparison = null)
    {
        if ($service instanceof \partner\Service) {
            return $this
                ->addUsingAlias(PrestationTableMap::COL_SERVICEID, $service->getServiceID(), $comparison);
        } elseif ($service instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestationTableMap::COL_SERVICEID, $service->toKeyValue('PrimaryKey', 'ServiceID'), $comparison);
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
     * @return $this|ChildPrestationQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Userprestation object
     *
     * @param \partner\Userprestation|ObjectCollection $userprestation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByUserprestation($userprestation, $comparison = null)
    {
        if ($userprestation instanceof \partner\Userprestation) {
            return $this
                ->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $userprestation->getPrestationID(), $comparison);
        } elseif ($userprestation instanceof ObjectCollection) {
            return $this
                ->useUserprestationQuery()
                ->filterByPrimaryKeys($userprestation->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserprestation() only accepts arguments of type \partner\Userprestation or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Userprestation relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function joinUserprestation($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Userprestation');

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
            $this->addJoinObject($join, 'Userprestation');
        }

        return $this;
    }

    /**
     * Use the Userprestation relation Userprestation object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\UserprestationQuery A secondary query class using the current class as primary query
     */
    public function useUserprestationQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserprestation($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Userprestation', '\partner\UserprestationQuery');
    }

    /**
     * Filter the query by a related \partner\Prestationdevis object
     *
     * @param \partner\Prestationdevis|ObjectCollection $prestationdevis the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildPrestationQuery The current query, for fluid interface
     */
    public function filterByPrestationdevis($prestationdevis, $comparison = null)
    {
        if ($prestationdevis instanceof \partner\Prestationdevis) {
            return $this
                ->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $prestationdevis->getPrestationID(), $comparison);
        } elseif ($prestationdevis instanceof ObjectCollection) {
            return $this
                ->usePrestationdevisQuery()
                ->filterByPrimaryKeys($prestationdevis->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPrestationdevis() only accepts arguments of type \partner\Prestationdevis or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Prestationdevis relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function joinPrestationdevis($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Prestationdevis');

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
            $this->addJoinObject($join, 'Prestationdevis');
        }

        return $this;
    }

    /**
     * Use the Prestationdevis relation Prestationdevis object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\PrestationdevisQuery A secondary query class using the current class as primary query
     */
    public function usePrestationdevisQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPrestationdevis($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Prestationdevis', '\partner\PrestationdevisQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildPrestation $prestation Object to remove from the list of results
     *
     * @return $this|ChildPrestationQuery The current query, for fluid interface
     */
    public function prune($prestation = null)
    {
        if ($prestation) {
            $this->addUsingAlias(PrestationTableMap::COL_PRESTATIONID, $prestation->getPrestationID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the prestations table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrestationTableMap::clearInstancePool();
            PrestationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrestationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrestationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrestationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PrestationQuery
