<?php

namespace partner\Base;

use \DateTime;
use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;
use partner\Categorie as ChildCategorie;
use partner\CategorieQuery as ChildCategorieQuery;
use partner\Prestation as ChildPrestation;
use partner\PrestationQuery as ChildPrestationQuery;
use partner\Service as ChildService;
use partner\ServiceQuery as ChildServiceQuery;
use partner\Map\PrestationTableMap;
use partner\Map\ServiceTableMap;

/**
 * Base class that represents a row from the 'services' table.
 *
 *
 *
 * @package    propel.generator.partner.Base
 */
abstract class Service implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\partner\\Map\\ServiceTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the serviceid field.
     *
     * @var        int
     */
    protected $serviceid;

    /**
     * The value for the libelle field.
     *
     * @var        string
     */
    protected $libelle;

    /**
     * The value for the description field.
     *
     * @var        string
     */
    protected $description;

    /**
     * The value for the service_media field.
     *
     * @var        string
     */
    protected $service_media;

    /**
     * The value for the categorieid field.
     *
     * @var        int
     */
    protected $categorieid;

    /**
     * The value for the created_at field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $created_at;

    /**
     * The value for the last_updated field.
     *
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        DateTime
     */
    protected $last_updated;

    /**
     * @var        ChildCategorie
     */
    protected $aCategorie;

    /**
     * @var        ObjectCollection|ChildPrestation[] Collection to store aggregation of ChildPrestation objects.
     */
    protected $collPrestations;
    protected $collPrestationsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrestation[]
     */
    protected $prestationsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of partner\Base\Service object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Service</code> instance.  If
     * <code>obj</code> is an instance of <code>Service</code>, delegates to
     * <code>equals(Service)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return void
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [serviceid] column value.
     *
     * @return int
     */
    public function getServiceID()
    {
        return $this->serviceid;
    }

    /**
     * Get the [libelle] column value.
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Get the [description] column value.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the [service_media] column value.
     *
     * @return string
     */
    public function getServiceMedia()
    {
        return $this->service_media;
    }

    /**
     * Get the [categorieid] column value.
     *
     * @return int
     */
    public function getCategorieID()
    {
        return $this->categorieid;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = NULL)
    {
        if ($format === null) {
            return $this->created_at;
        } else {
            return $this->created_at instanceof \DateTimeInterface ? $this->created_at->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [last_updated] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastUpdated($format = NULL)
    {
        if ($format === null) {
            return $this->last_updated;
        } else {
            return $this->last_updated instanceof \DateTimeInterface ? $this->last_updated->format($format) : null;
        }
    }

    /**
     * Set the value of [serviceid] column.
     *
     * @param int $v New value
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setServiceID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->serviceid !== $v) {
            $this->serviceid = $v;
            $this->modifiedColumns[ServiceTableMap::COL_SERVICEID] = true;
        }

        return $this;
    } // setServiceID()

    /**
     * Set the value of [libelle] column.
     *
     * @param string $v New value
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setLibelle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->libelle !== $v) {
            $this->libelle = $v;
            $this->modifiedColumns[ServiceTableMap::COL_LIBELLE] = true;
        }

        return $this;
    } // setLibelle()

    /**
     * Set the value of [description] column.
     *
     * @param string|null $v New value
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->description !== $v) {
            $this->description = $v;
            $this->modifiedColumns[ServiceTableMap::COL_DESCRIPTION] = true;
        }

        return $this;
    } // setDescription()

    /**
     * Set the value of [service_media] column.
     *
     * @param string|null $v New value
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setServiceMedia($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->service_media !== $v) {
            $this->service_media = $v;
            $this->modifiedColumns[ServiceTableMap::COL_SERVICE_MEDIA] = true;
        }

        return $this;
    } // setServiceMedia()

    /**
     * Set the value of [categorieid] column.
     *
     * @param int $v New value
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setCategorieID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->categorieid !== $v) {
            $this->categorieid = $v;
            $this->modifiedColumns[ServiceTableMap::COL_CATEGORIEID] = true;
        }

        if ($this->aCategorie !== null && $this->aCategorie->getCategorieID() !== $v) {
            $this->aCategorie = null;
        }

        return $this;
    } // setCategorieID()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ServiceTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [last_updated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function setLastUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_updated !== null || $dt !== null) {
            if ($this->last_updated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_updated->format("Y-m-d H:i:s.u")) {
                $this->last_updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[ServiceTableMap::COL_LAST_UPDATED] = true;
            }
        } // if either are not null

        return $this;
    } // setLastUpdated()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ServiceTableMap::translateFieldName('ServiceID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->serviceid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ServiceTableMap::translateFieldName('Libelle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->libelle = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ServiceTableMap::translateFieldName('Description', TableMap::TYPE_PHPNAME, $indexType)];
            $this->description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ServiceTableMap::translateFieldName('ServiceMedia', TableMap::TYPE_PHPNAME, $indexType)];
            $this->service_media = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ServiceTableMap::translateFieldName('CategorieID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->categorieid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ServiceTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ServiceTableMap::translateFieldName('LastUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 7; // 7 = ServiceTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\partner\\Service'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aCategorie !== null && $this->categorieid !== $this->aCategorie->getCategorieID()) {
            $this->aCategorie = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ServiceTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildServiceQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategorie = null;
            $this->collPrestations = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Service::setDeleted()
     * @see Service::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildServiceQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ServiceTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ServiceTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategorie !== null) {
                if ($this->aCategorie->isModified() || $this->aCategorie->isNew()) {
                    $affectedRows += $this->aCategorie->save($con);
                }
                $this->setCategorie($this->aCategorie);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            if ($this->prestationsScheduledForDeletion !== null) {
                if (!$this->prestationsScheduledForDeletion->isEmpty()) {
                    \partner\PrestationQuery::create()
                        ->filterByPrimaryKeys($this->prestationsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prestationsScheduledForDeletion = null;
                }
            }

            if ($this->collPrestations !== null) {
                foreach ($this->collPrestations as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ServiceTableMap::COL_SERVICEID] = true;
        if (null !== $this->serviceid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ServiceTableMap::COL_SERVICEID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ServiceTableMap::COL_SERVICEID)) {
            $modifiedColumns[':p' . $index++]  = 'serviceId';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_LIBELLE)) {
            $modifiedColumns[':p' . $index++]  = 'libelle';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'description';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_SERVICE_MEDIA)) {
            $modifiedColumns[':p' . $index++]  = 'service_media';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_CATEGORIEID)) {
            $modifiedColumns[':p' . $index++]  = 'categorieId';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(ServiceTableMap::COL_LAST_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'last_updated';
        }

        $sql = sprintf(
            'INSERT INTO services (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'serviceId':
                        $stmt->bindValue($identifier, $this->serviceid, PDO::PARAM_INT);
                        break;
                    case 'libelle':
                        $stmt->bindValue($identifier, $this->libelle, PDO::PARAM_STR);
                        break;
                    case 'description':
                        $stmt->bindValue($identifier, $this->description, PDO::PARAM_STR);
                        break;
                    case 'service_media':
                        $stmt->bindValue($identifier, $this->service_media, PDO::PARAM_STR);
                        break;
                    case 'categorieId':
                        $stmt->bindValue($identifier, $this->categorieid, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at ? $this->created_at->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'last_updated':
                        $stmt->bindValue($identifier, $this->last_updated ? $this->last_updated->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setServiceID($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ServiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getServiceID();
                break;
            case 1:
                return $this->getLibelle();
                break;
            case 2:
                return $this->getDescription();
                break;
            case 3:
                return $this->getServiceMedia();
                break;
            case 4:
                return $this->getCategorieID();
                break;
            case 5:
                return $this->getCreatedAt();
                break;
            case 6:
                return $this->getLastUpdated();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Service'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Service'][$this->hashCode()] = true;
        $keys = ServiceTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getServiceID(),
            $keys[1] => $this->getLibelle(),
            $keys[2] => $this->getDescription(),
            $keys[3] => $this->getServiceMedia(),
            $keys[4] => $this->getCategorieID(),
            $keys[5] => $this->getCreatedAt(),
            $keys[6] => $this->getLastUpdated(),
        );
        if ($result[$keys[5]] instanceof \DateTimeInterface) {
            $result[$keys[5]] = $result[$keys[5]]->format('c');
        }

        if ($result[$keys[6]] instanceof \DateTimeInterface) {
            $result[$keys[6]] = $result[$keys[6]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aCategorie) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'categorie';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categories';
                        break;
                    default:
                        $key = 'Categorie';
                }

                $result[$key] = $this->aCategorie->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPrestations) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prestations';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prestationss';
                        break;
                    default:
                        $key = 'Prestations';
                }

                $result[$key] = $this->collPrestations->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\partner\Service
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ServiceTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\partner\Service
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setServiceID($value);
                break;
            case 1:
                $this->setLibelle($value);
                break;
            case 2:
                $this->setDescription($value);
                break;
            case 3:
                $this->setServiceMedia($value);
                break;
            case 4:
                $this->setCategorieID($value);
                break;
            case 5:
                $this->setCreatedAt($value);
                break;
            case 6:
                $this->setLastUpdated($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ServiceTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setServiceID($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLibelle($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescription($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setServiceMedia($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setCategorieID($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCreatedAt($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLastUpdated($arr[$keys[6]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\partner\Service The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ServiceTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ServiceTableMap::COL_SERVICEID)) {
            $criteria->add(ServiceTableMap::COL_SERVICEID, $this->serviceid);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_LIBELLE)) {
            $criteria->add(ServiceTableMap::COL_LIBELLE, $this->libelle);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_DESCRIPTION)) {
            $criteria->add(ServiceTableMap::COL_DESCRIPTION, $this->description);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_SERVICE_MEDIA)) {
            $criteria->add(ServiceTableMap::COL_SERVICE_MEDIA, $this->service_media);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_CATEGORIEID)) {
            $criteria->add(ServiceTableMap::COL_CATEGORIEID, $this->categorieid);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_CREATED_AT)) {
            $criteria->add(ServiceTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(ServiceTableMap::COL_LAST_UPDATED)) {
            $criteria->add(ServiceTableMap::COL_LAST_UPDATED, $this->last_updated);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildServiceQuery::create();
        $criteria->add(ServiceTableMap::COL_SERVICEID, $this->serviceid);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getServiceID();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getServiceID();
    }

    /**
     * Generic method to set the primary key (serviceid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setServiceID($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getServiceID();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \partner\Service (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLibelle($this->getLibelle());
        $copyObj->setDescription($this->getDescription());
        $copyObj->setServiceMedia($this->getServiceMedia());
        $copyObj->setCategorieID($this->getCategorieID());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setLastUpdated($this->getLastUpdated());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPrestations() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrestation($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setServiceID(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \partner\Service Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildCategorie object.
     *
     * @param  ChildCategorie $v
     * @return $this|\partner\Service The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategorie(ChildCategorie $v = null)
    {
        if ($v === null) {
            $this->setCategorieID(NULL);
        } else {
            $this->setCategorieID($v->getCategorieID());
        }

        $this->aCategorie = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildCategorie object, it will not be re-added.
        if ($v !== null) {
            $v->addService($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildCategorie object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildCategorie The associated ChildCategorie object.
     * @throws PropelException
     */
    public function getCategorie(ConnectionInterface $con = null)
    {
        if ($this->aCategorie === null && ($this->categorieid != 0)) {
            $this->aCategorie = ChildCategorieQuery::create()->findPk($this->categorieid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategorie->addServices($this);
             */
        }

        return $this->aCategorie;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Prestation' === $relationName) {
            $this->initPrestations();
            return;
        }
    }

    /**
     * Clears out the collPrestations collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPrestations()
     */
    public function clearPrestations()
    {
        $this->collPrestations = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPrestations collection loaded partially.
     */
    public function resetPartialPrestations($v = true)
    {
        $this->collPrestationsPartial = $v;
    }

    /**
     * Initializes the collPrestations collection.
     *
     * By default this just sets the collPrestations collection to an empty array (like clearcollPrestations());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrestations($overrideExisting = true)
    {
        if (null !== $this->collPrestations && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrestationTableMap::getTableMap()->getCollectionClassName();

        $this->collPrestations = new $collectionClassName;
        $this->collPrestations->setModel('\partner\Prestation');
    }

    /**
     * Gets an array of ChildPrestation objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildService is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrestation[] List of ChildPrestation objects
     * @throws PropelException
     */
    public function getPrestations(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPrestationsPartial && !$this->isNew();
        if (null === $this->collPrestations || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrestations) {
                    $this->initPrestations();
                } else {
                    $collectionClassName = PrestationTableMap::getTableMap()->getCollectionClassName();

                    $collPrestations = new $collectionClassName;
                    $collPrestations->setModel('\partner\Prestation');

                    return $collPrestations;
                }
            } else {
                $collPrestations = ChildPrestationQuery::create(null, $criteria)
                    ->filterByService($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrestationsPartial && count($collPrestations)) {
                        $this->initPrestations(false);

                        foreach ($collPrestations as $obj) {
                            if (false == $this->collPrestations->contains($obj)) {
                                $this->collPrestations->append($obj);
                            }
                        }

                        $this->collPrestationsPartial = true;
                    }

                    return $collPrestations;
                }

                if ($partial && $this->collPrestations) {
                    foreach ($this->collPrestations as $obj) {
                        if ($obj->isNew()) {
                            $collPrestations[] = $obj;
                        }
                    }
                }

                $this->collPrestations = $collPrestations;
                $this->collPrestationsPartial = false;
            }
        }

        return $this->collPrestations;
    }

    /**
     * Sets a collection of ChildPrestation objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $prestations A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildService The current object (for fluent API support)
     */
    public function setPrestations(Collection $prestations, ConnectionInterface $con = null)
    {
        /** @var ChildPrestation[] $prestationsToDelete */
        $prestationsToDelete = $this->getPrestations(new Criteria(), $con)->diff($prestations);


        $this->prestationsScheduledForDeletion = $prestationsToDelete;

        foreach ($prestationsToDelete as $prestationRemoved) {
            $prestationRemoved->setService(null);
        }

        $this->collPrestations = null;
        foreach ($prestations as $prestation) {
            $this->addPrestation($prestation);
        }

        $this->collPrestations = $prestations;
        $this->collPrestationsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Prestation objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Prestation objects.
     * @throws PropelException
     */
    public function countPrestations(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPrestationsPartial && !$this->isNew();
        if (null === $this->collPrestations || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrestations) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrestations());
            }

            $query = ChildPrestationQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByService($this)
                ->count($con);
        }

        return count($this->collPrestations);
    }

    /**
     * Method called to associate a ChildPrestation object to this object
     * through the ChildPrestation foreign key attribute.
     *
     * @param  ChildPrestation $l ChildPrestation
     * @return $this|\partner\Service The current object (for fluent API support)
     */
    public function addPrestation(ChildPrestation $l)
    {
        if ($this->collPrestations === null) {
            $this->initPrestations();
            $this->collPrestationsPartial = true;
        }

        if (!$this->collPrestations->contains($l)) {
            $this->doAddPrestation($l);

            if ($this->prestationsScheduledForDeletion and $this->prestationsScheduledForDeletion->contains($l)) {
                $this->prestationsScheduledForDeletion->remove($this->prestationsScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrestation $prestation The ChildPrestation object to add.
     */
    protected function doAddPrestation(ChildPrestation $prestation)
    {
        $this->collPrestations[]= $prestation;
        $prestation->setService($this);
    }

    /**
     * @param  ChildPrestation $prestation The ChildPrestation object to remove.
     * @return $this|ChildService The current object (for fluent API support)
     */
    public function removePrestation(ChildPrestation $prestation)
    {
        if ($this->getPrestations()->contains($prestation)) {
            $pos = $this->collPrestations->search($prestation);
            $this->collPrestations->remove($pos);
            if (null === $this->prestationsScheduledForDeletion) {
                $this->prestationsScheduledForDeletion = clone $this->collPrestations;
                $this->prestationsScheduledForDeletion->clear();
            }
            $this->prestationsScheduledForDeletion[]= clone $prestation;
            $prestation->setService(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aCategorie) {
            $this->aCategorie->removeService($this);
        }
        $this->serviceid = null;
        $this->libelle = null;
        $this->description = null;
        $this->service_media = null;
        $this->categorieid = null;
        $this->created_at = null;
        $this->last_updated = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collPrestations) {
                foreach ($this->collPrestations as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPrestations = null;
        $this->aCategorie = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ServiceTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
            }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
                return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
            }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
