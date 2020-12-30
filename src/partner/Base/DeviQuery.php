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
use partner\Devi as ChildDevi;
use partner\DeviQuery as ChildDeviQuery;
use partner\Map\DeviTableMap;

/**
 * Base class that represents a query for the 'devis' table.
 *
 *
 *
 * @method     ChildDeviQuery orderByDeviID($order = Criteria::ASC) Order by the deviId column
 * @method     ChildDeviQuery orderByDateCommande($order = Criteria::ASC) Order by the date_commande column
 * @method     ChildDeviQuery orderByDateIntervention($order = Criteria::ASC) Order by the date_intervention column
 * @method     ChildDeviQuery orderByDateDebutIntervention($order = Criteria::ASC) Order by the date_debut_intevention column
 * @method     ChildDeviQuery orderByDateFinIntervention($order = Criteria::ASC) Order by the date_fin_intevention column
 * @method     ChildDeviQuery orderByModePaiement($order = Criteria::ASC) Order by the mode_paiement column
 * @method     ChildDeviQuery orderByStatut($order = Criteria::ASC) Order by the statut column
 * @method     ChildDeviQuery orderByMontant($order = Criteria::ASC) Order by the montant column
 * @method     ChildDeviQuery orderByClientID($order = Criteria::ASC) Order by the clientId column
 * @method     ChildDeviQuery orderByCoordinateurID($order = Criteria::ASC) Order by the coordinateurId column
 * @method     ChildDeviQuery orderByUtilisateurID($order = Criteria::ASC) Order by the utilisateurId column
 * @method     ChildDeviQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildDeviQuery orderByLastUpdated($order = Criteria::ASC) Order by the last_updated column
 *
 * @method     ChildDeviQuery groupByDeviID() Group by the deviId column
 * @method     ChildDeviQuery groupByDateCommande() Group by the date_commande column
 * @method     ChildDeviQuery groupByDateIntervention() Group by the date_intervention column
 * @method     ChildDeviQuery groupByDateDebutIntervention() Group by the date_debut_intevention column
 * @method     ChildDeviQuery groupByDateFinIntervention() Group by the date_fin_intevention column
 * @method     ChildDeviQuery groupByModePaiement() Group by the mode_paiement column
 * @method     ChildDeviQuery groupByStatut() Group by the statut column
 * @method     ChildDeviQuery groupByMontant() Group by the montant column
 * @method     ChildDeviQuery groupByClientID() Group by the clientId column
 * @method     ChildDeviQuery groupByCoordinateurID() Group by the coordinateurId column
 * @method     ChildDeviQuery groupByUtilisateurID() Group by the utilisateurId column
 * @method     ChildDeviQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildDeviQuery groupByLastUpdated() Group by the last_updated column
 *
 * @method     ChildDeviQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildDeviQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildDeviQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildDeviQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildDeviQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildDeviQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildDeviQuery leftJoinClient($relationAlias = null) Adds a LEFT JOIN clause to the query using the Client relation
 * @method     ChildDeviQuery rightJoinClient($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Client relation
 * @method     ChildDeviQuery innerJoinClient($relationAlias = null) Adds a INNER JOIN clause to the query using the Client relation
 *
 * @method     ChildDeviQuery joinWithClient($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Client relation
 *
 * @method     ChildDeviQuery leftJoinWithClient() Adds a LEFT JOIN clause and with to the query using the Client relation
 * @method     ChildDeviQuery rightJoinWithClient() Adds a RIGHT JOIN clause and with to the query using the Client relation
 * @method     ChildDeviQuery innerJoinWithClient() Adds a INNER JOIN clause and with to the query using the Client relation
 *
 * @method     ChildDeviQuery leftJoinUtilisateur($relationAlias = null) Adds a LEFT JOIN clause to the query using the Utilisateur relation
 * @method     ChildDeviQuery rightJoinUtilisateur($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Utilisateur relation
 * @method     ChildDeviQuery innerJoinUtilisateur($relationAlias = null) Adds a INNER JOIN clause to the query using the Utilisateur relation
 *
 * @method     ChildDeviQuery joinWithUtilisateur($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Utilisateur relation
 *
 * @method     ChildDeviQuery leftJoinWithUtilisateur() Adds a LEFT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildDeviQuery rightJoinWithUtilisateur() Adds a RIGHT JOIN clause and with to the query using the Utilisateur relation
 * @method     ChildDeviQuery innerJoinWithUtilisateur() Adds a INNER JOIN clause and with to the query using the Utilisateur relation
 *
 * @method     ChildDeviQuery leftJoinPrestationdevis($relationAlias = null) Adds a LEFT JOIN clause to the query using the Prestationdevis relation
 * @method     ChildDeviQuery rightJoinPrestationdevis($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Prestationdevis relation
 * @method     ChildDeviQuery innerJoinPrestationdevis($relationAlias = null) Adds a INNER JOIN clause to the query using the Prestationdevis relation
 *
 * @method     ChildDeviQuery joinWithPrestationdevis($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Prestationdevis relation
 *
 * @method     ChildDeviQuery leftJoinWithPrestationdevis() Adds a LEFT JOIN clause and with to the query using the Prestationdevis relation
 * @method     ChildDeviQuery rightJoinWithPrestationdevis() Adds a RIGHT JOIN clause and with to the query using the Prestationdevis relation
 * @method     ChildDeviQuery innerJoinWithPrestationdevis() Adds a INNER JOIN clause and with to the query using the Prestationdevis relation
 *
 * @method     \partner\ClientQuery|\partner\UtilisateurQuery|\partner\PrestationdevisQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildDevi findOne(ConnectionInterface $con = null) Return the first ChildDevi matching the query
 * @method     ChildDevi findOneOrCreate(ConnectionInterface $con = null) Return the first ChildDevi matching the query, or a new ChildDevi object populated from the query conditions when no match is found
 *
 * @method     ChildDevi findOneByDeviID(int $deviId) Return the first ChildDevi filtered by the deviId column
 * @method     ChildDevi findOneByDateCommande(string $date_commande) Return the first ChildDevi filtered by the date_commande column
 * @method     ChildDevi findOneByDateIntervention(string $date_intervention) Return the first ChildDevi filtered by the date_intervention column
 * @method     ChildDevi findOneByDateDebutIntervention(string $date_debut_intevention) Return the first ChildDevi filtered by the date_debut_intevention column
 * @method     ChildDevi findOneByDateFinIntervention(string $date_fin_intevention) Return the first ChildDevi filtered by the date_fin_intevention column
 * @method     ChildDevi findOneByModePaiement(int $mode_paiement) Return the first ChildDevi filtered by the mode_paiement column
 * @method     ChildDevi findOneByStatut(int $statut) Return the first ChildDevi filtered by the statut column
 * @method     ChildDevi findOneByMontant(double $montant) Return the first ChildDevi filtered by the montant column
 * @method     ChildDevi findOneByClientID(int $clientId) Return the first ChildDevi filtered by the clientId column
 * @method     ChildDevi findOneByCoordinateurID(int $coordinateurId) Return the first ChildDevi filtered by the coordinateurId column
 * @method     ChildDevi findOneByUtilisateurID(int $utilisateurId) Return the first ChildDevi filtered by the utilisateurId column
 * @method     ChildDevi findOneByCreatedAt(string $created_at) Return the first ChildDevi filtered by the created_at column
 * @method     ChildDevi findOneByLastUpdated(string $last_updated) Return the first ChildDevi filtered by the last_updated column *

 * @method     ChildDevi requirePk($key, ConnectionInterface $con = null) Return the ChildDevi by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOne(ConnectionInterface $con = null) Return the first ChildDevi matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDevi requireOneByDeviID(int $deviId) Return the first ChildDevi filtered by the deviId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByDateCommande(string $date_commande) Return the first ChildDevi filtered by the date_commande column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByDateIntervention(string $date_intervention) Return the first ChildDevi filtered by the date_intervention column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByDateDebutIntervention(string $date_debut_intevention) Return the first ChildDevi filtered by the date_debut_intevention column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByDateFinIntervention(string $date_fin_intevention) Return the first ChildDevi filtered by the date_fin_intevention column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByModePaiement(int $mode_paiement) Return the first ChildDevi filtered by the mode_paiement column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByStatut(int $statut) Return the first ChildDevi filtered by the statut column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByMontant(double $montant) Return the first ChildDevi filtered by the montant column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByClientID(int $clientId) Return the first ChildDevi filtered by the clientId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByCoordinateurID(int $coordinateurId) Return the first ChildDevi filtered by the coordinateurId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByUtilisateurID(int $utilisateurId) Return the first ChildDevi filtered by the utilisateurId column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByCreatedAt(string $created_at) Return the first ChildDevi filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildDevi requireOneByLastUpdated(string $last_updated) Return the first ChildDevi filtered by the last_updated column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildDevi[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildDevi objects based on current ModelCriteria
 * @method     ChildDevi[]|ObjectCollection findByDeviID(int $deviId) Return ChildDevi objects filtered by the deviId column
 * @method     ChildDevi[]|ObjectCollection findByDateCommande(string $date_commande) Return ChildDevi objects filtered by the date_commande column
 * @method     ChildDevi[]|ObjectCollection findByDateIntervention(string $date_intervention) Return ChildDevi objects filtered by the date_intervention column
 * @method     ChildDevi[]|ObjectCollection findByDateDebutIntervention(string $date_debut_intevention) Return ChildDevi objects filtered by the date_debut_intevention column
 * @method     ChildDevi[]|ObjectCollection findByDateFinIntervention(string $date_fin_intevention) Return ChildDevi objects filtered by the date_fin_intevention column
 * @method     ChildDevi[]|ObjectCollection findByModePaiement(int $mode_paiement) Return ChildDevi objects filtered by the mode_paiement column
 * @method     ChildDevi[]|ObjectCollection findByStatut(int $statut) Return ChildDevi objects filtered by the statut column
 * @method     ChildDevi[]|ObjectCollection findByMontant(double $montant) Return ChildDevi objects filtered by the montant column
 * @method     ChildDevi[]|ObjectCollection findByClientID(int $clientId) Return ChildDevi objects filtered by the clientId column
 * @method     ChildDevi[]|ObjectCollection findByCoordinateurID(int $coordinateurId) Return ChildDevi objects filtered by the coordinateurId column
 * @method     ChildDevi[]|ObjectCollection findByUtilisateurID(int $utilisateurId) Return ChildDevi objects filtered by the utilisateurId column
 * @method     ChildDevi[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildDevi objects filtered by the created_at column
 * @method     ChildDevi[]|ObjectCollection findByLastUpdated(string $last_updated) Return ChildDevi objects filtered by the last_updated column
 * @method     ChildDevi[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class DeviQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \partner\Base\DeviQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\partner\\Devi', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildDeviQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildDeviQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildDeviQuery) {
            return $criteria;
        }
        $query = new ChildDeviQuery();
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
     * @return ChildDevi|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(DeviTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = DeviTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildDevi A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT deviId, date_commande, date_intervention, date_debut_intevention, date_fin_intevention, mode_paiement, statut, montant, clientId, coordinateurId, utilisateurId, created_at, last_updated FROM devis WHERE deviId = :p0';
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
            /** @var ChildDevi $obj */
            $obj = new ChildDevi();
            $obj->hydrate($row);
            DeviTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildDevi|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(DeviTableMap::COL_DEVIID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(DeviTableMap::COL_DEVIID, $keys, Criteria::IN);
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
     * @param     mixed $deviID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByDeviID($deviID = null, $comparison = null)
    {
        if (is_array($deviID)) {
            $useMinMax = false;
            if (isset($deviID['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_DEVIID, $deviID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($deviID['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_DEVIID, $deviID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_DEVIID, $deviID, $comparison);
    }

    /**
     * Filter the query on the date_commande column
     *
     * Example usage:
     * <code>
     * $query->filterByDateCommande('2011-03-14'); // WHERE date_commande = '2011-03-14'
     * $query->filterByDateCommande('now'); // WHERE date_commande = '2011-03-14'
     * $query->filterByDateCommande(array('max' => 'yesterday')); // WHERE date_commande > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateCommande The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByDateCommande($dateCommande = null, $comparison = null)
    {
        if (is_array($dateCommande)) {
            $useMinMax = false;
            if (isset($dateCommande['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_COMMANDE, $dateCommande['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateCommande['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_COMMANDE, $dateCommande['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_DATE_COMMANDE, $dateCommande, $comparison);
    }

    /**
     * Filter the query on the date_intervention column
     *
     * Example usage:
     * <code>
     * $query->filterByDateIntervention('2011-03-14'); // WHERE date_intervention = '2011-03-14'
     * $query->filterByDateIntervention('now'); // WHERE date_intervention = '2011-03-14'
     * $query->filterByDateIntervention(array('max' => 'yesterday')); // WHERE date_intervention > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateIntervention The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByDateIntervention($dateIntervention = null, $comparison = null)
    {
        if (is_array($dateIntervention)) {
            $useMinMax = false;
            if (isset($dateIntervention['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_INTERVENTION, $dateIntervention['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateIntervention['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_INTERVENTION, $dateIntervention['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_DATE_INTERVENTION, $dateIntervention, $comparison);
    }

    /**
     * Filter the query on the date_debut_intevention column
     *
     * Example usage:
     * <code>
     * $query->filterByDateDebutIntervention('2011-03-14'); // WHERE date_debut_intevention = '2011-03-14'
     * $query->filterByDateDebutIntervention('now'); // WHERE date_debut_intevention = '2011-03-14'
     * $query->filterByDateDebutIntervention(array('max' => 'yesterday')); // WHERE date_debut_intevention > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateDebutIntervention The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByDateDebutIntervention($dateDebutIntervention = null, $comparison = null)
    {
        if (is_array($dateDebutIntervention)) {
            $useMinMax = false;
            if (isset($dateDebutIntervention['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_DEBUT_INTEVENTION, $dateDebutIntervention['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateDebutIntervention['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_DEBUT_INTEVENTION, $dateDebutIntervention['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_DATE_DEBUT_INTEVENTION, $dateDebutIntervention, $comparison);
    }

    /**
     * Filter the query on the date_fin_intevention column
     *
     * Example usage:
     * <code>
     * $query->filterByDateFinIntervention('2011-03-14'); // WHERE date_fin_intevention = '2011-03-14'
     * $query->filterByDateFinIntervention('now'); // WHERE date_fin_intevention = '2011-03-14'
     * $query->filterByDateFinIntervention(array('max' => 'yesterday')); // WHERE date_fin_intevention > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateFinIntervention The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByDateFinIntervention($dateFinIntervention = null, $comparison = null)
    {
        if (is_array($dateFinIntervention)) {
            $useMinMax = false;
            if (isset($dateFinIntervention['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_FIN_INTEVENTION, $dateFinIntervention['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateFinIntervention['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_DATE_FIN_INTEVENTION, $dateFinIntervention['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_DATE_FIN_INTEVENTION, $dateFinIntervention, $comparison);
    }

    /**
     * Filter the query on the mode_paiement column
     *
     * @param     mixed $modePaiement The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByModePaiement($modePaiement = null, $comparison = null)
    {
        $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_MODE_PAIEMENT);
        if (is_scalar($modePaiement)) {
            if (!in_array($modePaiement, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $modePaiement));
            }
            $modePaiement = array_search($modePaiement, $valueSet);
        } elseif (is_array($modePaiement)) {
            $convertedValues = array();
            foreach ($modePaiement as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $modePaiement = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_MODE_PAIEMENT, $modePaiement, $comparison);
    }

    /**
     * Filter the query on the statut column
     *
     * @param     mixed $statut The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByStatut($statut = null, $comparison = null)
    {
        $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_STATUT);
        if (is_scalar($statut)) {
            if (!in_array($statut, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $statut));
            }
            $statut = array_search($statut, $valueSet);
        } elseif (is_array($statut)) {
            $convertedValues = array();
            foreach ($statut as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $statut = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_STATUT, $statut, $comparison);
    }

    /**
     * Filter the query on the montant column
     *
     * Example usage:
     * <code>
     * $query->filterByMontant(1234); // WHERE montant = 1234
     * $query->filterByMontant(array(12, 34)); // WHERE montant IN (12, 34)
     * $query->filterByMontant(array('min' => 12)); // WHERE montant > 12
     * </code>
     *
     * @param     mixed $montant The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByMontant($montant = null, $comparison = null)
    {
        if (is_array($montant)) {
            $useMinMax = false;
            if (isset($montant['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_MONTANT, $montant['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($montant['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_MONTANT, $montant['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_MONTANT, $montant, $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByClientID($clientID = null, $comparison = null)
    {
        if (is_array($clientID)) {
            $useMinMax = false;
            if (isset($clientID['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_CLIENTID, $clientID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($clientID['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_CLIENTID, $clientID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_CLIENTID, $clientID, $comparison);
    }

    /**
     * Filter the query on the coordinateurId column
     *
     * Example usage:
     * <code>
     * $query->filterByCoordinateurID(1234); // WHERE coordinateurId = 1234
     * $query->filterByCoordinateurID(array(12, 34)); // WHERE coordinateurId IN (12, 34)
     * $query->filterByCoordinateurID(array('min' => 12)); // WHERE coordinateurId > 12
     * </code>
     *
     * @param     mixed $coordinateurID The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByCoordinateurID($coordinateurID = null, $comparison = null)
    {
        if (is_array($coordinateurID)) {
            $useMinMax = false;
            if (isset($coordinateurID['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_COORDINATEURID, $coordinateurID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($coordinateurID['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_COORDINATEURID, $coordinateurID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_COORDINATEURID, $coordinateurID, $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByUtilisateurID($utilisateurID = null, $comparison = null)
    {
        if (is_array($utilisateurID)) {
            $useMinMax = false;
            if (isset($utilisateurID['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_UTILISATEURID, $utilisateurID['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($utilisateurID['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_UTILISATEURID, $utilisateurID['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_UTILISATEURID, $utilisateurID, $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function filterByLastUpdated($lastUpdated = null, $comparison = null)
    {
        if (is_array($lastUpdated)) {
            $useMinMax = false;
            if (isset($lastUpdated['min'])) {
                $this->addUsingAlias(DeviTableMap::COL_LAST_UPDATED, $lastUpdated['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lastUpdated['max'])) {
                $this->addUsingAlias(DeviTableMap::COL_LAST_UPDATED, $lastUpdated['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(DeviTableMap::COL_LAST_UPDATED, $lastUpdated, $comparison);
    }

    /**
     * Filter the query by a related \partner\Client object
     *
     * @param \partner\Client|ObjectCollection $client The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeviQuery The current query, for fluid interface
     */
    public function filterByClient($client, $comparison = null)
    {
        if ($client instanceof \partner\Client) {
            return $this
                ->addUsingAlias(DeviTableMap::COL_CLIENTID, $client->getClientID(), $comparison);
        } elseif ($client instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeviTableMap::COL_CLIENTID, $client->toKeyValue('PrimaryKey', 'ClientID'), $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Utilisateur object
     *
     * @param \partner\Utilisateur|ObjectCollection $utilisateur The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildDeviQuery The current query, for fluid interface
     */
    public function filterByUtilisateur($utilisateur, $comparison = null)
    {
        if ($utilisateur instanceof \partner\Utilisateur) {
            return $this
                ->addUsingAlias(DeviTableMap::COL_UTILISATEURID, $utilisateur->getUtilisateurID(), $comparison);
        } elseif ($utilisateur instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(DeviTableMap::COL_UTILISATEURID, $utilisateur->toKeyValue('PrimaryKey', 'UtilisateurID'), $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
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
     * Filter the query by a related \partner\Prestationdevis object
     *
     * @param \partner\Prestationdevis|ObjectCollection $prestationdevis the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildDeviQuery The current query, for fluid interface
     */
    public function filterByPrestationdevis($prestationdevis, $comparison = null)
    {
        if ($prestationdevis instanceof \partner\Prestationdevis) {
            return $this
                ->addUsingAlias(DeviTableMap::COL_DEVIID, $prestationdevis->getDeviID(), $comparison);
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
     * @return $this|ChildDeviQuery The current query, for fluid interface
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
     * @param   ChildDevi $devi Object to remove from the list of results
     *
     * @return $this|ChildDeviQuery The current query, for fluid interface
     */
    public function prune($devi = null)
    {
        if ($devi) {
            $this->addUsingAlias(DeviTableMap::COL_DEVIID, $devi->getDeviID(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            DeviTableMap::clearInstancePool();
            DeviTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(DeviTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            DeviTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            DeviTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // DeviQuery
