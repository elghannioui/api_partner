<?php

namespace partner\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use partner\Devi;
use partner\DeviQuery;


/**
 * This class defines the structure of the 'devis' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class DeviTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.DeviTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'devis';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Devi';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Devi';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the deviId field
     */
    const COL_DEVIID = 'devis.deviId';

    /**
     * the column name for the date_commande field
     */
    const COL_DATE_COMMANDE = 'devis.date_commande';

    /**
     * the column name for the date_intervention field
     */
    const COL_DATE_INTERVENTION = 'devis.date_intervention';

    /**
     * the column name for the date_debut_intevention field
     */
    const COL_DATE_DEBUT_INTEVENTION = 'devis.date_debut_intevention';

    /**
     * the column name for the date_fin_intevention field
     */
    const COL_DATE_FIN_INTEVENTION = 'devis.date_fin_intevention';

    /**
     * the column name for the mode_paiement field
     */
    const COL_MODE_PAIEMENT = 'devis.mode_paiement';

    /**
     * the column name for the statut field
     */
    const COL_STATUT = 'devis.statut';

    /**
     * the column name for the montant field
     */
    const COL_MONTANT = 'devis.montant';

    /**
     * the column name for the clientId field
     */
    const COL_CLIENTID = 'devis.clientId';

    /**
     * the column name for the coordinateurId field
     */
    const COL_COORDINATEURID = 'devis.coordinateurId';

    /**
     * the column name for the utilisateurId field
     */
    const COL_UTILISATEURID = 'devis.utilisateurId';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'devis.created_at';

    /**
     * the column name for the last_updated field
     */
    const COL_LAST_UPDATED = 'devis.last_updated';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the mode_paiement field */
    const COL_MODE_PAIEMENT_CHEQUE = 'cheque';
    const COL_MODE_PAIEMENT_ESPECE = 'espece';
    const COL_MODE_PAIEMENT_ENLIGNE = 'enligne';

    /** The enumerated values for the statut field */
    const COL_STATUT_ENATTENTE = 'EnAttente';
    const COL_STATUT_ENCOURS = 'EnCours';
    const COL_STATUT_VALIDE = 'Valide';
    const COL_STATUT_PAYE = 'paye';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('DeviID', 'DateCommande', 'DateIntervention', 'DateDebutIntervention', 'DateFinIntervention', 'ModePaiement', 'Statut', 'Montant', 'ClientID', 'CoordinateurID', 'UtilisateurID', 'CreatedAt', 'LastUpdated', ),
        self::TYPE_CAMELNAME     => array('deviID', 'dateCommande', 'dateIntervention', 'dateDebutIntervention', 'dateFinIntervention', 'modePaiement', 'statut', 'montant', 'clientID', 'coordinateurID', 'utilisateurID', 'createdAt', 'lastUpdated', ),
        self::TYPE_COLNAME       => array(DeviTableMap::COL_DEVIID, DeviTableMap::COL_DATE_COMMANDE, DeviTableMap::COL_DATE_INTERVENTION, DeviTableMap::COL_DATE_DEBUT_INTEVENTION, DeviTableMap::COL_DATE_FIN_INTEVENTION, DeviTableMap::COL_MODE_PAIEMENT, DeviTableMap::COL_STATUT, DeviTableMap::COL_MONTANT, DeviTableMap::COL_CLIENTID, DeviTableMap::COL_COORDINATEURID, DeviTableMap::COL_UTILISATEURID, DeviTableMap::COL_CREATED_AT, DeviTableMap::COL_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('deviId', 'date_commande', 'date_intervention', 'date_debut_intevention', 'date_fin_intevention', 'mode_paiement', 'statut', 'montant', 'clientId', 'coordinateurId', 'utilisateurId', 'created_at', 'last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('DeviID' => 0, 'DateCommande' => 1, 'DateIntervention' => 2, 'DateDebutIntervention' => 3, 'DateFinIntervention' => 4, 'ModePaiement' => 5, 'Statut' => 6, 'Montant' => 7, 'ClientID' => 8, 'CoordinateurID' => 9, 'UtilisateurID' => 10, 'CreatedAt' => 11, 'LastUpdated' => 12, ),
        self::TYPE_CAMELNAME     => array('deviID' => 0, 'dateCommande' => 1, 'dateIntervention' => 2, 'dateDebutIntervention' => 3, 'dateFinIntervention' => 4, 'modePaiement' => 5, 'statut' => 6, 'montant' => 7, 'clientID' => 8, 'coordinateurID' => 9, 'utilisateurID' => 10, 'createdAt' => 11, 'lastUpdated' => 12, ),
        self::TYPE_COLNAME       => array(DeviTableMap::COL_DEVIID => 0, DeviTableMap::COL_DATE_COMMANDE => 1, DeviTableMap::COL_DATE_INTERVENTION => 2, DeviTableMap::COL_DATE_DEBUT_INTEVENTION => 3, DeviTableMap::COL_DATE_FIN_INTEVENTION => 4, DeviTableMap::COL_MODE_PAIEMENT => 5, DeviTableMap::COL_STATUT => 6, DeviTableMap::COL_MONTANT => 7, DeviTableMap::COL_CLIENTID => 8, DeviTableMap::COL_COORDINATEURID => 9, DeviTableMap::COL_UTILISATEURID => 10, DeviTableMap::COL_CREATED_AT => 11, DeviTableMap::COL_LAST_UPDATED => 12, ),
        self::TYPE_FIELDNAME     => array('deviId' => 0, 'date_commande' => 1, 'date_intervention' => 2, 'date_debut_intevention' => 3, 'date_fin_intevention' => 4, 'mode_paiement' => 5, 'statut' => 6, 'montant' => 7, 'clientId' => 8, 'coordinateurId' => 9, 'utilisateurId' => 10, 'created_at' => 11, 'last_updated' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                DeviTableMap::COL_MODE_PAIEMENT => array(
                            self::COL_MODE_PAIEMENT_CHEQUE,
            self::COL_MODE_PAIEMENT_ESPECE,
            self::COL_MODE_PAIEMENT_ENLIGNE,
        ),
                DeviTableMap::COL_STATUT => array(
                            self::COL_STATUT_ENATTENTE,
            self::COL_STATUT_ENCOURS,
            self::COL_STATUT_VALIDE,
            self::COL_STATUT_PAYE,
        ),
    );

    /**
     * Gets the list of values for all ENUM and SET columns
     * @return array
     */
    public static function getValueSets()
    {
      return static::$enumValueSets;
    }

    /**
     * Gets the list of values for an ENUM or SET column
     * @param string $colname
     * @return array list of possible values for the column
     */
    public static function getValueSet($colname)
    {
        $valueSets = self::getValueSets();

        return $valueSets[$colname];
    }

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('devis');
        $this->setPhpName('Devi');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Devi');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('deviId', 'DeviID', 'INTEGER', true, null, null);
        $this->addColumn('date_commande', 'DateCommande', 'DATE', false, null, null);
        $this->addColumn('date_intervention', 'DateIntervention', 'DATE', false, null, null);
        $this->addColumn('date_debut_intevention', 'DateDebutIntervention', 'TIMESTAMP', false, null, null);
        $this->addColumn('date_fin_intevention', 'DateFinIntervention', 'DATE', false, null, null);
        $this->addColumn('mode_paiement', 'ModePaiement', 'ENUM', false, null, 'espece');
        $this->getColumn('mode_paiement')->setValueSet(array (
  0 => 'cheque',
  1 => 'espece',
  2 => 'enligne',
));
        $this->addColumn('statut', 'Statut', 'ENUM', true, null, 'EnAttente');
        $this->getColumn('statut')->setValueSet(array (
  0 => 'EnAttente',
  1 => 'EnCours',
  2 => 'Valide',
  3 => 'paye',
));
        $this->addColumn('montant', 'Montant', 'DOUBLE', false, null, null);
        $this->addForeignKey('clientId', 'ClientID', 'INTEGER', 'clients', 'clientId', true, null, null);
        $this->addColumn('coordinateurId', 'CoordinateurID', 'INTEGER', false, null, null);
        $this->addForeignKey('utilisateurId', 'UtilisateurID', 'INTEGER', 'utilisateurs', 'utilisateurId', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_updated', 'LastUpdated', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Client', '\\partner\\Client', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':clientId',
    1 => ':clientId',
  ),
), null, null, null, false);
        $this->addRelation('Utilisateur', '\\partner\\Utilisateur', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':utilisateurId',
    1 => ':utilisateurId',
  ),
), null, null, null, false);
        $this->addRelation('Prestationdevis', '\\partner\\Prestationdevis', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':deviId',
    1 => ':deviId',
  ),
), null, null, 'Prestationdeviss', false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? DeviTableMap::CLASS_DEFAULT : DeviTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Devi object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = DeviTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = DeviTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + DeviTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = DeviTableMap::OM_CLASS;
            /** @var Devi $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            DeviTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = DeviTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = DeviTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Devi $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                DeviTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(DeviTableMap::COL_DEVIID);
            $criteria->addSelectColumn(DeviTableMap::COL_DATE_COMMANDE);
            $criteria->addSelectColumn(DeviTableMap::COL_DATE_INTERVENTION);
            $criteria->addSelectColumn(DeviTableMap::COL_DATE_DEBUT_INTEVENTION);
            $criteria->addSelectColumn(DeviTableMap::COL_DATE_FIN_INTEVENTION);
            $criteria->addSelectColumn(DeviTableMap::COL_MODE_PAIEMENT);
            $criteria->addSelectColumn(DeviTableMap::COL_STATUT);
            $criteria->addSelectColumn(DeviTableMap::COL_MONTANT);
            $criteria->addSelectColumn(DeviTableMap::COL_CLIENTID);
            $criteria->addSelectColumn(DeviTableMap::COL_COORDINATEURID);
            $criteria->addSelectColumn(DeviTableMap::COL_UTILISATEURID);
            $criteria->addSelectColumn(DeviTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(DeviTableMap::COL_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.deviId');
            $criteria->addSelectColumn($alias . '.date_commande');
            $criteria->addSelectColumn($alias . '.date_intervention');
            $criteria->addSelectColumn($alias . '.date_debut_intevention');
            $criteria->addSelectColumn($alias . '.date_fin_intevention');
            $criteria->addSelectColumn($alias . '.mode_paiement');
            $criteria->addSelectColumn($alias . '.statut');
            $criteria->addSelectColumn($alias . '.montant');
            $criteria->addSelectColumn($alias . '.clientId');
            $criteria->addSelectColumn($alias . '.coordinateurId');
            $criteria->addSelectColumn($alias . '.utilisateurId');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.last_updated');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(DeviTableMap::DATABASE_NAME)->getTable(DeviTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(DeviTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(DeviTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new DeviTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Devi or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Devi object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Devi) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(DeviTableMap::DATABASE_NAME);
            $criteria->add(DeviTableMap::COL_DEVIID, (array) $values, Criteria::IN);
        }

        $query = DeviQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            DeviTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                DeviTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return DeviQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Devi or Criteria object.
     *
     * @param mixed               $criteria Criteria or Devi object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Devi object
        }

        if ($criteria->containsKey(DeviTableMap::COL_DEVIID) && $criteria->keyContainsValue(DeviTableMap::COL_DEVIID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.DeviTableMap::COL_DEVIID.')');
        }


        // Set the correct dbName
        $query = DeviQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // DeviTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
DeviTableMap::buildTableMap();
