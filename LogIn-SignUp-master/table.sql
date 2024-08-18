CREATE TABLE `android`.`users` (`Ladies_Club_ID` INT NOT NULL AUTO_INCREMENT , `f_name` VARCHAR(255) NOT NULL , `l_name` VARCHAR(255) NOT NULL , `spous_name` VARCHAR(255) NOT NULL , `spous_BA_No` INT UNSIGNED NOT NULL , `spous_rk` TINYINT NOT NULL , `unit` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` TEXT NOT NULL , `designation` VARCHAR(255) NULL , `birthday` DATE NOT NULL , `created_on` TIMESTAMP NOT NULL , PRIMARY KEY (`Ladies_Club_ID`), UNIQUE `email` (`email`), UNIQUE `pass` (`password`), UNIQUE (`spous_BA_No`), UNIQUE (`email`), UNIQUE (`password`)) ENGINE = InnoDB;
