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
use partner\Userprestation as ChildUserprestation;
use partner\UserprestationQuery as ChildUserprestationQuery;
use partner\Map\UserprestationTableMap;

/**
 * Base class that represents a query for the 'utilisateur_prestation' table.
 *
 *
 *
 * @method     ChildUserprestationQuery orderByUserPrestationID($order = Criteria::ASC) Order by the utilisateur_prestationId column
 * @method     ChildUserprestationQuery orderByPrestationID($order = Criteria::ASC) Order by the prestationId column
 * @method     ChildUserprestationQuery orderByUtilisateurID($order = Criteria::ASC) Order by the utilisateurId column
 *
 * @method     ChildUserprestationQuery groupByUserPrestationID() Group by the utilisateur_prestationId column
 * @method     ChildUserprestationQuery groupByPrestationID() Group by the prestationId column
 * @method     ChildUserprestationQuery groupByUtilisateurID() Group by the utilisateurId column
 *
 * @method     ChildUserprestationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserprestationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserprestationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserprestationQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserprestationQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserprestationQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserprestationQuery leftJoinPrestation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestation relation
 * @method     ChildUserprestationQuery rightJoinPrestation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestation relation
 * @method     ChildUserprestationQuery innerJoinPrestation($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestation relation
 *
 * @method     ChildUserprestationQuery joinWithPrestation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestation relation
 *
 * @method     ChildUserprestationQuery leftJoinWithPrestation() Adds a LEFT JOIN clause and with to the query using the Prestation relation
 * @method     ChildUserprestationQuery rightJoinWithPrestation() Adds a RIGHT JOIN clause and with to the query using the Prestation relation
 * @method     ChildUserprestationQuery innerJoinWithPrestation() Adds a INNER JOIN clause and with to the query using the Prestation relation
 *
 * @method     ChildUserprestationQuery leftJoinUtilisateur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Utilisateur relation
 * @method     ChildUserprestationQuery rightJoinUtilisateur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Utilisateur relation
 * @method     ChildUserprestationQuery innerJoinUtilisateur($relationAlias = null) Adds a INNER JOIN clause to the query using the Utilisateur relation
 *
 * @method     ChildUserprestationQuery joinWithUtilisateur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Utilisateur relation
 *
 * @method     ChildUserprestationQuery leftJoinWithUtilisateur() Adds a LEFT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildUserprestationQuery rightJoinWithUtilisateur() Adds a RIGHT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildUserprestationQuery innerJoinWithUtilisateur() Adds a INNER JOIN clause and with to the query using the Utilisateur relation
 *
 * @method     \partner\PrestationQuery|\partner\UtilisateurQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserprestation findOne(ConnectionInterface $con = null) Return the first ChildUserprestation matching the query
 * @method     ChildUserprestation findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserprestation matching the query, or a new ChildUserprestation object populated from the query conditions when no match is found
 *
 * @method     ChildUserprestation findOneByUserPrestationID(int $utilisateur_prestationId) Return the first ChildUserprestation filtered by the utilisateur_prestationId column
 * @method     ChildUserprestation findOneByPrestationID(int $prestationId) Return the first ChildUserprestation filtered by the prestationId column
 * @method     ChildUserprestation findOneByUtilisateurID(int $utilisateurId) Return the first ChildUserprestation filtered by the utilisateurId column *

 * @method     ChildUserprestation requirePk($key, ConnectionInterface $con = null) Return the ChildUserprestation by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserprestation requireOne(ConnectionInterface $con = null) Return the first ChildUserprestation matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserprestation requireOneByUserPrestationID(int $utilisateur_prestationId) Return the first ChildUserprestation filtered by the utilisateur_prestationId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserprestation requireOneByPrestationID(int $prestationId) Return the first ChildUserprestation filtered by the prestationId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserprestation requireOneByUtilisateurID(int $utilisateurId) Return the first ChildUserprestation filtered by the utilisateurId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserprestation[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserprestation objects based on current ModelCriteria
 * @method     ChildUserprestation[]|ObjectCollection findByUserPrestationID(int $utilisateur_prestationId) Return ChildUserprestation objects filtered by the utilisateur_prestationId column
 * @method     ChildUserprestation[]|ObjectCollection findByPrestationID(int $prestationId) Return ChildUserprestation objects filtered by the prestationId column
 * @method     ChildUserprestation[]|ObjectCollection findByUtilisateurID(int $utilisateurId) Return ChildUserprestation objects filtered by the utilisateurId column
 * @method     ChildUserprestation[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserprestationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\UserprestationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Userprestation', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserprestationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserprestationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserprestationQuery) {
            return $criteria;
        }
        $query = new ChildUserprestationQuery();
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
     * @return ChildUserprestation|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserprestationTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserprestationTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildUserprestation A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT utilisateur_prestationId, prestationId, utilisateurId FROM utilisateur_prestation WHERE utilisateur_prestationId = :p0';
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
            /** @var ChildUserprestation $obj */
            $obj = new ChildUserprestation();
            $obj->hydrate($row);
            UserprestationTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildUserprestation|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the utilisateur_prestationId column
     *
     * Example usage:
     * <code>
     * $query->filterByUserPrestationID(1234); // WHERE utilisateur_prestationId = 1234
     * $query->filterByUserPrestationID(array(12, 34)); // WHERE utilisateur_prestationId IN (12, 34)
     * $query->filterByUserPrestationID(array('min' => 12)); // WHERE utilisateur_prestationId > 12
     * </code>
     *
     * @param     mixed $userPrestationID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByUserPrestationID($userPrestationID = null, $comparison = null)
    {
        if (is_array($userPrestationID)) {
            $useMinMax = false;
            if (isset($userPrestationID['min'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $userPrestationID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userPrestationID['max'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $userPrestationID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $userPrestationID, $comparison);
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
     * @see       filterByPrestation()
     *
     * @param     mixed $prestationID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByPrestationID($prestationID = null, $comparison = null)
    {
        if (is_array($prestationID)) {
            $useMinMax = false;
            if (isset($prestationID['min'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_PRESTATIONID, $prestationID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prestationID['max'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_PRESTATIONID, $prestationID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserprestationTableMap::COL_PRESTATIONID, $prestationID, $comparison);
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
     * @see       filterByUtilisateur()
     *
     * @param     mixed $utilisateurID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByUtilisateurID($utilisateurID = null, $comparison = null)
    {
        if (is_array($utilisateurID)) {
            $useMinMax = false;
            if (isset($utilisateurID['min'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEURID, $utilisateurID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($utilisateurID['max'])) {
                $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEURID, $utilisateurID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEURID, $utilisateurID, $comparison);
    }

    /**
     * Filter the query by a related \partner\Prestation object
     *
     * @param \partner\Prestation|ObjectCollection $prestation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByPrestation($prestation, $comparison = null)
    {
        if ($prestation instanceof \partner\Prestation) {
            return $this
                ->addUsingAlias(UserprestationTableMap::COL_PRESTATIONID, $prestation->getPrestationID(), $comparison);
        } elseif ($prestation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserprestationTableMap::COL_PRESTATIONID, $prestation->toKeyValue('PrimaryKey', 'PrestationID'), $comparison);
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
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Utilisateur object
     *
     * @param \partner\Utilisateur|ObjectCollection $utilisateur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserprestationQuery The current query, for fluid interface
     */
    public function filterByUtilisateur($utilisateur, $comparison = null)
    {
        if ($utilisateur instanceof \partner\Utilisateur) {
            return $this
                ->addUsingAlias(UserprestationTableMap::COL_UTILISATEURID, $utilisateur->getUtilisateurID(), $comparison);
        } elseif ($utilisateur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserprestationTableMap::COL_UTILISATEURID, $utilisateur->toKeyValue('PrimaryKey', 'UtilisateurID'), $comparison);
        } else {
            throw new PropelException('filterByUtilisateur() only accepts arguments of type \partner\Utilisateur or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Utilisateur relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function joinUtilisateur($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Utilisateur');

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
            $this->addJoinObject($join, 'Utilisateur');
        }

        return $this;
    }

    /**
     * Use the Utilisateur relation Utilisateur object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \partner\UtilisateurQuery A secondary query class using the current class as primary query
     */
    public function useUtilisateurQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUtilisateur($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Utilisateur', '\partner\UtilisateurQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserprestation $userprestation Object to remove from the list of results
     *
     * @return $this|ChildUserprestationQuery The current query, for fluid interface
     */
    public function prune($userprestation = null)
    {
        if ($userprestation) {
            $this->addUsingAlias(UserprestationTableMap::COL_UTILISATEUR_PRESTATIONID, $userprestation->getUserPrestationID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the utilisateur_prestation table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserprestationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserprestationTableMap::clearInstancePool();
            UserprestationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserprestationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserprestationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserprestationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserprestationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserprestationQuery
