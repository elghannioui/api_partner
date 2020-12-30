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
use partner\Adresse;
use partner\AdresseQuery;


/**
 * This class defines the structure of the 'adresses' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class AdresseTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.AdresseTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'adresses';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Adresse';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Adresse';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the adresseId field
     */
    const COL_ADRESSEID = 'adresses.adresseId';

    /**
     * the column name for the libelle field
     */
    const COL_LIBELLE = 'adresses.libelle';

    /**
     * the column name for the ville field
     */
    const COL_VILLE = 'adresses.ville';

    /**
     * the column name for the numero_bureau field
     */
    const COL_NUMERO_BUREAU = 'adresses.numero_bureau';

    /**
     * the column name for the surface_bureau field
     */
    const COL_SURFACE_BUREAU = 'adresses.surface_bureau';

    /**
     * the column name for the clientId field
     */
    const COL_CLIENTID = 'adresses.clientId';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'adresses.created_at';

    /**
     * the column name for the last_updated field
     */
    const COL_LAST_UPDATED = 'adresses.last_updated';

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
        self::TYPE_PHPNAME       => array('AdressID', 'Libelle', 'Ville', 'OfficeNumber', 'OfficeSurface', 'ClientID', 'CreatedAt', 'LastUpdated', ),
        self::TYPE_CAMELNAME     => array('adressID', 'libelle', 'ville', 'officeNumber', 'officeSurface', 'clientID', 'createdAt', 'lastUpdated', ),
        self::TYPE_COLNAME       => array(AdresseTableMap::COL_ADRESSEID, AdresseTableMap::COL_LIBELLE, AdresseTableMap::COL_VILLE, AdresseTableMap::COL_NUMERO_BUREAU, AdresseTableMap::COL_SURFACE_BUREAU, AdresseTableMap::COL_CLIENTID, AdresseTableMap::COL_CREATED_AT, AdresseTableMap::COL_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('adresseId', 'libelle', 'ville', 'numero_bureau', 'surface_bureau', 'clientId', 'created_at', 'last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('AdressID' => 0, 'Libelle' => 1, 'Ville' => 2, 'OfficeNumber' => 3, 'OfficeSurface' => 4, 'ClientID' => 5, 'CreatedAt' => 6, 'LastUpdated' => 7, ),
        self::TYPE_CAMELNAME     => array('adressID' => 0, 'libelle' => 1, 'ville' => 2, 'officeNumber' => 3, 'officeSurface' => 4, 'clientID' => 5, 'createdAt' => 6, 'lastUpdated' => 7, ),
        self::TYPE_COLNAME       => array(AdresseTableMap::COL_ADRESSEID => 0, AdresseTableMap::COL_LIBELLE => 1, AdresseTableMap::COL_VILLE => 2, AdresseTableMap::COL_NUMERO_BUREAU => 3, AdresseTableMap::COL_SURFACE_BUREAU => 4, AdresseTableMap::COL_CLIENTID => 5, AdresseTableMap::COL_CREATED_AT => 6, AdresseTableMap::COL_LAST_UPDATED => 7, ),
        self::TYPE_FIELDNAME     => array('adresseId' => 0, 'libelle' => 1, 'ville' => 2, 'numero_bureau' => 3, 'surface_bureau' => 4, 'clientId' => 5, 'created_at' => 6, 'last_updated' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
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
        $this->setName('adresses');
        $this->setPhpName('Adresse');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Adresse');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('adresseId', 'AdressID', 'INTEGER', true, null, null);
        $this->addColumn('libelle', 'Libelle', 'VARCHAR', true, 32, null);
        $this->addColumn('ville', 'Ville', 'VARCHAR', true, 64, null);
        $this->addColumn('numero_bureau', 'OfficeNumber', 'VARCHAR', false, 64, null);
        $this->addColumn('surface_bureau', 'OfficeSurface', 'VARCHAR', false, 64, null);
        $this->addForeignKey('clientId', 'ClientID', 'INTEGER', 'clients', 'clientId', true, null, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('AdressID', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? AdresseTableMap::CLASS_DEFAULT : AdresseTableMap::OM_CLASS;
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
     * @return array           (Adresse object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AdresseTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AdresseTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AdresseTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AdresseTableMap::OM_CLASS;
            /** @var Adresse $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AdresseTableMap::addInstanceToPool($obj, $key);
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
            $key = AdresseTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AdresseTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Adresse $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AdresseTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AdresseTableMap::COL_ADRESSEID);
            $criteria->addSelectColumn(AdresseTableMap::COL_LIBELLE);
            $criteria->addSelectColumn(AdresseTableMap::COL_VILLE);
            $criteria->addSelectColumn(AdresseTableMap::COL_NUMERO_BUREAU);
            $criteria->addSelectColumn(AdresseTableMap::COL_SURFACE_BUREAU);
            $criteria->addSelectColumn(AdresseTableMap::COL_CLIENTID);
            $criteria->addSelectColumn(AdresseTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AdresseTableMap::COL_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.adresseId');
            $criteria->addSelectColumn($alias . '.libelle');
            $criteria->addSelectColumn($alias . '.ville');
            $criteria->addSelectColumn($alias . '.numero_bureau');
            $criteria->addSelectColumn($alias . '.surface_bureau');
            $criteria->addSelectColumn($alias . '.clientId');
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
        return Propel::getServiceContainer()->getDatabaseMap(AdresseTableMap::DATABASE_NAME)->getTable(AdresseTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AdresseTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AdresseTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AdresseTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Adresse or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Adresse object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Adresse) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AdresseTableMap::DATABASE_NAME);
            $criteria->add(AdresseTableMap::COL_ADRESSEID, (array) $values, Criteria::IN);
        }

        $query = AdresseQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AdresseTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AdresseTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the adresses table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AdresseQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Adresse or Criteria object.
     *
     * @param mixed               $criteria Criteria or Adresse object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AdresseTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Adresse object
        }

        if ($criteria->containsKey(AdresseTableMap::COL_ADRESSEID) && $criteria->keyContainsValue(AdresseTableMap::COL_ADRESSEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AdresseTableMap::COL_ADRESSEID.')');
        }


        // Set the correct dbName
        $query = AdresseQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AdresseTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AdresseTableMap::buildTableMap();
