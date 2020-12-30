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
use partner\Categorie;
use partner\CategorieQuery;


/**
 * This class defines the structure of the 'categories' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 */
class CategorieTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'partner.Map.CategorieTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'categories';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\partner\\Categorie';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'partner.Categorie';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 6;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 6;

    /**
     * the column name for the categorieId field
     */
    const COL_CATEGORIEID = 'categories.categorieId';

    /**
     * the column name for the libelle field
     */
    const COL_LIBELLE = 'categories.libelle';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'categories.description';

    /**
     * the column name for the categorie_media field
     */
    const COL_CATEGORIE_MEDIA = 'categories.categorie_media';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'categories.created_at';

    /**
     * the column name for the last_updated field
     */
    const COL_LAST_UPDATED = 'categories.last_updated';

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
        self::TYPE_PHPNAME       => array('CategorieID', 'Libelle', 'Description', 'CategorieMedia', 'CreatedAt', 'LastUpdated', ),
        self::TYPE_CAMELNAME     => array('categorieID', 'libelle', 'description', 'categorieMedia', 'createdAt', 'lastUpdated', ),
        self::TYPE_COLNAME       => array(CategorieTableMap::COL_CATEGORIEID, CategorieTableMap::COL_LIBELLE, CategorieTableMap::COL_DESCRIPTION, CategorieTableMap::COL_CATEGORIE_MEDIA, CategorieTableMap::COL_CREATED_AT, CategorieTableMap::COL_LAST_UPDATED, ),
        self::TYPE_FIELDNAME     => array('categorieId', 'libelle', 'description', 'categorie_media', 'created_at', 'last_updated', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('CategorieID' => 0, 'Libelle' => 1, 'Description' => 2, 'CategorieMedia' => 3, 'CreatedAt' => 4, 'LastUpdated' => 5, ),
        self::TYPE_CAMELNAME     => array('categorieID' => 0, 'libelle' => 1, 'description' => 2, 'categorieMedia' => 3, 'createdAt' => 4, 'lastUpdated' => 5, ),
        self::TYPE_COLNAME       => array(CategorieTableMap::COL_CATEGORIEID => 0, CategorieTableMap::COL_LIBELLE => 1, CategorieTableMap::COL_DESCRIPTION => 2, CategorieTableMap::COL_CATEGORIE_MEDIA => 3, CategorieTableMap::COL_CREATED_AT => 4, CategorieTableMap::COL_LAST_UPDATED => 5, ),
        self::TYPE_FIELDNAME     => array('categorieId' => 0, 'libelle' => 1, 'description' => 2, 'categorie_media' => 3, 'created_at' => 4, 'last_updated' => 5, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, )
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
        $this->setName('categories');
        $this->setPhpName('Categorie');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\partner\\Categorie');
        $this->setPackage('partner');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('categorieId', 'CategorieID', 'INTEGER', true, null, null);
        $this->addColumn('libelle', 'Libelle', 'VARCHAR', true, 32, null);
        $this->addColumn('description', 'Description', 'LONGVARCHAR', false, null, null);
        $this->addColumn('categorie_media', 'CategorieMedia', 'VARCHAR', false, 64, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addColumn('last_updated', 'LastUpdated', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Service', '\\partner\\Service', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':categorieId',
    1 => ':categorieId',
  ),
), null, null, 'Services', false);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)];
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
                : self::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)
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
        return $withPrefix ? CategorieTableMap::CLASS_DEFAULT : CategorieTableMap::OM_CLASS;
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
     * @return array           (Categorie object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CategorieTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CategorieTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CategorieTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CategorieTableMap::OM_CLASS;
            /** @var Categorie $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CategorieTableMap::addInstanceToPool($obj, $key);
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
            $key = CategorieTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CategorieTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Categorie $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CategorieTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(CategorieTableMap::COL_CATEGORIEID);
            $criteria->addSelectColumn(CategorieTableMap::COL_LIBELLE);
            $criteria->addSelectColumn(CategorieTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(CategorieTableMap::COL_CATEGORIE_MEDIA);
            $criteria->addSelectColumn(CategorieTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CategorieTableMap::COL_LAST_UPDATED);
        } else {
            $criteria->addSelectColumn($alias . '.categorieId');
            $criteria->addSelectColumn($alias . '.libelle');
            $criteria->addSelectColumn($alias . '.description');
            $criteria->addSelectColumn($alias . '.categorie_media');
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
        return Propel::getServiceContainer()->getDatabaseMap(CategorieTableMap::DATABASE_NAME)->getTable(CategorieTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CategorieTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CategorieTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CategorieTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Categorie or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Categorie object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(CategorieTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \partner\Categorie) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CategorieTableMap::DATABASE_NAME);
            $criteria->add(CategorieTableMap::COL_CATEGORIEID, (array) $values, Criteria::IN);
        }

        $query = CategorieQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CategorieTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CategorieTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the categories table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CategorieQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Categorie or Criteria object.
     *
     * @param mixed               $criteria Criteria or Categorie object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CategorieTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Categorie object
        }

        if ($criteria->containsKey(CategorieTableMap::COL_CATEGORIEID) && $criteria->keyContainsValue(CategorieTableMap::COL_CATEGORIEID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CategorieTableMap::COL_CATEGORIEID.')');
        }


        // Set the correct dbName
        $query = CategorieQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CategorieTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CategorieTableMap::buildTableMap();
