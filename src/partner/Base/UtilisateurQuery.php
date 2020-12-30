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
use partner\Utilisateur as ChildUtilisateur;
use partner\UtilisateurQuery as ChildUtilisateurQuery;
use partner\Map\UtilisateurTableMap;

/**
 * Base class that represents a query for the 'utilisateurs' table.
 *
 *
 *
 * @method     ChildUtilisateurQuery orderByUtilisateurID($order = Criteria::ASC) Order by the utilisateurId column
 * @method     ChildUtilisateurQuery orderByNom($order = Criteria::ASC) Order by the nom column
 * @method     ChildUtilisateurQuery orderByLogin($order = Criteria::ASC) Order by the login column
 * @method     ChildUtilisateurQuery orderByMotDePasse($order = Criteria::ASC) Order by the mot_de_passe column
 * @method     ChildUtilisateurQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildUtilisateurQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildUtilisateurQuery groupByUtilisateurID() Group by the utilisateurId column
 * @method     ChildUtilisateurQuery groupByNom() Group by the nom column
 * @method     ChildUtilisateurQuery groupByLogin() Group by the login column
 * @method     ChildUtilisateurQuery groupByMotDePasse() Group by the mot_de_passe column
 * @method     ChildUtilisateurQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildUtilisateurQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildUtilisateurQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUtilisateurQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUtilisateurQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUtilisateurQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUtilisateurQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUtilisateurQuery leftJoinUserprestation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Userprestation relation
 * @method     ChildUtilisateurQuery rightJoinUserprestation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Userprestation relation
 * @method     ChildUtilisateurQuery innerJoinUserprestation($relationAlias = null) Adds a INNER JOIN clause to the query using the Userprestation relation
 *
 * @method     ChildUtilisateurQuery joinWithUserprestation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Userprestation relation
 *
 * @method     ChildUtilisateurQuery leftJoinWithUserprestation() Adds a LEFT JOIN clause and with to the query using the Userprestation relation
 * @method     ChildUtilisateurQuery rightJoinWithUserprestation() Adds a RIGHT JOIN clause and with to the query using the Userprestation relation
 * @method     ChildUtilisateurQuery innerJoinWithUserprestation() Adds a INNER JOIN clause and with to the query using the Userprestation relation
 *
 * @method     ChildUtilisateurQuery leftJoinDevi($relationAlias = null) Adds a LEFT JOIN clause to the query using the Devi relation
 * @method     ChildUtilisateurQuery rightJoinDevi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Devi relation
 * @method     ChildUtilisateurQuery innerJoinDevi($relationAlias = null) Adds a INNER JOIN clause to the query using the Devi relation
 *
 * @method     ChildUtilisateurQuery joinWithDevi($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Devi relation
 *
 * @method     ChildUtilisateurQuery leftJoinWithDevi() Adds a LEFT JOIN clause and with to the query using the Devi relation
 * @method     ChildUtilisateurQuery rightJoinWithDevi() Adds a RIGHT JOIN clause and with to the query using the Devi relation
 * @method     ChildUtilisateurQuery innerJoinWithDevi() Adds a INNER JOIN clause and with to the query using the Devi relation
 *
 * @method     \partner\UserprestationQuery|\partner\DeviQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUtilisateur findOne(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query
 * @method     ChildUtilisateur findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query, or a new ChildUtilisateur object populated from the query conditions when no match is found
 *
 * @method     ChildUtilisateur findOneByUtilisateurID(int $utilisateurId) Return the first ChildUtilisateur filtered by the utilisateurId column
 * @method     ChildUtilisateur findOneByNom(string $nom) Return the first ChildUtilisateur filtered by the nom column
 * @method     ChildUtilisateur findOneByLogin(string $login) Return the first ChildUtilisateur filtered by the login column
 * @method     ChildUtilisateur findOneByMotDePasse(string $mot_de_passe) Return the first ChildUtilisateur filtered by the mot_de_passe column
 * @method     ChildUtilisateur findOneByCreatedAt(string $created_at) Return the first ChildUtilisateur filtered by the created_at column
 * @method     ChildUtilisateur findOneByLastUpdated(string $last_updated) Return the first ChildUtilisateur filtered by the last_updated column *

 * @method     ChildUtilisateur requirePk($key, ConnectionInterface $con = null) Return the ChildUtilisateur by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOne(ConnectionInterface $con = null) Return the first ChildUtilisateur matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur requireOneByUtilisateurID(int $utilisateurId) Return the first ChildUtilisateur filtered by the utilisateurId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByNom(string $nom) Return the first ChildUtilisateur filtered by the nom column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByLogin(string $login) Return the first ChildUtilisateur filtered by the login column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByMotDePasse(string $mot_de_passe) Return the first ChildUtilisateur filtered by the mot_de_passe column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByCreatedAt(string $created_at) Return the first ChildUtilisateur filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUtilisateur requireOneByLastUpdated(string $last_updated) Return the first ChildUtilisateur filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUtilisateur[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUtilisateur objects based on current ModelCriteria
 * @method     ChildUtilisateur[]|ObjectCollection findByUtilisateurID(int $utilisateurId) Return ChildUtilisateur objects filtered by the utilisateurId column
 * @method     ChildUtilisateur[]|ObjectCollection findByNom(string $nom) Return ChildUtilisateur objects filtered by the nom column
 * @method     ChildUtilisateur[]|ObjectCollection findByLogin(string $login) Return ChildUtilisateur objects filtered by the login column
 * @method     ChildUtilisateur[]|ObjectCollection findByMotDePasse(string $mot_de_passe) Return ChildUtilisateur objects filtered by the mot_de_passe column
 * @method     ChildUtilisateur[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildUtilisateur objects filtered by the created_at column
 * @method     ChildUtilisateur[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildUtilisateur objects filtered by the last_updated column
 * @method     ChildUtilisateur[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UtilisateurQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\UtilisateurQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Utilisateur', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUtilisateurQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUtilisateurQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUtilisateurQuery) {
            return $criteria;
        }
        $query = new ChildUtilisateurQuery();
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
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UtilisateurTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUtilisateur A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT utilisateurId, nom, login, mot_de_passe, created_at, last_updated FROM utilisateurs WHERE utilisateurId = :p0';
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
            /** @var ChildUtilisateur $obj */
            $obj = new ChildUtilisateur();
            $obj->hydrate($row);
            UtilisateurTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUtilisateur|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the utilisateurId column
     *
     * Example usage:
     * <code>
     * $query->filterByUtilisateurID(1234); // WHERE utilisateurId = 1234
     * $query->filterByUtilisateurID(array(12, 34)); // WHERE utilisateurId IN (12, 34)
     * $query->filterByUtilisateurID(array('min' => 12)); // WHERE utilisateurId > 12
     * </code>
     *
     * @param     mixed $utilisateurID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByUtilisateurID($utilisateurID = null, $comparison = null)
    {
        if (is_array($utilisateurID)) {
            $useMinMax = false;
            if (isset($utilisateurID['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $utilisateurID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($utilisateurID['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $utilisateurID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $utilisateurID, $comparison);
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByNom($nom = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nom)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_NOM, $nom, $comparison);
    }

    /**
     * Filter the query on the login column
     *
     * Example usage:
     * <code>
     * $query->filterByLogin('fooValue');   // WHERE login = 'fooValue'
     * $query->filterByLogin('%fooValue%', Criteria::LIKE); // WHERE login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $login The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByLogin($login = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($login)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_LOGIN, $login, $comparison);
    }

    /**
     * Filter the query on the mot_de_passe column
     *
     * Example usage:
     * <code>
     * $query->filterByMotDePasse('fooValue');   // WHERE mot_de_passe = 'fooValue'
     * $query->filterByMotDePasse('%fooValue%', Criteria::LIKE); // WHERE mot_de_passe LIKE '%fooValue%'
     * </code>
     *
     * @param     string $motDePasse The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByMotDePasse($motDePasse = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($motDePasse)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_MOT_DE_PASSE, $motDePasse, $comparison);
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(UtilisateurTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UtilisateurTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Userprestation object
     *
     * @param \partner\Userprestation|ObjectCollection $userprestation the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByUserprestation($userprestation, $comparison = null)
    {
        if ($userprestation instanceof \partner\Userprestation) {
            return $this
                ->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $userprestation->getUtilisateurID(), $comparison);
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Devi object
     *
     * @param \partner\Devi|ObjectCollection $devi the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildUtilisateurQuery The current query, for fluid interface
     */
    public function filterByDevi($devi, $comparison = null)
    {
        if ($devi instanceof \partner\Devi) {
            return $this
                ->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $devi->getUtilisateurID(), $comparison);
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
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
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
     * @param   ChildUtilisateur $utilisateur Object to remove from the list of results
     *
     * @return $this|ChildUtilisateurQuery The current query, for fluid interface
     */
    public function prune($utilisateur = null)
    {
        if ($utilisateur) {
            $this->addUsingAlias(UtilisateurTableMap::COL_UTILISATEURID, $utilisateur->getUtilisateurID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the utilisateurs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UtilisateurTableMap::clearInstancePool();
            UtilisateurTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UtilisateurTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UtilisateurTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UtilisateurTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UtilisateurTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UtilisateurQuery
