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
use partner\Client;
use partner\ClientQuery;


/**
 * This class defines the structure of the 'clients' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ClientTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.ClientTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'clients';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Client';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Client';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 10;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 10;

    /**
     * the column name for the clientId field
     */
    const COL_CLIENTID = 'clients.clientId';

    /**
     * the column name for the type field
     */
    const COL_TYPE = 'clients.type';

    /**
     * the column name for the nom field
     */
    const COL_NOM = 'clients.nom';

    /**
     * the column name for the telephone field
     */
    const COL_TELEPHONE = 'clients.telephone';

    /**
     * the column name for the email field
     */
    const COL_EMAIL = 'clients.email';

    /**
     * the column name for the mot_de_passe field
     */
    const COL_MOT_DE_PASSE = 'clients.mot_de_passe';

    /**
     * the column name for the access_channel field
     */
    const COL_ACCESS_CHANNEL = 'clients.access_channel';

    /**
     * the column name for the last_connection field
     */
    const COL_LAST_CONNECTION = 'clients.last_connection';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'clients.created_at';

    /**
     * the column name for the last_updated field
     */
    const COL_LAST_UPDATED = 'clients.last_updated';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /** The enumerated values for the type field */
    const COL_TYPE_SOCIETE = 'societe';
    const COL_TYPE_PARTICULIER = 'particulier';

    /** The enumerated values for the access_channel field */
    const COL_ACCESS_CHANNEL_ANDROID = 'Android';
    const COL_ACCESS_CHANNEL_IOS = 'IOS';
    const COL_ACCESS_CHANNEL_WEB = 'Web';
    const COL_ACCESS_CHANNEL_TELEPHONE = 'telephone';
    const COL_ACCESS_CHANNEL_AUTRE = 'Autre';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('ClientID', 'Type', 'Nom', 'Telephone', 'Email', 'Password', 'AccessChannel', 'LastConnection', 'CreatedAt', 'LastUpdated', ),
        self::TYPE_CAMELNAME     => array('clientID', 'type', 'nom', 'telephone', 'email', 'password', 'accessChannel', 'lastConnection', 'createdAt', 'lastUpdated', ),
        self::TYPE_COLNAME       => array(ClientTableMap::COL_CLIENTID, ClientTableMap::COL_TYPE, ClientTableMap::COL_NOM, ClientTableMap::COL_TELEPHONE, ClientTableMap::COL_EMAIL, ClientTableMap::COL_MOT_DE_PASSE, ClientTableMap::COL_ACCESS_CHANNEL, ClientTableMap::COL_LAST_CONNECTION, ClientTableMap::COL_CREATED_AT, ClientTableMap::COL_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('clientId', 'type', 'nom', 'telephone', 'email', 'mot_de_passe', 'access_channel', 'last_connection', 'created_at', 'last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ClientID' => 0, 'Type' => 1, 'Nom' => 2, 'Telephone' => 3, 'Email' => 4, 'Password' => 5, 'AccessChannel' => 6, 'LastConnection' => 7, 'CreatedAt' => 8, 'LastUpdated' => 9, ),
        self::TYPE_CAMELNAME     => array('clientID' => 0, 'type' => 1, 'nom' => 2, 'telephone' => 3, 'email' => 4, 'password' => 5, 'accessChannel' => 6, 'lastConnection' => 7, 'createdAt' => 8, 'lastUpdated' => 9, ),
        self::TYPE_COLNAME       => array(ClientTableMap::COL_CLIENTID => 0, ClientTableMap::COL_TYPE => 1, ClientTableMap::COL_NOM => 2, ClientTableMap::COL_TELEPHONE => 3, ClientTableMap::COL_EMAIL => 4, ClientTableMap::COL_MOT_DE_PASSE => 5, ClientTableMap::COL_ACCESS_CHANNEL => 6, ClientTableMap::COL_LAST_CONNECTION => 7, ClientTableMap::COL_CREATED_AT => 8, ClientTableMap::COL_LAST_UPDATED => 9, ),
        self::TYPE_FIELDNAME     => array('clientId' => 0, 'type' => 1, 'nom' => 2, 'telephone' => 3, 'email' => 4, 'mot_de_passe' => 5, 'access_channel' => 6, 'last_connection' => 7, 'created_at' => 8, 'last_updated' => 9, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, )
    );

    /** The enumerated values for this table */
    protected static $enumValueSets = array(
                ClientTableMap::COL_TYPE => array(
                            self::COL_TYPE_SOCIETE,
            self::COL_TYPE_PARTICULIER,
        ),
                ClientTableMap::COL_ACCESS_CHANNEL => array(
                            self::COL_ACCESS_CHANNEL_ANDROID,
            self::COL_ACCESS_CHANNEL_IOS,
            self::COL_ACCESS_CHANNEL_WEB,
            self::COL_ACCESS_CHANNEL_TELEPHONE,
            self::COL_ACCESS_CHANNEL_AUTRE,
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
        $this->setName('clients');
        $this->setPhpName('Client');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Client');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('clientId', 'ClientID', 'INTEGER', true, null, null);
        $this->addColumn('type', 'Type', 'ENUM', true, null, 'particulier');
        $this->getColumn('type')->setValueSet(array (
  0 => 'societe',
  1 => 'particulier',
));
        $this->addColumn('nom', 'Nom', 'VARCHAR', false, 32, null);
        $this->addColumn('telephone', 'Telephone', 'VARCHAR', true, 32, null);
        $this->addColumn('email', 'Email', 'VARCHAR', false, 64, null);
        $this->addColumn('mot_de_passe', 'Password', 'VARCHAR', false, 128, null);
        $this->addColumn('access_channel', 'AccessChannel', 'ENUM', false, null, 'telephone');
        $this->getColumn('access_channel')->setValueSet(array (
  0 => 'Android',
  1 => 'IOS',
  2 => 'Web',
  3 => 'telephone',
  4 => 'Autre',
));
        $this->addColumn('last_connection', 'LastConnection', 'TIMESTAMP', false, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_updated', 'LastUpdated', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Adresse', '\\partner\\Adresse', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':clientId',
    1 => ':clientId',
  ),
), null, null, 'Adresses', false);
        $this->addRelation('Devi', '\\partner\\Devi', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':clientId',
    1 => ':clientId',
  ),
), null, null, 'Devis', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ClientTableMap::CLASS_DEFAULT : ClientTableMap::OM_CLASS;
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
     * @return array           (Client object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ClientTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ClientTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ClientTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ClientTableMap::OM_CLASS;
            /** @var Client $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ClientTableMap::addInstanceToPool($obj, $key);
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
            $key = ClientTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ClientTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Client $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ClientTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ClientTableMap::COL_CLIENTID);
            $criteria->addSelectColumn(ClientTableMap::COL_TYPE);
            $criteria->addSelectColumn(ClientTableMap::COL_NOM);
            $criteria->addSelectColumn(ClientTableMap::COL_TELEPHONE);
            $criteria->addSelectColumn(ClientTableMap::COL_EMAIL);
            $criteria->addSelectColumn(ClientTableMap::COL_MOT_DE_PASSE);
            $criteria->addSelectColumn(ClientTableMap::COL_ACCESS_CHANNEL);
            $criteria->addSelectColumn(ClientTableMap::COL_LAST_CONNECTION);
            $criteria->addSelectColumn(ClientTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ClientTableMap::COL_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.clientId');
            $criteria->addSelectColumn($alias . '.type');
            $criteria->addSelectColumn($alias . '.nom');
            $criteria->addSelectColumn($alias . '.telephone');
            $criteria->addSelectColumn($alias . '.email');
            $criteria->addSelectColumn($alias . '.mot_de_passe');
            $criteria->addSelectColumn($alias . '.access_channel');
            $criteria->addSelectColumn($alias . '.last_connection');
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
        return Propel::getServiceContainer()->getDatabaseMap(ClientTableMap::DATABASE_NAME)->getTable(ClientTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ClientTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ClientTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ClientTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Client or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Client object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Client) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ClientTableMap::DATABASE_NAME);
            $criteria->add(ClientTableMap::COL_CLIENTID, (array) $values, Criteria::IN);
        }

        $query = ClientQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ClientTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ClientTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the clients table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ClientQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Client or Criteria object.
     *
     * @param mixed               $criteria Criteria or Client object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ClientTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Client object
        }

        if ($criteria->containsKey(ClientTableMap::COL_CLIENTID) && $criteria->keyContainsValue(ClientTableMap::COL_CLIENTID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ClientTableMap::COL_CLIENTID.')');
        }


        // Set the correct dbName
        $query = ClientQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ClientTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ClientTableMap::buildTableMap();
