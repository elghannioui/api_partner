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
use partner\Client as ChildClient;
use partner\ClientQuery as ChildClientQuery;
use partner\Map\ClientTableMap;

/**
 * Base class that represents a query for the 'clients' table.
 *
 *
 *
 * @method     ChildClientQuery orderByClientID($order = Criteria::ASC) Order by the clientId column
 * @method     ChildClientQuery orderByType($order = Criteria::ASC) Order by the type column
 * @method     ChildClientQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method     ChildClientQuery orderByTelephone($order = Criteria::ASC) Order by the telephone column
 * @method     ChildClientQuery orderByEmail($order = Criteria::ASC) Order by the email column
 * @method     ChildClientQuery orderByPassword($order = Criteria::ASC) Order by the mot_de_passe column
 * @method     ChildClientQuery orderByAccessChannel($order = Criteria::ASC) Order by the access_channel column
 * @method     ChildClientQuery orderByLastConnection($order = Criteria::ASC) Order by the last_connection column
 * @method     ChildClientQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildClientQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildClientQuery groupByClientID() Group by the clientId column
 * @method     ChildClientQuery groupByType() Group by the type column
 * @method     ChildClientQuery groupByNom() Group by the nom column
 * @method     ChildClientQuery groupByTelephone() Group by the telephone column
 * @method     ChildClientQuery groupByEmail() Group by the email column
 * @method     ChildClientQuery groupByPassword() Group by the mot_de_passe column
 * @method     ChildClientQuery groupByAccessChannel() Group by the access_channel column
 * @method     ChildClientQuery groupByLastConnection() Group by the last_connection column
 * @method     ChildClientQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildClientQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildClientQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildClientQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildClientQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildClientQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildClientQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildClientQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildClientQuery leftJoinAdresse($relationAlias = null) Adds a LEFT JOIN clause to the query using the Adresse relation
 * @method     ChildClientQuery rightJoinAdresse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Adresse relation
 * @method     ChildClientQuery innerJoinAdresse($relationAlias = null) Adds a INNER JOIN clause to the query using the Adresse relation
 *
 * @method     ChildClientQuery joinWithAdresse($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Adresse relation
 *
 * @method     ChildClientQuery leftJoinWithAdresse() Adds a LEFT JOIN clause and with to the query using the Adresse relation
 * @method     ChildClientQuery rightJoinWithAdresse() Adds a RIGHT JOIN clause and with to the query using the Adresse relation
 * @method     ChildClientQuery innerJoinWithAdresse() Adds a INNER JOIN clause and with to the query using the Adresse relation
 *
 * @method     ChildClientQuery leftJoinDevi($relationAlias = null) Adds a LEFT JOIN clause to the query using the Devi relation
 * @method     ChildClientQuery rightJoinDevi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Devi relation
 * @method     ChildClientQuery innerJoinDevi($relationAlias = null) Adds a INNER JOIN clause to the query using the Devi relation
 *
 * @method     ChildClientQuery joinWithDevi($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Devi relation
 *
 * @method     ChildClientQuery leftJoinWithDevi() Adds a LEFT JOIN clause and with to the query using the Devi relation
 * @method     ChildClientQuery rightJoinWithDevi() Adds a RIGHT JOIN clause and with to the query using the Devi relation
 * @method     ChildClientQuery innerJoinWithDevi() Adds a INNER JOIN clause and with to the query using the Devi relation
 *
 * @method     \partner\AdresseQuery|\partner\DeviQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildClient findOne(ConnectionInterface $con = null) Return the first ChildClient matching the query
 * @method     ChildClient findOneOrCreate(ConnectionInterface $con = null) Return the first ChildClient matching the query, or a new ChildClient object populated from the query conditions when no match is found
 *
 * @method     ChildClient findOneByClientID(int $clientId) Return the first ChildClient filtered by the clientId column
 * @method     ChildClient findOneByType(int $type) Return the first ChildClient filtered by the type column
 * @method     ChildClient findOneByNom(string $nom) Return the first ChildClient filtered by the nom column
 * @method     ChildClient findOneByTelephone(string $telephone) Return the first ChildClient filtered by the telephone column
 * @method     ChildClient findOneByEmail(string $email) Return the first ChildClient filtered by the email column
 * @method     ChildClient findOneByPassword(string $mot_de_passe) Return the first ChildClient filtered by the mot_de_passe column
 * @method     ChildClient findOneByAccessChannel(int $access_channel) Return the first ChildClient filtered by the access_channel column
 * @method     ChildClient findOneByLastConnection(string $last_connection) Return the first ChildClient filtered by the last_connection column
 * @method     ChildClient findOneByCreatedAt(string $created_at) Return the first ChildClient filtered by the created_at column
 * @method     ChildClient findOneByLastUpdated(string $last_updated) Return the first ChildClient filtered by the last_updated column *

 * @method     ChildClient requirePk($key, ConnectionInterface $con = null) Return the ChildClient by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOne(ConnectionInterface $con = null) Return the first ChildClient matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient requireOneByClientID(int $clientId) Return the first ChildClient filtered by the clientId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByType(int $type) Return the first ChildClient filtered by the type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByNom(string $nom) Return the first ChildClient filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByTelephone(string $telephone) Return the first ChildClient filtered by the telephone column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByEmail(string $email) Return the first ChildClient filtered by the email column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByPassword(string $mot_de_passe) Return the first ChildClient filtered by the mot_de_passe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByAccessChannel(int $access_channel) Return the first ChildClient filtered by the access_channel column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByLastConnection(string $last_connection) Return the first ChildClient filtered by the last_connection column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByCreatedAt(string $created_at) Return the first ChildClient filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildClient requireOneByLastUpdated(string $last_updated) Return the first ChildClient filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildClient[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildClient objects based on current ModelCriteria
 * @method     ChildClient[]|ObjectCollection findByClientID(int $clientId) Return ChildClient objects filtered by the clientId column
 * @method     ChildClient[]|ObjectCollection findByType(int $type) Return ChildClient objects filtered by the type column
 * @method     ChildClient[]|ObjectCollection findByNom(string $nom) Return ChildClient objects filtered by the nom column
 * @method     ChildClient[]|ObjectCollection findByTelephone(string $telephone) Return ChildClient objects filtered by the telephone column
 * @method     ChildClient[]|ObjectCollection findByEmail(string $email) Return ChildClient objects filtered by the email column
 * @method     ChildClient[]|ObjectCollection findByPassword(string $mot_de_passe) Return ChildClient objects filtered by the mot_de_passe column
 * @method     ChildClient[]|ObjectCollection findByAccessChannel(int $access_channel) Return ChildClient objects filtered by the access_channel column
 * @method     ChildClient[]|ObjectCollection findByLastConnection(string $last_connection) Return ChildClient objects filtered by the last_connection column
 * @method     ChildClient[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildClient objects filtered by the created_at column
 * @method     ChildClient[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildClient objects filtered by the last_updated column
 * @method     ChildClient[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ClientQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\ClientQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Client', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildClientQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildClientQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildClientQuery) {
            return $criteria;
        }
        $query = new ChildClientQuery();
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ClientTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ClientTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildClient A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT clientId, type, nom, telephone, email, mot_de_passe, access_channel, last_connection, created_at, last_updated FROM clients WHERE clientId = :p0';
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
            /** @var ChildClient $obj */
            $obj = new ChildClient();
            $obj->hydrate($row);
            ClientTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildClient|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $keys, Criteria::IN);
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
     * @param     mixed $clientID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByClientID($clientID = null, $comparison = null)
    {
        if (is_array($clientID)) {
            $useMinMax = false;
            if (isset($clientID['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $clientID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientID['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $clientID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $clientID, $comparison);
    }

    /**
     * Filter the query on the type column
     *
     * @param     mixed $type The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByType($type = null, $comparison = null)
    {
        $valueSet = ClientTableMap::getValueSet(ClientTableMap::COL_TYPE);
        if (is_scalar($type)) {
            if (!in_array($type, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $type));
            }
            $type = array_search($type, $valueSet);
        } elseif (is_array($type)) {
            $convertedValues = array();
            foreach ($type as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $type = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_TYPE, $type, $comparison);
    }

    /**
     * Filter the query on the nom column
     *
     * Example usage:
     * <code>
     * $query->filterByNom('fooValue');   // WHERE nom = 'fooValue'
     * $query->filterByNom('%fooValue%', Criteria::LIKE); // WHERE nom LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nom The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the telephone column
     *
     * Example usage:
     * <code>
     * $query->filterByTelephone('fooValue');   // WHERE telephone = 'fooValue'
     * $query->filterByTelephone('%fooValue%', Criteria::LIKE); // WHERE telephone LIKE '%fooValue%'
     * </code>
     *
     * @param     string $telephone The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByTelephone($telephone = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($telephone)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_TELEPHONE, $telephone, $comparison);
    }

    /**
     * Filter the query on the email column
     *
     * Example usage:
     * <code>
     * $query->filterByEmail('fooValue');   // WHERE email = 'fooValue'
     * $query->filterByEmail('%fooValue%', Criteria::LIKE); // WHERE email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $email The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByEmail($email = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($email)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_EMAIL, $email, $comparison);
    }

    /**
     * Filter the query on the mot_de_passe column
     *
     * Example usage:
     * <code>
     * $query->filterByPassword('fooValue');   // WHERE mot_de_passe = 'fooValue'
     * $query->filterByPassword('%fooValue%', Criteria::LIKE); // WHERE mot_de_passe LIKE '%fooValue%'
     * </code>
     *
     * @param     string $password The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByPassword($password = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($password)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_MOT_DE_PASSE, $password, $comparison);
    }

    /**
     * Filter the query on the access_channel column
     *
     * @param     mixed $accessChannel The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByAccessChannel($accessChannel = null, $comparison = null)
    {
        $valueSet = ClientTableMap::getValueSet(ClientTableMap::COL_ACCESS_CHANNEL);
        if (is_scalar($accessChannel)) {
            if (!in_array($accessChannel, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $accessChannel));
            }
            $accessChannel = array_search($accessChannel, $valueSet);
        } elseif (is_array($accessChannel)) {
            $convertedValues = array();
            foreach ($accessChannel as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $accessChannel = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_ACCESS_CHANNEL, $accessChannel, $comparison);
    }

    /**
     * Filter the query on the last_connection column
     *
     * Example usage:
     * <code>
     * $query->filterByLastConnection('2011-03-14'); // WHERE last_connection = '2011-03-14'
     * $query->filterByLastConnection('now'); // WHERE last_connection = '2011-03-14'
     * $query->filterByLastConnection(array('max' => 'yesterday')); // WHERE last_connection > '2011-03-13'
     * </code>
     *
     * @param     mixed $lastConnection The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByLastConnection($lastConnection = null, $comparison = null)
    {
        if (is_array($lastConnection)) {
            $useMinMax = false;
            if (isset($lastConnection['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_LAST_CONNECTION, $lastConnection['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastConnection['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_LAST_CONNECTION, $lastConnection['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_LAST_CONNECTION, $lastConnection, $comparison);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(ClientTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(ClientTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ClientTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Adresse object
     *
     * @param \partner\Adresse|ObjectCollection $adresse the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByAdresse($adresse, $comparison = null)
    {
        if ($adresse instanceof \partner\Adresse) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_CLIENTID, $adresse->getClientID(), $comparison);
        } elseif ($adresse instanceof ObjectCollection) {
            return $this
                ->useAdresseQuery()
                ->filterByPrimaryKeys($adresse->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAdresse() only accepts arguments of type \partner\Adresse or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Adresse relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinAdresse($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Adresse');

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
            $this->addJoinObject($join, 'Adresse');
        }

        return $this;
    }

    /**
     * Use the Adresse relation Adresse object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\AdresseQuery A secondary query class using the current class as primary query
     */
    public function useAdresseQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAdresse($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Adresse', '\partner\AdresseQuery');
    }

    /**
     * Filter the query by a related \partner\Devi object
     *
     * @param \partner\Devi|ObjectCollection $devi the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildClientQuery The current query, for fluid interface
     */
    public function filterByDevi($devi, $comparison = null)
    {
        if ($devi instanceof \partner\Devi) {
            return $this
                ->addUsingAlias(ClientTableMap::COL_CLIENTID, $devi->getClientID(), $comparison);
        } elseif ($devi instanceof ObjectCollection) {
            return $this
                ->useDeviQuery()
                ->filterByPrimaryKeys($devi->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByDevi() only accepts arguments of type \partner\Devi or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Devi relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function joinDevi($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Devi');

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
            $this->addJoinObject($join, 'Devi');
        }

        return $this;
    }

    /**
     * Use the Devi relation Devi object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\DeviQuery A secondary query class using the current class as primary query
     */
    public function useDeviQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinDevi($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Devi', '\partner\DeviQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildClient $client Object to remove from the list of results
     *
     * @return $this|ChildClientQuery The current query, for fluid interface
     */
    public function prune($client = null)
    {
        if ($client) {
            $this->addUsingAlias(ClientTableMap::COL_CLIENTID, $client->getClientID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the clients table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ClientTableMap::clearInstancePool();
            ClientTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ClientTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ClientTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ClientTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ClientQuery
