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
use partner\Adresse as ChildAdresse;
use partner\AdresseQuery as ChildAdresseQuery;
use partner\Map\AdresseTableMap;

/**
 * Base class that represents a query for the 'adresses' table.
 *
 *
 *
 * @method     ChildAdresseQuery orderByAdressID($order = Criteria::ASC) Order by the adresseId column
 * @method     ChildAdresseQuery orderByLibelle($order = Criteria::ASC) Order by the libelle column
 * @method     ChildAdresseQuery orderByVille($order = Criteria::ASC) Order by the ville column
 * @method     ChildAdresseQuery orderByOfficeNumber($order = Criteria::ASC) Order by the numero_bureau column
 * @method     ChildAdresseQuery orderByOfficeSurface($order = Criteria::ASC) Order by the surface_bureau column
 * @method     ChildAdresseQuery orderByClientID($order = Criteria::ASC) Order by the clientId column
 * @method     ChildAdresseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAdresseQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildAdresseQuery groupByAdressID() Group by the adresseId column
 * @method     ChildAdresseQuery groupByLibelle() Group by the libelle column
 * @method     ChildAdresseQuery groupByVille() Group by the ville column
 * @method     ChildAdresseQuery groupByOfficeNumber() Group by the numero_bureau column
 * @method     ChildAdresseQuery groupByOfficeSurface() Group by the surface_bureau column
 * @method     ChildAdresseQuery groupByClientID() Group by the clientId column
 * @method     ChildAdresseQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAdresseQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildAdresseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAdresseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAdresseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAdresseQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAdresseQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAdresseQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAdresseQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method     ChildAdresseQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method     ChildAdresseQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method     ChildAdresseQuery joinWithClient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Client relation
 *
 * @method     ChildAdresseQuery leftJoinWithClient() Adds a LEFT JOIN clause and with to the query using the Client relation
 * @method     ChildAdresseQuery rightJoinWithClient() Adds a RIGHT JOIN clause and with to the query using the Client relation
 * @method     ChildAdresseQuery innerJoinWithClient() Adds a INNER JOIN clause and with to the query using the Client relation
 *
 * @method     \partner\ClientQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAdresse findOne(ConnectionInterface $con = null) Return the first ChildAdresse matching the query
 * @method     ChildAdresse findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAdresse matching the query, or a new ChildAdresse object populated from the query conditions when no match is found
 *
 * @method     ChildAdresse findOneByAdressID(int $adresseId) Return the first ChildAdresse filtered by the adresseId column
 * @method     ChildAdresse findOneByLibelle(string $libelle) Return the first ChildAdresse filtered by the libelle column
 * @method     ChildAdresse findOneByVille(string $ville) Return the first ChildAdresse filtered by the ville column
 * @method     ChildAdresse findOneByOfficeNumber(string $numero_bureau) Return the first ChildAdresse filtered by the numero_bureau column
 * @method     ChildAdresse findOneByOfficeSurface(string $surface_bureau) Return the first ChildAdresse filtered by the surface_bureau column
 * @method     ChildAdresse findOneByClientID(int $clientId) Return the first ChildAdresse filtered by the clientId column
 * @method     ChildAdresse findOneByCreatedAt(string $created_at) Return the first ChildAdresse filtered by the created_at column
 * @method     ChildAdresse findOneByLastUpdated(string $last_updated) Return the first ChildAdresse filtered by the last_updated column *

 * @method     ChildAdresse requirePk($key, ConnectionInterface $con = null) Return the ChildAdresse by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOne(ConnectionInterface $con = null) Return the first ChildAdresse matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdresse requireOneByAdressID(int $adresseId) Return the first ChildAdresse filtered by the adresseId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByLibelle(string $libelle) Return the first ChildAdresse filtered by the libelle column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByVille(string $ville) Return the first ChildAdresse filtered by the ville column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByOfficeNumber(string $numero_bureau) Return the first ChildAdresse filtered by the numero_bureau column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByOfficeSurface(string $surface_bureau) Return the first ChildAdresse filtered by the surface_bureau column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByClientID(int $clientId) Return the first ChildAdresse filtered by the clientId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByCreatedAt(string $created_at) Return the first ChildAdresse filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAdresse requireOneByLastUpdated(string $last_updated) Return the first ChildAdresse filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAdresse[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAdresse objects based on current ModelCriteria
 * @method     ChildAdresse[]|ObjectCollection findByAdressID(int $adresseId) Return ChildAdresse objects filtered by the adresseId column
 * @method     ChildAdresse[]|ObjectCollection findByLibelle(string $libelle) Return ChildAdresse objects filtered by the libelle column
 * @method     ChildAdresse[]|ObjectCollection findByVille(string $ville) Return ChildAdresse objects filtered by the ville column
 * @method     ChildAdresse[]|ObjectCollection findByOfficeNumber(string $numero_bureau) Return ChildAdresse objects filtered by the numero_bureau column
 * @method     ChildAdresse[]|ObjectCollection findByOfficeSurface(string $surface_bureau) Return ChildAdresse objects filtered by the surface_bureau column
 * @method     ChildAdresse[]|ObjectCollection findByClientID(int $clientId) Return ChildAdresse objects filtered by the clientId column
 * @method     ChildAdresse[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildAdresse objects filtered by the created_at column
 * @method     ChildAdresse[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildAdresse objects filtered by the last_updated column
 * @method     ChildAdresse[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AdresseQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\AdresseQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Adresse', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAdresseQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAdresseQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAdresseQuery) {
            return $criteria;
        }
        $query = new ChildAdresseQuery();
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
     * @return ChildAdresse|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AdresseTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AdresseTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAdresse A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT adresseId, libelle, ville, numero_bureau, surface_bureau, clientId, created_at, last_updated FROM adresses WHERE adresseId = :p0';
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
            /** @var ChildAdresse $obj */
            $obj = new ChildAdresse();
            $obj->hydrate($row);
            AdresseTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAdresse|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the adresseId column
     *
     * Example usage:
     * <code>
     * $query->filterByAdressID(1234); // WHERE adresseId = 1234
     * $query->filterByAdressID(array(12, 34)); // WHERE adresseId IN (12, 34)
     * $query->filterByAdressID(array('min' => 12)); // WHERE adresseId > 12
     * </code>
     *
     * @param     mixed $adressID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByAdressID($adressID = null, $comparison = null)
    {
        if (is_array($adressID)) {
            $useMinMax = false;
            if (isset($adressID['min'])) {
                $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $adressID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($adressID['max'])) {
                $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $adressID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $adressID, $comparison);
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
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByLibelle($libelle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($libelle)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_LIBELLE, $libelle, $comparison);
    }

    /**
     * Filter the query on the ville column
     *
     * Example usage:
     * <code>
     * $query->filterByVille('fooValue');   // WHERE ville = 'fooValue'
     * $query->filterByVille('%fooValue%', Criteria::LIKE); // WHERE ville LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ville The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByVille($ville = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ville)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_VILLE, $ville, $comparison);
    }

    /**
     * Filter the query on the numero_bureau column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficeNumber('fooValue');   // WHERE numero_bureau = 'fooValue'
     * $query->filterByOfficeNumber('%fooValue%', Criteria::LIKE); // WHERE numero_bureau LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officeNumber The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByOfficeNumber($officeNumber = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officeNumber)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_NUMERO_BUREAU, $officeNumber, $comparison);
    }

    /**
     * Filter the query on the surface_bureau column
     *
     * Example usage:
     * <code>
     * $query->filterByOfficeSurface('fooValue');   // WHERE surface_bureau = 'fooValue'
     * $query->filterByOfficeSurface('%fooValue%', Criteria::LIKE); // WHERE surface_bureau LIKE '%fooValue%'
     * </code>
     *
     * @param     string $officeSurface The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByOfficeSurface($officeSurface = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($officeSurface)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_SURFACE_BUREAU, $officeSurface, $comparison);
    }

    /**
     * Filter the query on the clientId column
     *
     * Example usage:
     * <code>
     * $query->filterByClientID(1234); // WHERE clientId = 1234
     * $query->filterByClientID(array(12, 34)); // WHERE clientId IN (12, 34)
     * $query->filterByClientID(array('min' => 12)); // WHERE clientId > 12
     * </code>
     *
     * @see       filterByClient()
     *
     * @param     mixed $clientID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByClientID($clientID = null, $comparison = null)
    {
        if (is_array($clientID)) {
            $useMinMax = false;
            if (isset($clientID['min'])) {
                $this->addUsingAlias(AdresseTableMap::COL_CLIENTID, $clientID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientID['max'])) {
                $this->addUsingAlias(AdresseTableMap::COL_CLIENTID, $clientID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_CLIENTID, $clientID, $comparison);
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
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AdresseTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AdresseTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(AdresseTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(AdresseTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AdresseTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Client object
     *
     * @param \partner\Client|ObjectCollection $client The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAdresseQuery The current query, for fluid interface
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof \partner\Client) {
            return $this
                ->addUsingAlias(AdresseTableMap::COL_CLIENTID, $client->getClientID(), $comparison);
        } elseif ($client instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AdresseTableMap::COL_CLIENTID, $client->toKeyValue('PrimaryKey', 'ClientID'), $comparison);
        } else {
            throw new PropelException('filterByClient() only accepts arguments of type \partner\Client or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Client relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function joinClient($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Client');

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
            $this->addJoinObject($join, 'Client');
        }

        return $this;
    }

    /**
     * Use the Client relation Client object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\ClientQuery A secondary query class using the current class as primary query
     */
    public function useClientQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinClient($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Client', '\partner\ClientQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAdresse $adresse Object to remove from the list of results
     *
     * @return $this|ChildAdresseQuery The current query, for fluid interface
     */
    public function prune($adresse = null)
    {
        if ($adresse) {
            $this->addUsingAlias(AdresseTableMap::COL_ADRESSEID, $adresse->getAdressID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the adresses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AdresseTableMap::clearInstancePool();
            AdresseTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AdresseTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AdresseTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AdresseTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AdresseQuery
