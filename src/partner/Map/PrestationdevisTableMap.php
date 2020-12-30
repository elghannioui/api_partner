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
use partner\Prestationdevis;
use partner\PrestationdevisQuery;


/**
 * This class defines the structure of the 'prestation_devis' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class PrestationdevisTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.PrestationdevisTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'prestation_devis';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Prestationdevis';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Prestationdevis';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the prestationdeviId field
     */
    const COL_PRESTATIONDEVIID = 'prestation_devis.prestationdeviId';

    /**
     * the column name for the prix_prestation field
     */
    const COL_PRIX_PRESTATION = 'prestation_devis.prix_prestation';

    /**
     * the column name for the quantite field
     */
    const COL_QUANTITE = 'prestation_devis.quantite';

    /**
     * the column name for the prestationId field
     */
    const COL_PRESTATIONID = 'prestation_devis.prestationId';

    /**
     * the column name for the deviId field
     */
    const COL_DEVIID = 'prestation_devis.deviId';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('PrestationdeviID', 'PrixPrestation', 'Quantite', 'PrestationID', 'DeviID', ),
        self::TYPE_CAMELNAME     => array('prestationdeviID', 'prixPrestation', 'quantite', 'prestationID', 'deviID', ),
        self::TYPE_COLNAME       => array(PrestationdevisTableMap::COL_PRESTATIONDEVIID, PrestationdevisTableMap::COL_PRIX_PRESTATION, PrestationdevisTableMap::COL_QUANTITE, PrestationdevisTableMap::COL_PRESTATIONID, PrestationdevisTableMap::COL_DEVIID, ),
        self::TYPE_FIELDNAME     => array('prestationdeviId', 'prix_prestation', 'quantite', 'prestationId', 'deviId', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('PrestationdeviID' => 0, 'PrixPrestation' => 1, 'Quantite' => 2, 'PrestationID' => 3, 'DeviID' => 4, ),
        self::TYPE_CAMELNAME     => array('prestationdeviID' => 0, 'prixPrestation' => 1, 'quantite' => 2, 'prestationID' => 3, 'deviID' => 4, ),
        self::TYPE_COLNAME       => array(PrestationdevisTableMap::COL_PRESTATIONDEVIID => 0, PrestationdevisTableMap::COL_PRIX_PRESTATION => 1, PrestationdevisTableMap::COL_QUANTITE => 2, PrestationdevisTableMap::COL_PRESTATIONID => 3, PrestationdevisTableMap::COL_DEVIID => 4, ),
        self::TYPE_FIELDNAME     => array('prestationdeviId' => 0, 'prix_prestation' => 1, 'quantite' => 2, 'prestationId' => 3, 'deviId' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

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
        $this->setName('prestation_devis');
        $this->setPhpName('Prestationdevis');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Prestationdevis');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('prestationdeviId', 'PrestationdeviID', 'INTEGER', true, null, null);
        $this->addColumn('prix_prestation', 'PrixPrestation', 'DOUBLE', false, null, null);
        $this->addColumn('quantite', 'Quantite', 'INTEGER', false, null, 1);
        $this->addForeignKey('prestationId', 'PrestationID', 'INTEGER', 'prestations', 'prestationId', true, null, null);
        $this->addForeignKey('deviId', 'DeviID', 'INTEGER', 'devis', 'deviId', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Prestation', '\\partner\\Prestation', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':prestationId',
    1 => ':prestationId',
  ),
), null, null, null, false);
        $this->addRelation('Devi', '\\partner\\Devi', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':deviId',
    1 => ':deviId',
  ),
), null, null, null, false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('PrestationdeviID', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? PrestationdevisTableMap::CLASS_DEFAULT : PrestationdevisTableMap::OM_CLASS;
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
     * @return array           (Prestationdevis object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = PrestationdevisTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = PrestationdevisTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + PrestationdevisTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = PrestationdevisTableMap::OM_CLASS;
            /** @var Prestationdevis $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            PrestationdevisTableMap::addInstanceToPool($obj, $key);
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
            $key = PrestationdevisTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = PrestationdevisTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Prestationdevis $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                PrestationdevisTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(PrestationdevisTableMap::COL_PRESTATIONDEVIID);
            $criteria->addSelectColumn(PrestationdevisTableMap::COL_PRIX_PRESTATION);
            $criteria->addSelectColumn(PrestationdevisTableMap::COL_QUANTITE);
            $criteria->addSelectColumn(PrestationdevisTableMap::COL_PRESTATIONID);
            $criteria->addSelectColumn(PrestationdevisTableMap::COL_DEVIID);
        } else {
            $criteria->addSelectColumn($alias . '.prestationdeviId');
            $criteria->addSelectColumn($alias . '.prix_prestation');
            $criteria->addSelectColumn($alias . '.quantite');
            $criteria->addSelectColumn($alias . '.prestationId');
            $criteria->addSelectColumn($alias . '.deviId');
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
        return Propel::getServiceContainer()->getDatabaseMap(PrestationdevisTableMap::DATABASE_NAME)->getTable(PrestationdevisTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(PrestationdevisTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(PrestationdevisTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new PrestationdevisTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Prestationdevis or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Prestationdevis object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationdevisTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Prestationdevis) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(PrestationdevisTableMap::DATABASE_NAME);
            $criteria->add(PrestationdevisTableMap::COL_PRESTATIONDEVIID, (array) $values, Criteria::IN);
        }

        $query = PrestationdevisQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            PrestationdevisTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                PrestationdevisTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the prestation_devis table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return PrestationdevisQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Prestationdevis or Criteria object.
     *
     * @param mixed               $criteria Criteria or Prestationdevis object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(PrestationdevisTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Prestationdevis object
        }

        if ($criteria->containsKey(PrestationdevisTableMap::COL_PRESTATIONDEVIID) && $criteria->keyContainsValue(PrestationdevisTableMap::COL_PRESTATIONDEVIID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.PrestationdevisTableMap::COL_PRESTATIONDEVIID.')');
        }


        // Set the correct dbName
        $query = PrestationdevisQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // PrestationdevisTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
PrestationdevisTableMap::buildTableMap();
