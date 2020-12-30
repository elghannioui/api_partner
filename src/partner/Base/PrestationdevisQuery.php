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
use partner\Prestationdevis as ChildPrestationdevis;
use partner\PrestationdevisQuery as ChildPrestationdevisQuery;
use partner\Map\PrestationdevisTableMap;

/**
 * Base class that represents a query for the 'prestation_devis' table.
 *
 *
 *
 * @method     ChildPrestationdevisQuery orderByPrestationdeviID($order = Criteria::ASC) Order by the prestationdeviId column
 * @method     ChildPrestationdevisQuery orderByPrixPrestation($order = Criteria::ASC) Order by the prix_prestation column
 * @method     ChildPrestationdevisQuery orderByQuantite($order = Criteria::ASC) Order by the quantite column
 * @method     ChildPrestationdevisQuery orderByPrestationID($order = Criteria::ASC) Order by the prestationId column
 * @method     ChildPrestationdevisQuery orderByDeviID($order = Criteria::ASC) Order by the deviId column
 *
 * @method     ChildPrestationdevisQuery groupByPrestationdeviID() Group by the prestationdeviId column
 * @method     ChildPrestationdevisQuery groupByPrixPrestation() Group by the prix_prestation column
 * @method     ChildPrestationdevisQuery groupByQuantite() Group by the quantite column
 * @method     ChildPrestationdevisQuery groupByPrestationID() Group by the prestationId column
 * @method     ChildPrestationdevisQuery groupByDeviID() Group by the deviId column
 *
 * @method     ChildPrestationdevisQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildPrestationdevisQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildPrestationdevisQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildPrestationdevisQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildPrestationdevisQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildPrestationdevisQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildPrestationdevisQuery leftJoinPrestation($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestation relation
 * @method     ChildPrestationdevisQuery rightJoinPrestation($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestation relation
 * @method     ChildPrestationdevisQuery innerJoinPrestation($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestation relation
 *
 * @method     ChildPrestationdevisQuery joinWithPrestation($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestation relation
 *
 * @method     ChildPrestationdevisQuery leftJoinWithPrestation() Adds a LEFT JOIN clause and with to the query using the Prestation relation
 * @method     ChildPrestationdevisQuery rightJoinWithPrestation() Adds a RIGHT JOIN clause and with to the query using the Prestation relation
 * @method     ChildPrestationdevisQuery innerJoinWithPrestation() Adds a INNER JOIN clause and with to the query using the Prestation relation
 *
 * @method     ChildPrestationdevisQuery leftJoinDevi($relationAlias = null) Adds a LEFT JOIN clause to the query using the Devi relation
 * @method     ChildPrestationdevisQuery rightJoinDevi($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Devi relation
 * @method     ChildPrestationdevisQuery innerJoinDevi($relationAlias = null) Adds a INNER JOIN clause to the query using the Devi relation
 *
 * @method     ChildPrestationdevisQuery joinWithDevi($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Devi relation
 *
 * @method     ChildPrestationdevisQuery leftJoinWithDevi() Adds a LEFT JOIN clause and with to the query using the Devi relation
 * @method     ChildPrestationdevisQuery rightJoinWithDevi() Adds a RIGHT JOIN clause and with to the query using the Devi relation
 * @method     ChildPrestationdevisQuery innerJoinWithDevi() Adds a INNER JOIN clause and with to the query using the Devi relation
 *
 * @method     \partner\PrestationQuery|\partner\DeviQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildPrestationdevis findOne(ConnectionInterface $con = null) Return the first ChildPrestationdevis matching the query
 * @method     ChildPrestationdevis findOneOrCreate(ConnectionInterface $con = null) Return the first ChildPrestationdevis matching the query, or a new ChildPrestationdevis object populated from the query conditions when no match is found
 *
 * @method     ChildPrestationdevis findOneByPrestationdeviID(int $prestationdeviId) Return the first ChildPrestationdevis filtered by the prestationdeviId column
 * @method     ChildPrestationdevis findOneByPrixPrestation(double $prix_prestation) Return the first ChildPrestationdevis filtered by the prix_prestation column
 * @method     ChildPrestationdevis findOneByQuantite(int $quantite) Return the first ChildPrestationdevis filtered by the quantite column
 * @method     ChildPrestationdevis findOneByPrestationID(int $prestationId) Return the first ChildPrestationdevis filtered by the prestationId column
 * @method     ChildPrestationdevis findOneByDeviID(int $deviId) Return the first ChildPrestationdevis filtered by the deviId column *

 * @method     ChildPrestationdevis requirePk($key, ConnectionInterface $con = null) Return the ChildPrestationdevis by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestationdevis requireOne(ConnectionInterface $con = null) Return the first ChildPrestationdevis matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestationdevis requireOneByPrestationdeviID(int $prestationdeviId) Return the first ChildPrestationdevis filtered by the prestationdeviId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestationdevis requireOneByPrixPrestation(double $prix_prestation) Return the first ChildPrestationdevis filtered by the prix_prestation column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestationdevis requireOneByQuantite(int $quantite) Return the first ChildPrestationdevis filtered by the quantite column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestationdevis requireOneByPrestationID(int $prestationId) Return the first ChildPrestationdevis filtered by the prestationId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildPrestationdevis requireOneByDeviID(int $deviId) Return the first ChildPrestationdevis filtered by the deviId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildPrestationdevis[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildPrestationdevis objects based on current ModelCriteria
 * @method     ChildPrestationdevis[]|ObjectCollection findByPrestationdeviID(int $prestationdeviId) Return ChildPrestationdevis objects filtered by the prestationdeviId column
 * @method     ChildPrestationdevis[]|ObjectCollection findByPrixPrestation(double $prix_prestation) Return ChildPrestationdevis objects filtered by the prix_prestation column
 * @method     ChildPrestationdevis[]|ObjectCollection findByQuantite(int $quantite) Return ChildPrestationdevis objects filtered by the quantite column
 * @method     ChildPrestationdevis[]|ObjectCollection findByPrestationID(int $prestationId) Return ChildPrestationdevis objects filtered by the prestationId column
 * @method     ChildPrestationdevis[]|ObjectCollection findByDeviID(int $deviId) Return ChildPrestationdevis objects filtered by the deviId column
 * @method     ChildPrestationdevis[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class PrestationdevisQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\PrestationdevisQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Prestationdevis', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildPrestationdevisQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildPrestationdevisQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildPrestationdevisQuery) {
            return $criteria;
        }
        $query = new ChildPrestationdevisQuery();
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
     * @return ChildPrestationdevis|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(PrestationdevisTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = PrestationdevisTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildPrestationdevis A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT prestationdeviId, prix_prestation, quantite, prestationId, deviId FROM prestation_devis WHERE prestationdeviId = :p0';
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
            /** @var ChildPrestationdevis $obj */
            $obj = new ChildPrestationdevis();
            $obj->hydrate($row);
            PrestationdevisTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildPrestationdevis|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the prestationdeviId column
     *
     * Example usage:
     * <code>
     * $query->filterByPrestationdeviID(1234); // WHERE prestationdeviId = 1234
     * $query->filterByPrestationdeviID(array(12, 34)); // WHERE prestationdeviId IN (12, 34)
     * $query->filterByPrestationdeviID(array('min' => 12)); // WHERE prestationdeviId > 12
     * </code>
     *
     * @param     mixed $prestationdeviID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrestationdeviID($prestationdeviID = null, $comparison = null)
    {
        if (is_array($prestationdeviID)) {
            $useMinMax = false;
            if (isset($prestationdeviID['min'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $prestationdeviID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prestationdeviID['max'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $prestationdeviID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $prestationdeviID, $comparison);
    }

    /**
     * Filter the query on the prix_prestation column
     *
     * Example usage:
     * <code>
     * $query->filterByPrixPrestation(1234); // WHERE prix_prestation = 1234
     * $query->filterByPrixPrestation(array(12, 34)); // WHERE prix_prestation IN (12, 34)
     * $query->filterByPrixPrestation(array('min' => 12)); // WHERE prix_prestation > 12
     * </code>
     *
     * @param     mixed $prixPrestation The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrixPrestation($prixPrestation = null, $comparison = null)
    {
        if (is_array($prixPrestation)) {
            $useMinMax = false;
            if (isset($prixPrestation['min'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRIX_PRESTATION, $prixPrestation['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prixPrestation['max'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRIX_PRESTATION, $prixPrestation['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationdevisTableMap::COL_PRIX_PRESTATION, $prixPrestation, $comparison);
    }

    /**
     * Filter the query on the quantite column
     *
     * Example usage:
     * <code>
     * $query->filterByQuantite(1234); // WHERE quantite = 1234
     * $query->filterByQuantite(array(12, 34)); // WHERE quantite IN (12, 34)
     * $query->filterByQuantite(array('min' => 12)); // WHERE quantite > 12
     * </code>
     *
     * @param     mixed $quantite The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByQuantite($quantite = null, $comparison = null)
    {
        if (is_array($quantite)) {
            $useMinMax = false;
            if (isset($quantite['min'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_QUANTITE, $quantite['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($quantite['max'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_QUANTITE, $quantite['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationdevisTableMap::COL_QUANTITE, $quantite, $comparison);
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
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrestationID($prestationID = null, $comparison = null)
    {
        if (is_array($prestationID)) {
            $useMinMax = false;
            if (isset($prestationID['min'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONID, $prestationID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($prestationID['max'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONID, $prestationID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONID, $prestationID, $comparison);
    }

    /**
     * Filter the query on the deviId column
     *
     * Example usage:
     * <code>
     * $query->filterByDeviID(1234); // WHERE deviId = 1234
     * $query->filterByDeviID(array(12, 34)); // WHERE deviId IN (12, 34)
     * $query->filterByDeviID(array('min' => 12)); // WHERE deviId > 12
     * </code>
     *
     * @see       filterByDevi()
     *
     * @param     mixed $deviID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByDeviID($deviID = null, $comparison = null)
    {
        if (is_array($deviID)) {
            $useMinMax = false;
            if (isset($deviID['min'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_DEVIID, $deviID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviID['max'])) {
                $this->addUsingAlias(PrestationdevisTableMap::COL_DEVIID, $deviID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PrestationdevisTableMap::COL_DEVIID, $deviID, $comparison);
    }

    /**
     * Filter the query by a related \partner\Prestation object
     *
     * @param \partner\Prestation|ObjectCollection $prestation The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByPrestation($prestation, $comparison = null)
    {
        if ($prestation instanceof \partner\Prestation) {
            return $this
                ->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONID, $prestation->getPrestationID(), $comparison);
        } elseif ($prestation instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONID, $prestation->toKeyValue('PrimaryKey', 'PrestationID'), $comparison);
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
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Devi object
     *
     * @param \partner\Devi|ObjectCollection $devi The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function filterByDevi($devi, $comparison = null)
    {
        if ($devi instanceof \partner\Devi) {
            return $this
                ->addUsingAlias(PrestationdevisTableMap::COL_DEVIID, $devi->getDeviID(), $comparison);
        } elseif ($devi instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PrestationdevisTableMap::COL_DEVIID, $devi->toKeyValue('PrimaryKey', 'DeviID'), $comparison);
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
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
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
     * @param   ChildPrestationdevis $prestationdevis Object to remove from the list of results
     *
     * @return $this|ChildPrestationdevisQuery The current query, for fluid interface
     */
    public function prune($prestationdevis = null)
    {
        if ($prestationdevis) {
            $this->addUsingAlias(PrestationdevisTableMap::COL_PRESTATIONDEVIID, $prestationdevis->getPrestationdeviID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the prestation_devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationdevisTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            PrestationdevisTableMap::clearInstancePool();
            PrestationdevisTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationdevisTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(PrestationdevisTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            PrestationdevisTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            PrestationdevisTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // PrestationdevisQuery
