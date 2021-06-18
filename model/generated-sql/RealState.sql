
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- Feature
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Feature`;

CREATE TABLE `Feature`
(
    `feature_id` INTEGER NOT NULL AUTO_INCREMENT,
    `feature_content` VARCHAR(200),
    PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Image`;

CREATE TABLE `Image`
(
    `img_id` INTEGER NOT NULL AUTO_INCREMENT,
    `img_path` VARCHAR(500),
    PRIMARY KEY (`img_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Location`;

CREATE TABLE `Location`
(
    `lo_id` INTEGER NOT NULL AUTO_INCREMENT,
    `lo_name` VARCHAR(100),
    PRIMARY KEY (`lo_id`),
    UNIQUE INDEX `lo_name` (`lo_name`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Property
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Property`;

CREATE TABLE `Property`
(
    `prop_id` VARCHAR(25) NOT NULL,
    `prop_name` VARCHAR(100) DEFAULT '-' NOT NULL,
    `prop_address` VARCHAR(100) DEFAULT '-' NOT NULL,
    `prop_location` INTEGER NOT NULL,
    `prop_description` TEXT,
    `prop_area` FLOAT,
    `prop_price` DOUBLE DEFAULT 0 NOT NULL,
    `prop_pubDate` DATE,
    `prop_isHidden` INTEGER,
    PRIMARY KEY (`prop_id`),
    UNIQUE INDEX `prop_pubDate` (`prop_pubDate`),
    INDEX `prop_location` (`prop_location`),
    CONSTRAINT `property_ibfk_1`
        FOREIGN KEY (`prop_location`)
        REFERENCES `Location` (`lo_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Property_Feature
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Property_Feature`;

CREATE TABLE `Property_Feature`
(
    `propFeature_prop_id` VARCHAR(25),
    `propFeatureg_feature_id` INTEGER,
    INDEX `propFeature_prop_id` (`propFeature_prop_id`),
    INDEX `propFeatureg_feature_id` (`propFeatureg_feature_id`),
    CONSTRAINT `property_feature_ibfk_1`
        FOREIGN KEY (`propFeature_prop_id`)
        REFERENCES `Property` (`prop_id`),
    CONSTRAINT `property_feature_ibfk_2`
        FOREIGN KEY (`propFeatureg_feature_id`)
        REFERENCES `Feature` (`feature_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- Property_Image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `Property_Image`;

CREATE TABLE `Property_Image`
(
    `propImg_prop_id` VARCHAR(25),
    `propImg_img_id` INTEGER,
    INDEX `propImg_prop_id` (`propImg_prop_id`),
    INDEX `propImg_img_id` (`propImg_img_id`),
    CONSTRAINT `property_image_ibfk_1`
        FOREIGN KEY (`propImg_prop_id`)
        REFERENCES `Property` (`prop_id`),
    CONSTRAINT `property_image_ibfk_2`
        FOREIGN KEY (`propImg_img_id`)
        REFERENCES `Image` (`img_id`)
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
