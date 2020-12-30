
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- utilisateurs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `utilisateurs`;

CREATE TABLE `utilisateurs`
(
    `utilisateurId` INTEGER NOT NULL AUTO_INCREMENT,
    `nom` VARCHAR(64) NOT NULL,
    `login` VARCHAR(64) NOT NULL,
    `mot_de_passe` VARCHAR(64) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`utilisateurId`),
    UNIQUE INDEX `UK_UTILISATEUR_LOGIN` (`login`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- clients
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `clients`;

CREATE TABLE `clients`
(
    `clientId` INTEGER NOT NULL AUTO_INCREMENT,
    `type` TINYINT DEFAULT 1 NOT NULL,
    `nom` VARCHAR(32),
    `telephone` VARCHAR(32) NOT NULL,
    `email` VARCHAR(64),
    `mot_de_passe` VARCHAR(128),
    `access_channel` TINYINT DEFAULT 3,
    `last_connection` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`clientId`),
    UNIQUE INDEX `UK_CLIENTS_Telephone` (`telephone`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- adresses
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `adresses`;

CREATE TABLE `adresses`
(
    `adresseId` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(32) NOT NULL,
    `ville` VARCHAR(64) NOT NULL,
    `numero_bureau` VARCHAR(64),
    `surface_bureau` VARCHAR(64),
    `clientId` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`adresseId`),
    INDEX `FK_ADRESSES_CLIENTS` (`clientId`),
    CONSTRAINT `FK_ADRESSES_CLIENTS`
        FOREIGN KEY (`clientId`)
        REFERENCES `clients` (`clientId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- utilisateur_prestation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `utilisateur_prestation`;

CREATE TABLE `utilisateur_prestation`
(
    `utilisateur_prestationId` INTEGER NOT NULL AUTO_INCREMENT,
    `prestationId` INTEGER NOT NULL,
    `utilisateurId` INTEGER NOT NULL,
    PRIMARY KEY (`utilisateur_prestationId`),
    INDEX `FK_UTILISATEUR_PRESTATION_PRESTATIONS` (`prestationId`),
    INDEX `FK_UTILISATEUR_PRESTATION_UTILISATEURS` (`utilisateurId`),
    CONSTRAINT `FK_UTILISATEUR_PRESTATION_PRESTATIONS`
        FOREIGN KEY (`prestationId`)
        REFERENCES `prestations` (`prestationId`),
    CONSTRAINT `FK_UTILISATEUR_PRESTATION_UTILISATEURS`
        FOREIGN KEY (`utilisateurId`)
        REFERENCES `utilisateurs` (`utilisateurId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories`
(
    `categorieId` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(32) NOT NULL,
    `description` TEXT,
    `categorie_media` VARCHAR(64),
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`categorieId`),
    UNIQUE INDEX `UK_CATEGORIES_LIBELE` (`libelle`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- services
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services`
(
    `serviceId` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(64) NOT NULL,
    `description` TEXT,
    `service_media` VARCHAR(64),
    `categorieId` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`serviceId`),
    UNIQUE INDEX `UK_SERVICES_LIBELE` (`libelle`),
    INDEX `FK_SERVICES_CATEGORIES` (`categorieId`),
    CONSTRAINT `FK_SERVICES_CATEGORIES`
        FOREIGN KEY (`categorieId`)
        REFERENCES `categories` (`categorieId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- prestations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prestations`;

CREATE TABLE `prestations`
(
    `prestationId` INTEGER NOT NULL AUTO_INCREMENT,
    `libelle` VARCHAR(64) NOT NULL,
    `description` TEXT,
    `prestation_media` VARCHAR(64),
    `prix_vente` DOUBLE NOT NULL,
    `serviceId` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`prestationId`),
    INDEX `FK_PRESTATIONS_SERVICES` (`serviceId`),
    CONSTRAINT `FK_PRESTATIONS_SERVICES`
        FOREIGN KEY (`serviceId`)
        REFERENCES `services` (`serviceId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- devis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `devis`;

CREATE TABLE `devis`
(
    `deviId` INTEGER NOT NULL AUTO_INCREMENT,
    `date_commande` DATE,
    `date_intervention` DATE,
    `date_debut_intevention` DATETIME,
    `date_fin_intevention` DATE,
    `mode_paiement` TINYINT DEFAULT 1,
    `statut` TINYINT DEFAULT 0 NOT NULL,
    `montant` DOUBLE,
    `clientId` INTEGER NOT NULL,
    `coordinateurId` INTEGER,
    `utilisateurId` INTEGER NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`deviId`),
    INDEX `FK_DEVIS_CLIENTS` (`clientId`),
    INDEX `FK_DEVIS_UTILISATEURS` (`utilisateurId`),
    CONSTRAINT `FK_DEVIS_CLIENTS`
        FOREIGN KEY (`clientId`)
        REFERENCES `clients` (`clientId`),
    CONSTRAINT `FK_DEVIS_UTILISATEURS`
        FOREIGN KEY (`utilisateurId`)
        REFERENCES `utilisateurs` (`utilisateurId`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- prestation_devis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `prestation_devis`;

CREATE TABLE `prestation_devis`
(
    `prestationdeviId` INTEGER NOT NULL AUTO_INCREMENT,
    `prix_prestation` DOUBLE,
    `quantite` INTEGER DEFAULT 1,
    `prestationId` INTEGER NOT NULL,
    `deviId` INTEGER NOT NULL,
    PRIMARY KEY (`prestationdeviId`),
    INDEX `FK_PRESTATION_DEVIS_PRESTATIONS` (`prestationId`),
    INDEX `FK_PRESTATION_DEVIS_DEVIS` (`deviId`),
    CONSTRAINT `FK_PRESTATION_DEVIS_PRESTATIONS`
        FOREIGN KEY (`prestationId`)
        REFERENCES `prestations` (`prestationId`),
    CONSTRAINT `FK_PRESTATION_DEVIS_DEVIS`
        FOREIGN KEY (`deviId`)
        REFERENCES `devis` (`deviId`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
