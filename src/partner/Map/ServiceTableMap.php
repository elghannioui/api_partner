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
use partner\Service;
use partner\ServiceQuery;


/**
 * This class defines the structure of the 'services' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class ServiceTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.ServiceTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'services';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Service';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Service';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 7;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 7;

    /**
     * the column name for the serviceId field
     */
    const COL_SERVICEID = 'services.serviceId';

    /**
     * the column name for the libelle field
     */
    const COL_LIBELLE = 'services.libelle';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'services.description';

    /**
     * the column name for the service_media field
     */
    const COL_SERVICE_MEDIA = 'services.service_media';

    /**
     * the column name for the categorieId field
     */
    const COL_CATEGORIEID = 'services.categorieId';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'services.created_at';

    /**
     * the column name for the last_updated field
     */
    const COL_LAST_UPDATED = 'services.last_updated';

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
        self::TYPE_PHPNAME       => array('ServiceID', 'Libelle', 'Description', 'ServiceMedia', 'CategorieID', 'CreatedAt', 'LastUpdated', ),
        self::TYPE_CAMELNAME     => array('serviceID', 'libelle', 'description', 'serviceMedia', 'categorieID', 'createdAt', 'lastUpdated', ),
        self::TYPE_COLNAME       => array(ServiceTableMap::COL_SERVICEID, ServiceTableMap::COL_LIBELLE, ServiceTableMap::COL_DESCRIPTION, ServiceTableMap::COL_SERVICE_MEDIA, ServiceTableMap::COL_CATEGORIEID, ServiceTableMap::COL_CREATED_AT, ServiceTableMap::COL_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('serviceId', 'libelle', 'description', 'service_media', 'categorieId', 'created_at', 'last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('ServiceID' => 0, 'Libelle' => 1, 'Description' => 2, 'ServiceMedia' => 3, 'CategorieID' => 4, 'CreatedAt' => 5, 'LastUpdated' => 6, ),
        self::TYPE_CAMELNAME     => array('serviceID' => 0, 'libelle' => 1, 'description' => 2, 'serviceMedia' => 3, 'categorieID' => 4, 'createdAt' => 5, 'lastUpdated' => 6, ),
        self::TYPE_COLNAME       => array(ServiceTableMap::COL_SERVICEID => 0, ServiceTableMap::COL_LIBELLE => 1, ServiceTableMap::COL_DESCRIPTION => 2, ServiceTableMap::COL_SERVICE_MEDIA => 3, ServiceTableMap::COL_CATEGORIEID => 4, ServiceTableMap::COL_CREATED_AT => 5, ServiceTableMap::COL_LAST_UPDATED => 6, ),
        self::TYPE_FIELDNAME     => array('serviceId' => 0, 'libelle' => 1, 'description' => 2, 'service_media' => 3, 'categorieId' => 4, 'created_at' => 5, 'last_updated' => 6, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, )
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
        $this->setName('services');
        $this->setPhpName('Service');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Service');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('serviceId', 'ServiceID', 'INTEGER', true, null, null);
        $this->addColumn('libelle', 'Libelle', 'VARCHAR', true, 64, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('service_media', 'ServiceMedia', 'VARCHAR', false, 64, null);
        $this->addForeignKey('categorieId', 'CategorieID', 'INTEGER', 'categories', 'categorieId', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_updated', 'LastUpdated', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Categorie', '\\partner\\Categorie', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':categorieId',
    1 => ':categorieId',
  ),
), null, null, null, false);
        $this->addRelation('Prestation', '\\partner\\Prestation', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':serviceId',
    1 => ':serviceId',
  ),
), null, null, 'Prestations', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? ServiceTableMap::CLASS_DEFAULT : ServiceTableMap::OM_CLASS;
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
     * @return array           (Service object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = ServiceTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = ServiceTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + ServiceTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = ServiceTableMap::OM_CLASS;
            /** @var Service $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            ServiceTableMap::addInstanceToPool($obj, $key);
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
            $key = ServiceTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = ServiceTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Service $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                ServiceTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(ServiceTableMap::COL_SERVICEID);
            $criteria->addSelectColumn(ServiceTableMap::COL_LIBELLE);
            $criteria->addSelectColumn(ServiceTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(ServiceTableMap::COL_SERVICE_MEDIA);
            $criteria->addSelectColumn(ServiceTableMap::COL_CATEGORIEID);
            $criteria->addSelectColumn(ServiceTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(ServiceTableMap::COL_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.serviceId');
            $criteria->addSelectColumn($alias . '.libelle');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.service_media');
            $criteria->addSelectColumn($alias . '.categorieId');
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
        return Propel::getServiceContainer()->getDatabaseMap(ServiceTableMap::DATABASE_NAME)->getTable(ServiceTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(ServiceTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(ServiceTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new ServiceTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Service or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Service object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Service) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(ServiceTableMap::DATABASE_NAME);
            $criteria->add(ServiceTableMap::COL_SERVICEID, (array) $values, Criteria::IN);
        }

        $query = ServiceQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            ServiceTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                ServiceTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the services table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return ServiceQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Service or Criteria object.
     *
     * @param mixed               $criteria Criteria or Service object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Service object
        }

        if ($criteria->containsKey(ServiceTableMap::COL_SERVICEID) && $criteria->keyContainsValue(ServiceTableMap::COL_SERVICEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.ServiceTableMap::COL_SERVICEID.')');
        }


        // Set the correct dbName
        $query = ServiceQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // ServiceTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
ServiceTableMap::buildTableMap();
