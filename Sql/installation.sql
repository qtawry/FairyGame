# script créé le : Sat Jun 13 12:11:38 CEST 2015 -   syntaxe MySQL ;

# use  VOTRE_BASE_DE_DONNEE ;


DROP TABLE IF EXISTS Mage ;
CREATE TABLE Mage (MageId BIGINT NOT NULL auto_increment,
MageName VARCHAR(50),
MagePwd VARCHAR(128),
MageMail VARCHAR(150),
MageAttack BIGINT DEFAULT 0,
MageHP BIGINT DEFAULT 0,
MageSupport BIGINT DEFAULT 0,
MageXP BIGINT DEFAULT 0,
MageGold BIGINT DEFAULT 0,
MageInfluence BIGINT DEFAULT 0,
PRIMARY KEY (MageId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Guild ;
CREATE TABLE Guild (GuildId BIGINT NOT NULL auto_increment,
GuildName VARCHAR(100),
CityId BIGINT NOT NULL,
PRIMARY KEY (GuildId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS City ;
CREATE TABLE City (CityId BIGINT NOT NULL auto_increment,
CityName VARCHAR(100),
CountryId BIGINT NOT NULL,
PRIMARY KEY (CityId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Country ;
CREATE TABLE Country (CountryId BIGINT NOT NULL auto_increment,
CountryName VARCHAR(50),
PRIMARY KEY (CountryId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS MageType ;
CREATE TABLE MageType (MageTypeId BIGINT NOT NULL auto_increment,
MageTypeName VARCHAR(50),
MageTypeHP INT DEFAULT 0,
MageTypeAttack INT DEFAULT 0,
MageTypeSupport INT DEFAULT 0,
PRIMARY KEY (MageTypeId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Ressources ;
CREATE TABLE Ressources (ResId BIGINT NOT NULL auto_increment,
ResName VARCHAR(50),
PRIMARY KEY (ResId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Mission ;
CREATE TABLE Mission (MissionId BIGINT NOT NULL auto_increment,
MissionName VARCHAR(150),
MissionLevel INT DEFAULT 1,
MissionXP INT DEFAULT 0,
MissionInfluence INT DEFAULT 0,
MissionGold INT DEFAULT 0,
PRIMARY KEY (MissionId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS TypeEffect ;
CREATE TABLE TypeEffect (Modifier TINYINT NOT NULL,
MageTypeAttack BIGINT NOT NULL,
MageTypeDef BIGINT NOT NULL,
PRIMARY KEY (MageTypeAttack, MageTypeDef) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Building ;
CREATE TABLE Building (BuildingId BIGINT NOT NULL auto_increment,
BuildingName VARCHAR(50),
BuildingCostGold INT NOT NULL DEFAULT 0,
BuildingCostInfluence INT NOT NULL DEFAULT 0,
PRIMARY KEY (BuildingId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Artefact ;
CREATE TABLE Artefact (ArtefactId BIGINT NOT NULL auto_increment,
ArtefactName VARCHAR(100),
ArtefactDescription VARCHAR(200),
ArtefactCostGold INT NOT NULL DEFAULT 0,
PRIMARY KEY (ArtefactId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Member ;
CREATE TABLE Member (MageId BIGINT NOT NULL,
GuildId BIGINT NOT NULL,
Rang TINYINT,
PRIMARY KEY (MageId,
 GuildId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS MageIs ;
CREATE TABLE MageIs (MageId BIGINT NOT NULL,
MageTypeId BIGINT NOT NULL,
level INT,
PRIMARY KEY (MageId,
 MageTypeId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS MageRessources ;
CREATE TABLE MageRessources (ResId BIGINT NOT NULL,
MageId BIGINT NOT NULL,
Amount BIGINT,
PRIMARY KEY (ResId,
 MageId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS MageMission ;
CREATE TABLE MageMission (MageId BIGINT NOT NULL,
MissionId BIGINT NOT NULL,
MMId BIGINT,
MMStatus BOOL,
PRIMARY KEY (MageId,
 MissionId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS BuildingCost ;
CREATE TABLE BuildingCost (ResId BIGINT NOT NULL,
BuildingId BIGINT NOT NULL,
BCAmount INT,
PRIMARY KEY (ResId,
 BuildingId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS ArtefactCost ;
CREATE TABLE ArtefactCost (ResId BIGINT NOT NULL,
ArtefactId BIGINT NOT NULL,
ACAmount INT,
PRIMARY KEY (ResId,
 ArtefactId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS Required ;
CREATE TABLE Required (BuildingId BIGINT NOT NULL,
ArtefactId BIGINT NOT NULL,
RequiredLevel INT,
PRIMARY KEY (BuildingId,
 ArtefactId) ) ENGINE=InnoDB;

DROP TABLE IF EXISTS GuildBuildings ;
CREATE TABLE GuildBuildings (GuildId BIGINT NOT NULL,
BuildingId BIGINT NOT NULL,
GBLevel INT,
PRIMARY KEY (GuildId,
 BuildingId) ) ENGINE=InnoDB;

ALTER TABLE Guild ADD CONSTRAINT FK_Guild_CityId FOREIGN KEY (CityId) REFERENCES City (CityId);

ALTER TABLE City ADD CONSTRAINT FK_City_CountryId FOREIGN KEY (CountryId) REFERENCES Country (CountryId);
ALTER TABLE TypeEffect ADD CONSTRAINT FK_TypeEffect_MageTypeId FOREIGN KEY (MageTypeId) REFERENCES MageType (MageTypeId);
ALTER TABLE TypeEffect ADD CONSTRAINT FK_TypeEffect_MageTypeId FOREIGN KEY (MageTypeId) REFERENCES MageType (MageTypeId);
ALTER TABLE Member ADD CONSTRAINT FK_Member_MageId FOREIGN KEY (MageId) REFERENCES Mage (MageId);
ALTER TABLE Member ADD CONSTRAINT FK_Member_GuildId FOREIGN KEY (GuildId) REFERENCES Guild (GuildId);
ALTER TABLE MageIs ADD CONSTRAINT FK_MageIs_MageId FOREIGN KEY (MageId) REFERENCES Mage (MageId);
ALTER TABLE MageIs ADD CONSTRAINT FK_MageIs_MageTypeId FOREIGN KEY (MageTypeId) REFERENCES MageType (MageTypeId);
ALTER TABLE MageRessources ADD CONSTRAINT FK_MageRessources_ResId FOREIGN KEY (ResId) REFERENCES Ressources (ResId);
ALTER TABLE MageRessources ADD CONSTRAINT FK_MageRessources_MageId FOREIGN KEY (MageId) REFERENCES Mage (MageId);
ALTER TABLE MageMission ADD CONSTRAINT FK_MageMission_MageId FOREIGN KEY (MageId) REFERENCES Mage (MageId);
ALTER TABLE MageMission ADD CONSTRAINT FK_MageMission_MissionId FOREIGN KEY (MissionId) REFERENCES Mission (MissionId);
ALTER TABLE BuildingCost ADD CONSTRAINT FK_BuildingCost_ResId FOREIGN KEY (ResId) REFERENCES Ressources (ResId);
ALTER TABLE BuildingCost ADD CONSTRAINT FK_BuildingCost_BuildingId FOREIGN KEY (BuildingId) REFERENCES Building (BuildingId);
ALTER TABLE ArtefactCost ADD CONSTRAINT FK_ArtefactCost_ResId FOREIGN KEY (ResId) REFERENCES Ressources (ResId);
ALTER TABLE ArtefactCost ADD CONSTRAINT FK_ArtefactCost_ArtefactId FOREIGN KEY (ArtefactId) REFERENCES Artefact (ArtefactId);
ALTER TABLE Required ADD CONSTRAINT FK_Require_BuildingId FOREIGN KEY (BuildingId) REFERENCES Building (BuildingId);
ALTER TABLE Required ADD CONSTRAINT FK_Require_ArtefactId FOREIGN KEY (ArtefactId) REFERENCES Artefact (ArtefactId);
ALTER TABLE GuildBuildings ADD CONSTRAINT FK_GuildBuildings_GuildId FOREIGN KEY (GuildId) REFERENCES Guild (GuildId);
ALTER TABLE GuildBuildings ADD CONSTRAINT FK_GuildBuildings_BuildingId FOREIGN KEY (BuildingId) REFERENCES Building (BuildingId);
