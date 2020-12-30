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
use partner\Client as ChildClient;
use partner\ClientQuery as ChildClientQuery;
use partner\Devi as ChildDevi;
use partner\DeviQuery as ChildDeviQuery;
use partner\Prestationdevis as ChildPrestationdevis;
use partner\PrestationdevisQuery as ChildPrestationdevisQuery;
use partner\Utilisateur as ChildUtilisateur;
use partner\UtilisateurQuery as ChildUtilisateurQuery;
use partner\Map\DeviTableMap;
use partner\Map\PrestationdevisTableMap;

/**
 * Base class that represents a row from the 'devis' table.
 *
 *
 *
 * @package    propel.generator.partner.Base
 */
abstract class Devi implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\partner\\Map\\DeviTableMap';


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
     * The value for the deviid field.
     *
     * @var        int
     */
    protected $deviid;

    /**
     * The value for the date_commande field.
     *
     * @var        DateTime
     */
    protected $date_commande;

    /**
     * The value for the date_intervention field.
     *
     * @var        DateTime
     */
    protected $date_intervention;

    /**
     * The value for the date_debut_intevention field.
     *
     * @var        DateTime
     */
    protected $date_debut_intevention;

    /**
     * The value for the date_fin_intevention field.
     *
     * @var        DateTime
     */
    protected $date_fin_intevention;

    /**
     * The value for the mode_paiement field.
     *
     * Note: this column has a database default value of: 1
     * @var        int
     */
    protected $mode_paiement;

    /**
     * The value for the statut field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $statut;

    /**
     * The value for the montant field.
     *
     * @var        double
     */
    protected $montant;

    /**
     * The value for the clientid field.
     *
     * @var        int
     */
    protected $clientid;

    /**
     * The value for the coordinateurid field.
     *
     * @var        int
     */
    protected $coordinateurid;

    /**
     * The value for the utilisateurid field.
     *
     * @var        int
     */
    protected $utilisateurid;

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
     * @var        ChildClient
     */
    protected $aClient;

    /**
     * @var        ChildUtilisateur
     */
    protected $aUtilisateur;

    /**
     * @var        ObjectCollection|ChildPrestationdevis[] Collection to store aggregation of ChildPrestationdevis objects.
     */
    protected $collPrestationdeviss;
    protected $collPrestationdevissPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildPrestationdevis[]
     */
    protected $prestationdevissScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->mode_paiement = 1;
        $this->statut = 0;
    }

    /**
     * Initializes internal state of partner\Base\Devi object.
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
     * Compares this with another <code>Devi</code> instance.  If
     * <code>obj</code> is an instance of <code>Devi</code>, delegates to
     * <code>equals(Devi)</code>.  Otherwise, returns <code>false</code>.
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
     * Get the [deviid] column value.
     *
     * @return int
     */
    public function getDeviID()
    {
        return $this->deviid;
    }

    /**
     * Get the [optionally formatted] temporal [date_commande] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateCommande($format = NULL)
    {
        if ($format === null) {
            return $this->date_commande;
        } else {
            return $this->date_commande instanceof \DateTimeInterface ? $this->date_commande->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [date_intervention] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateIntervention($format = NULL)
    {
        if ($format === null) {
            return $this->date_intervention;
        } else {
            return $this->date_intervention instanceof \DateTimeInterface ? $this->date_intervention->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [date_debut_intevention] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateDebutIntervention($format = NULL)
    {
        if ($format === null) {
            return $this->date_debut_intevention;
        } else {
            return $this->date_debut_intevention instanceof \DateTimeInterface ? $this->date_debut_intevention->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [date_fin_intevention] column value.
     *
     *
     * @param      string|null $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateFinIntervention($format = NULL)
    {
        if ($format === null) {
            return $this->date_fin_intevention;
        } else {
            return $this->date_fin_intevention instanceof \DateTimeInterface ? $this->date_fin_intevention->format($format) : null;
        }
    }

    /**
     * Get the [mode_paiement] column value.
     *
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getModePaiement()
    {
        if (null === $this->mode_paiement) {
            return null;
        }
        $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_MODE_PAIEMENT);
        if (!isset($valueSet[$this->mode_paiement])) {
            throw new PropelException('Unknown stored enum key: ' . $this->mode_paiement);
        }

        return $valueSet[$this->mode_paiement];
    }

    /**
     * Get the [statut] column value.
     *
     * @return string
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function getStatut()
    {
        if (null === $this->statut) {
            return null;
        }
        $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_STATUT);
        if (!isset($valueSet[$this->statut])) {
            throw new PropelException('Unknown stored enum key: ' . $this->statut);
        }

        return $valueSet[$this->statut];
    }

    /**
     * Get the [montant] column value.
     *
     * @return double
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Get the [clientid] column value.
     *
     * @return int
     */
    public function getClientID()
    {
        return $this->clientid;
    }

    /**
     * Get the [coordinateurid] column value.
     *
     * @return int
     */
    public function getCoordinateurID()
    {
        return $this->coordinateurid;
    }

    /**
     * Get the [utilisateurid] column value.
     *
     * @return int
     */
    public function getUtilisateurID()
    {
        return $this->utilisateurid;
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
     * Set the value of [deviid] column.
     *
     * @param int $v New value
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setDeviID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->deviid !== $v) {
            $this->deviid = $v;
            $this->modifiedColumns[DeviTableMap::COL_DEVIID] = true;
        }

        return $this;
    } // setDeviID()

    /**
     * Sets the value of [date_commande] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setDateCommande($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_commande !== null || $dt !== null) {
            if ($this->date_commande === null || $dt === null || $dt->format("Y-m-d") !== $this->date_commande->format("Y-m-d")) {
                $this->date_commande = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_DATE_COMMANDE] = true;
            }
        } // if either are not null

        return $this;
    } // setDateCommande()

    /**
     * Sets the value of [date_intervention] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setDateIntervention($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_intervention !== null || $dt !== null) {
            if ($this->date_intervention === null || $dt === null || $dt->format("Y-m-d") !== $this->date_intervention->format("Y-m-d")) {
                $this->date_intervention = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_DATE_INTERVENTION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateIntervention()

    /**
     * Sets the value of [date_debut_intevention] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setDateDebutIntervention($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_debut_intevention !== null || $dt !== null) {
            if ($this->date_debut_intevention === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->date_debut_intevention->format("Y-m-d H:i:s.u")) {
                $this->date_debut_intevention = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_DATE_DEBUT_INTEVENTION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateDebutIntervention()

    /**
     * Sets the value of [date_fin_intevention] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setDateFinIntervention($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_fin_intevention !== null || $dt !== null) {
            if ($this->date_fin_intevention === null || $dt === null || $dt->format("Y-m-d") !== $this->date_fin_intevention->format("Y-m-d")) {
                $this->date_fin_intevention = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_DATE_FIN_INTEVENTION] = true;
            }
        } // if either are not null

        return $this;
    } // setDateFinIntervention()

    /**
     * Set the value of [mode_paiement] column.
     *
     * @param  string $v new value
     * @return $this|\partner\Devi The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setModePaiement($v)
    {
        if ($v !== null) {
            $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_MODE_PAIEMENT);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->mode_paiement !== $v) {
            $this->mode_paiement = $v;
            $this->modifiedColumns[DeviTableMap::COL_MODE_PAIEMENT] = true;
        }

        return $this;
    } // setModePaiement()

    /**
     * Set the value of [statut] column.
     *
     * @param  string $v new value
     * @return $this|\partner\Devi The current object (for fluent API support)
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function setStatut($v)
    {
        if ($v !== null) {
            $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_STATUT);
            if (!in_array($v, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $v));
            }
            $v = array_search($v, $valueSet);
        }

        if ($this->statut !== $v) {
            $this->statut = $v;
            $this->modifiedColumns[DeviTableMap::COL_STATUT] = true;
        }

        return $this;
    } // setStatut()

    /**
     * Set the value of [montant] column.
     *
     * @param double|null $v New value
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setMontant($v)
    {
        if ($v !== null) {
            $v = (double) $v;
        }

        if ($this->montant !== $v) {
            $this->montant = $v;
            $this->modifiedColumns[DeviTableMap::COL_MONTANT] = true;
        }

        return $this;
    } // setMontant()

    /**
     * Set the value of [clientid] column.
     *
     * @param int $v New value
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setClientID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->clientid !== $v) {
            $this->clientid = $v;
            $this->modifiedColumns[DeviTableMap::COL_CLIENTID] = true;
        }

        if ($this->aClient !== null && $this->aClient->getClientID() !== $v) {
            $this->aClient = null;
        }

        return $this;
    } // setClientID()

    /**
     * Set the value of [coordinateurid] column.
     *
     * @param int|null $v New value
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setCoordinateurID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->coordinateurid !== $v) {
            $this->coordinateurid = $v;
            $this->modifiedColumns[DeviTableMap::COL_COORDINATEURID] = true;
        }

        return $this;
    } // setCoordinateurID()

    /**
     * Set the value of [utilisateurid] column.
     *
     * @param int $v New value
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setUtilisateurID($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->utilisateurid !== $v) {
            $this->utilisateurid = $v;
            $this->modifiedColumns[DeviTableMap::COL_UTILISATEURID] = true;
        }

        if ($this->aUtilisateur !== null && $this->aUtilisateur->getUtilisateurID() !== $v) {
            $this->aUtilisateur = null;
        }

        return $this;
    } // setUtilisateurID()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            if ($this->created_at === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->created_at->format("Y-m-d H:i:s.u")) {
                $this->created_at = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_CREATED_AT] = true;
            }
        } // if either are not null

        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [last_updated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTimeInterface value.
     *               Empty strings are treated as NULL.
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function setLastUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_updated !== null || $dt !== null) {
            if ($this->last_updated === null || $dt === null || $dt->format("Y-m-d H:i:s.u") !== $this->last_updated->format("Y-m-d H:i:s.u")) {
                $this->last_updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[DeviTableMap::COL_LAST_UPDATED] = true;
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
            if ($this->mode_paiement !== 1) {
                return false;
            }

            if ($this->statut !== 0) {
                return false;
            }

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : DeviTableMap::translateFieldName('DeviID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->deviid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : DeviTableMap::translateFieldName('DateCommande', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_commande = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : DeviTableMap::translateFieldName('DateIntervention', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_intervention = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : DeviTableMap::translateFieldName('DateDebutIntervention', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->date_debut_intevention = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : DeviTableMap::translateFieldName('DateFinIntervention', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->date_fin_intevention = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : DeviTableMap::translateFieldName('ModePaiement', TableMap::TYPE_PHPNAME, $indexType)];
            $this->mode_paiement = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : DeviTableMap::translateFieldName('Statut', TableMap::TYPE_PHPNAME, $indexType)];
            $this->statut = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : DeviTableMap::translateFieldName('Montant', TableMap::TYPE_PHPNAME, $indexType)];
            $this->montant = (null !== $col) ? (double) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : DeviTableMap::translateFieldName('ClientID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->clientid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : DeviTableMap::translateFieldName('CoordinateurID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->coordinateurid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : DeviTableMap::translateFieldName('UtilisateurID', TableMap::TYPE_PHPNAME, $indexType)];
            $this->utilisateurid = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : DeviTableMap::translateFieldName('CreatedAt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->created_at = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : DeviTableMap::translateFieldName('LastUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->last_updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = DeviTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\partner\\Devi'), 0, $e);
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
        if ($this->aClient !== null && $this->clientid !== $this->aClient->getClientID()) {
            $this->aClient = null;
        }
        if ($this->aUtilisateur !== null && $this->utilisateurid !== $this->aUtilisateur->getUtilisateurID()) {
            $this->aUtilisateur = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(DeviTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildDeviQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aClient = null;
            $this->aUtilisateur = null;
            $this->collPrestationdeviss = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Devi::setDeleted()
     * @see Devi::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildDeviQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(DeviTableMap::DATABASE_NAME);
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
                DeviTableMap::addInstanceToPool($this);
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

            if ($this->aClient !== null) {
                if ($this->aClient->isModified() || $this->aClient->isNew()) {
                    $affectedRows += $this->aClient->save($con);
                }
                $this->setClient($this->aClient);
            }

            if ($this->aUtilisateur !== null) {
                if ($this->aUtilisateur->isModified() || $this->aUtilisateur->isNew()) {
                    $affectedRows += $this->aUtilisateur->save($con);
                }
                $this->setUtilisateur($this->aUtilisateur);
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

            if ($this->prestationdevissScheduledForDeletion !== null) {
                if (!$this->prestationdevissScheduledForDeletion->isEmpty()) {
                    \partner\PrestationdevisQuery::create()
                        ->filterByPrimaryKeys($this->prestationdevissScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->prestationdevissScheduledForDeletion = null;
                }
            }

            if ($this->collPrestationdeviss !== null) {
                foreach ($this->collPrestationdeviss as $referrerFK) {
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

        $this->modifiedColumns[DeviTableMap::COL_DEVIID] = true;
        if (null !== $this->deviid) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . DeviTableMap::COL_DEVIID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(DeviTableMap::COL_DEVIID)) {
            $modifiedColumns[':p' . $index++]  = 'deviId';
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_COMMANDE)) {
            $modifiedColumns[':p' . $index++]  = 'date_commande';
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_INTERVENTION)) {
            $modifiedColumns[':p' . $index++]  = 'date_intervention';
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_DEBUT_INTEVENTION)) {
            $modifiedColumns[':p' . $index++]  = 'date_debut_intevention';
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_FIN_INTEVENTION)) {
            $modifiedColumns[':p' . $index++]  = 'date_fin_intevention';
        }
        if ($this->isColumnModified(DeviTableMap::COL_MODE_PAIEMENT)) {
            $modifiedColumns[':p' . $index++]  = 'mode_paiement';
        }
        if ($this->isColumnModified(DeviTableMap::COL_STATUT)) {
            $modifiedColumns[':p' . $index++]  = 'statut';
        }
        if ($this->isColumnModified(DeviTableMap::COL_MONTANT)) {
            $modifiedColumns[':p' . $index++]  = 'montant';
        }
        if ($this->isColumnModified(DeviTableMap::COL_CLIENTID)) {
            $modifiedColumns[':p' . $index++]  = 'clientId';
        }
        if ($this->isColumnModified(DeviTableMap::COL_COORDINATEURID)) {
            $modifiedColumns[':p' . $index++]  = 'coordinateurId';
        }
        if ($this->isColumnModified(DeviTableMap::COL_UTILISATEURID)) {
            $modifiedColumns[':p' . $index++]  = 'utilisateurId';
        }
        if ($this->isColumnModified(DeviTableMap::COL_CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(DeviTableMap::COL_LAST_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'last_updated';
        }

        $sql = sprintf(
            'INSERT INTO devis (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'deviId':
                        $stmt->bindValue($identifier, $this->deviid, PDO::PARAM_INT);
                        break;
                    case 'date_commande':
                        $stmt->bindValue($identifier, $this->date_commande ? $this->date_commande->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'date_intervention':
                        $stmt->bindValue($identifier, $this->date_intervention ? $this->date_intervention->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'date_debut_intevention':
                        $stmt->bindValue($identifier, $this->date_debut_intevention ? $this->date_debut_intevention->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'date_fin_intevention':
                        $stmt->bindValue($identifier, $this->date_fin_intevention ? $this->date_fin_intevention->format("Y-m-d H:i:s.u") : null, PDO::PARAM_STR);
                        break;
                    case 'mode_paiement':
                        $stmt->bindValue($identifier, $this->mode_paiement, PDO::PARAM_INT);
                        break;
                    case 'statut':
                        $stmt->bindValue($identifier, $this->statut, PDO::PARAM_INT);
                        break;
                    case 'montant':
                        $stmt->bindValue($identifier, $this->montant, PDO::PARAM_STR);
                        break;
                    case 'clientId':
                        $stmt->bindValue($identifier, $this->clientid, PDO::PARAM_INT);
                        break;
                    case 'coordinateurId':
                        $stmt->bindValue($identifier, $this->coordinateurid, PDO::PARAM_INT);
                        break;
                    case 'utilisateurId':
                        $stmt->bindValue($identifier, $this->utilisateurid, PDO::PARAM_INT);
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
        $this->setDeviID($pk);

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
        $pos = DeviTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getDeviID();
                break;
            case 1:
                return $this->getDateCommande();
                break;
            case 2:
                return $this->getDateIntervention();
                break;
            case 3:
                return $this->getDateDebutIntervention();
                break;
            case 4:
                return $this->getDateFinIntervention();
                break;
            case 5:
                return $this->getModePaiement();
                break;
            case 6:
                return $this->getStatut();
                break;
            case 7:
                return $this->getMontant();
                break;
            case 8:
                return $this->getClientID();
                break;
            case 9:
                return $this->getCoordinateurID();
                break;
            case 10:
                return $this->getUtilisateurID();
                break;
            case 11:
                return $this->getCreatedAt();
                break;
            case 12:
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

        if (isset($alreadyDumpedObjects['Devi'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Devi'][$this->hashCode()] = true;
        $keys = DeviTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getDeviID(),
            $keys[1] => $this->getDateCommande(),
            $keys[2] => $this->getDateIntervention(),
            $keys[3] => $this->getDateDebutIntervention(),
            $keys[4] => $this->getDateFinIntervention(),
            $keys[5] => $this->getModePaiement(),
            $keys[6] => $this->getStatut(),
            $keys[7] => $this->getMontant(),
            $keys[8] => $this->getClientID(),
            $keys[9] => $this->getCoordinateurID(),
            $keys[10] => $this->getUtilisateurID(),
            $keys[11] => $this->getCreatedAt(),
            $keys[12] => $this->getLastUpdated(),
        );
        if ($result[$keys[1]] instanceof \DateTimeInterface) {
            $result[$keys[1]] = $result[$keys[1]]->format('c');
        }

        if ($result[$keys[2]] instanceof \DateTimeInterface) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTimeInterface) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[4]] instanceof \DateTimeInterface) {
            $result[$keys[4]] = $result[$keys[4]]->format('c');
        }

        if ($result[$keys[11]] instanceof \DateTimeInterface) {
            $result[$keys[11]] = $result[$keys[11]]->format('c');
        }

        if ($result[$keys[12]] instanceof \DateTimeInterface) {
            $result[$keys[12]] = $result[$keys[12]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aClient) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'client';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'clients';
                        break;
                    default:
                        $key = 'Client';
                }

                $result[$key] = $this->aClient->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUtilisateur) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'utilisateur';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'utilisateurs';
                        break;
                    default:
                        $key = 'Utilisateur';
                }

                $result[$key] = $this->aUtilisateur->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPrestationdeviss) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'prestationdeviss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'prestation_deviss';
                        break;
                    default:
                        $key = 'Prestationdeviss';
                }

                $result[$key] = $this->collPrestationdeviss->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\partner\Devi
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = DeviTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\partner\Devi
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setDeviID($value);
                break;
            case 1:
                $this->setDateCommande($value);
                break;
            case 2:
                $this->setDateIntervention($value);
                break;
            case 3:
                $this->setDateDebutIntervention($value);
                break;
            case 4:
                $this->setDateFinIntervention($value);
                break;
            case 5:
                $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_MODE_PAIEMENT);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setModePaiement($value);
                break;
            case 6:
                $valueSet = DeviTableMap::getValueSet(DeviTableMap::COL_STATUT);
                if (isset($valueSet[$value])) {
                    $value = $valueSet[$value];
                }
                $this->setStatut($value);
                break;
            case 7:
                $this->setMontant($value);
                break;
            case 8:
                $this->setClientID($value);
                break;
            case 9:
                $this->setCoordinateurID($value);
                break;
            case 10:
                $this->setUtilisateurID($value);
                break;
            case 11:
                $this->setCreatedAt($value);
                break;
            case 12:
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
        $keys = DeviTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setDeviID($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setDateCommande($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDateIntervention($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setDateDebutIntervention($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setDateFinIntervention($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setModePaiement($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setStatut($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setMontant($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setClientID($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setCoordinateurID($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setUtilisateurID($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setCreatedAt($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLastUpdated($arr[$keys[12]]);
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
     * @return $this|\partner\Devi The current object, for fluid interface
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
        $criteria = new Criteria(DeviTableMap::DATABASE_NAME);

        if ($this->isColumnModified(DeviTableMap::COL_DEVIID)) {
            $criteria->add(DeviTableMap::COL_DEVIID, $this->deviid);
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_COMMANDE)) {
            $criteria->add(DeviTableMap::COL_DATE_COMMANDE, $this->date_commande);
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_INTERVENTION)) {
            $criteria->add(DeviTableMap::COL_DATE_INTERVENTION, $this->date_intervention);
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_DEBUT_INTEVENTION)) {
            $criteria->add(DeviTableMap::COL_DATE_DEBUT_INTEVENTION, $this->date_debut_intevention);
        }
        if ($this->isColumnModified(DeviTableMap::COL_DATE_FIN_INTEVENTION)) {
            $criteria->add(DeviTableMap::COL_DATE_FIN_INTEVENTION, $this->date_fin_intevention);
        }
        if ($this->isColumnModified(DeviTableMap::COL_MODE_PAIEMENT)) {
            $criteria->add(DeviTableMap::COL_MODE_PAIEMENT, $this->mode_paiement);
        }
        if ($this->isColumnModified(DeviTableMap::COL_STATUT)) {
            $criteria->add(DeviTableMap::COL_STATUT, $this->statut);
        }
        if ($this->isColumnModified(DeviTableMap::COL_MONTANT)) {
            $criteria->add(DeviTableMap::COL_MONTANT, $this->montant);
        }
        if ($this->isColumnModified(DeviTableMap::COL_CLIENTID)) {
            $criteria->add(DeviTableMap::COL_CLIENTID, $this->clientid);
        }
        if ($this->isColumnModified(DeviTableMap::COL_COORDINATEURID)) {
            $criteria->add(DeviTableMap::COL_COORDINATEURID, $this->coordinateurid);
        }
        if ($this->isColumnModified(DeviTableMap::COL_UTILISATEURID)) {
            $criteria->add(DeviTableMap::COL_UTILISATEURID, $this->utilisateurid);
        }
        if ($this->isColumnModified(DeviTableMap::COL_CREATED_AT)) {
            $criteria->add(DeviTableMap::COL_CREATED_AT, $this->created_at);
        }
        if ($this->isColumnModified(DeviTableMap::COL_LAST_UPDATED)) {
            $criteria->add(DeviTableMap::COL_LAST_UPDATED, $this->last_updated);
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
        $criteria = ChildDeviQuery::create();
        $criteria->add(DeviTableMap::COL_DEVIID, $this->deviid);

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
        $validPk = null !== $this->getDeviID();

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
        return $this->getDeviID();
    }

    /**
     * Generic method to set the primary key (deviid column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setDeviID($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getDeviID();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \partner\Devi (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setDateCommande($this->getDateCommande());
        $copyObj->setDateIntervention($this->getDateIntervention());
        $copyObj->setDateDebutIntervention($this->getDateDebutIntervention());
        $copyObj->setDateFinIntervention($this->getDateFinIntervention());
        $copyObj->setModePaiement($this->getModePaiement());
        $copyObj->setStatut($this->getStatut());
        $copyObj->setMontant($this->getMontant());
        $copyObj->setClientID($this->getClientID());
        $copyObj->setCoordinateurID($this->getCoordinateurID());
        $copyObj->setUtilisateurID($this->getUtilisateurID());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setLastUpdated($this->getLastUpdated());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getPrestationdeviss() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPrestationdevis($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setDeviID(NULL); // this is a auto-increment column, so set to default value
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
     * @return \partner\Devi Clone of current object.
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
     * Declares an association between this object and a ChildClient object.
     *
     * @param  ChildClient $v
     * @return $this|\partner\Devi The current object (for fluent API support)
     * @throws PropelException
     */
    public function setClient(ChildClient $v = null)
    {
        if ($v === null) {
            $this->setClientID(NULL);
        } else {
            $this->setClientID($v->getClientID());
        }

        $this->aClient = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildClient object, it will not be re-added.
        if ($v !== null) {
            $v->addDevi($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildClient object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildClient The associated ChildClient object.
     * @throws PropelException
     */
    public function getClient(ConnectionInterface $con = null)
    {
        if ($this->aClient === null && ($this->clientid != 0)) {
            $this->aClient = ChildClientQuery::create()->findPk($this->clientid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aClient->addDevis($this);
             */
        }

        return $this->aClient;
    }

    /**
     * Declares an association between this object and a ChildUtilisateur object.
     *
     * @param  ChildUtilisateur $v
     * @return $this|\partner\Devi The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUtilisateur(ChildUtilisateur $v = null)
    {
        if ($v === null) {
            $this->setUtilisateurID(NULL);
        } else {
            $this->setUtilisateurID($v->getUtilisateurID());
        }

        $this->aUtilisateur = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUtilisateur object, it will not be re-added.
        if ($v !== null) {
            $v->addDevi($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUtilisateur object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUtilisateur The associated ChildUtilisateur object.
     * @throws PropelException
     */
    public function getUtilisateur(ConnectionInterface $con = null)
    {
        if ($this->aUtilisateur === null && ($this->utilisateurid != 0)) {
            $this->aUtilisateur = ChildUtilisateurQuery::create()->findPk($this->utilisateurid, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUtilisateur->addDevis($this);
             */
        }

        return $this->aUtilisateur;
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
        if ('Prestationdevis' === $relationName) {
            $this->initPrestationdeviss();
            return;
        }
    }

    /**
     * Clears out the collPrestationdeviss collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addPrestationdeviss()
     */
    public function clearPrestationdeviss()
    {
        $this->collPrestationdeviss = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collPrestationdeviss collection loaded partially.
     */
    public function resetPartialPrestationdeviss($v = true)
    {
        $this->collPrestationdevissPartial = $v;
    }

    /**
     * Initializes the collPrestationdeviss collection.
     *
     * By default this just sets the collPrestationdeviss collection to an empty array (like clearcollPrestationdeviss());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPrestationdeviss($overrideExisting = true)
    {
        if (null !== $this->collPrestationdeviss && !$overrideExisting) {
            return;
        }

        $collectionClassName = PrestationdevisTableMap::getTableMap()->getCollectionClassName();

        $this->collPrestationdeviss = new $collectionClassName;
        $this->collPrestationdeviss->setModel('\partner\Prestationdevis');
    }

    /**
     * Gets an array of ChildPrestationdevis objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildDevi is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildPrestationdevis[] List of ChildPrestationdevis objects
     * @throws PropelException
     */
    public function getPrestationdeviss(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collPrestationdevissPartial && !$this->isNew();
        if (null === $this->collPrestationdeviss || null !== $criteria || $partial) {
            if ($this->isNew()) {
                // return empty collection
                if (null === $this->collPrestationdeviss) {
                    $this->initPrestationdeviss();
                } else {
                    $collectionClassName = PrestationdevisTableMap::getTableMap()->getCollectionClassName();

                    $collPrestationdeviss = new $collectionClassName;
                    $collPrestationdeviss->setModel('\partner\Prestationdevis');

                    return $collPrestationdeviss;
                }
            } else {
                $collPrestationdeviss = ChildPrestationdevisQuery::create(null, $criteria)
                    ->filterByDevi($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collPrestationdevissPartial && count($collPrestationdeviss)) {
                        $this->initPrestationdeviss(false);

                        foreach ($collPrestationdeviss as $obj) {
                            if (false == $this->collPrestationdeviss->contains($obj)) {
                                $this->collPrestationdeviss->append($obj);
                            }
                        }

                        $this->collPrestationdevissPartial = true;
                    }

                    return $collPrestationdeviss;
                }

                if ($partial && $this->collPrestationdeviss) {
                    foreach ($this->collPrestationdeviss as $obj) {
                        if ($obj->isNew()) {
                            $collPrestationdeviss[] = $obj;
                        }
                    }
                }

                $this->collPrestationdeviss = $collPrestationdeviss;
                $this->collPrestationdevissPartial = false;
            }
        }

        return $this->collPrestationdeviss;
    }

    /**
     * Sets a collection of ChildPrestationdevis objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $prestationdeviss A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildDevi The current object (for fluent API support)
     */
    public function setPrestationdeviss(Collection $prestationdeviss, ConnectionInterface $con = null)
    {
        /** @var ChildPrestationdevis[] $prestationdevissToDelete */
        $prestationdevissToDelete = $this->getPrestationdeviss(new Criteria(), $con)->diff($prestationdeviss);


        $this->prestationdevissScheduledForDeletion = $prestationdevissToDelete;

        foreach ($prestationdevissToDelete as $prestationdevisRemoved) {
            $prestationdevisRemoved->setDevi(null);
        }

        $this->collPrestationdeviss = null;
        foreach ($prestationdeviss as $prestationdevis) {
            $this->addPrestationdevis($prestationdevis);
        }

        $this->collPrestationdeviss = $prestationdeviss;
        $this->collPrestationdevissPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Prestationdevis objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Prestationdevis objects.
     * @throws PropelException
     */
    public function countPrestationdeviss(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collPrestationdevissPartial && !$this->isNew();
        if (null === $this->collPrestationdeviss || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPrestationdeviss) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPrestationdeviss());
            }

            $query = ChildPrestationdevisQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByDevi($this)
                ->count($con);
        }

        return count($this->collPrestationdeviss);
    }

    /**
     * Method called to associate a ChildPrestationdevis object to this object
     * through the ChildPrestationdevis foreign key attribute.
     *
     * @param  ChildPrestationdevis $l ChildPrestationdevis
     * @return $this|\partner\Devi The current object (for fluent API support)
     */
    public function addPrestationdevis(ChildPrestationdevis $l)
    {
        if ($this->collPrestationdeviss === null) {
            $this->initPrestationdeviss();
            $this->collPrestationdevissPartial = true;
        }

        if (!$this->collPrestationdeviss->contains($l)) {
            $this->doAddPrestationdevis($l);

            if ($this->prestationdevissScheduledForDeletion and $this->prestationdevissScheduledForDeletion->contains($l)) {
                $this->prestationdevissScheduledForDeletion->remove($this->prestationdevissScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildPrestationdevis $prestationdevis The ChildPrestationdevis object to add.
     */
    protected function doAddPrestationdevis(ChildPrestationdevis $prestationdevis)
    {
        $this->collPrestationdeviss[]= $prestationdevis;
        $prestationdevis->setDevi($this);
    }

    /**
     * @param  ChildPrestationdevis $prestationdevis The ChildPrestationdevis object to remove.
     * @return $this|ChildDevi The current object (for fluent API support)
     */
    public function removePrestationdevis(ChildPrestationdevis $prestationdevis)
    {
        if ($this->getPrestationdeviss()->contains($prestationdevis)) {
            $pos = $this->collPrestationdeviss->search($prestationdevis);
            $this->collPrestationdeviss->remove($pos);
            if (null === $this->prestationdevissScheduledForDeletion) {
                $this->prestationdevissScheduledForDeletion = clone $this->collPrestationdeviss;
                $this->prestationdevissScheduledForDeletion->clear();
            }
            $this->prestationdevissScheduledForDeletion[]= clone $prestationdevis;
            $prestationdevis->setDevi(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Devi is new, it will return
     * an empty collection; or if this Devi has previously
     * been saved, it will retrieve related Prestationdeviss from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Devi.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildPrestationdevis[] List of ChildPrestationdevis objects
     */
    public function getPrestationdevissJoinPrestation(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildPrestationdevisQuery::create(null, $criteria);
        $query->joinWith('Prestation', $joinBehavior);

        return $this->getPrestationdeviss($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aClient) {
            $this->aClient->removeDevi($this);
        }
        if (null !== $this->aUtilisateur) {
            $this->aUtilisateur->removeDevi($this);
        }
        $this->deviid = null;
        $this->date_commande = null;
        $this->date_intervention = null;
        $this->date_debut_intevention = null;
        $this->date_fin_intevention = null;
        $this->mode_paiement = null;
        $this->statut = null;
        $this->montant = null;
        $this->clientid = null;
        $this->coordinateurid = null;
        $this->utilisateurid = null;
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
            if ($this->collPrestationdeviss) {
                foreach ($this->collPrestationdeviss as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collPrestationdeviss = null;
        $this->aClient = null;
        $this->aUtilisateur = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(DeviTableMap::DEFAULT_STRING_FORMAT);
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
