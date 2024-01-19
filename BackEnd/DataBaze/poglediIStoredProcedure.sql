-- kreira pogled
CREATE VIEW `SUME`.`SVEZAKAZANESECE` AS SELECT `ZAKAZANASECA`.`DoprinosID`,`ZAKAZANASECA`.`VrstaDrveta`,`ZAKAZANASECA`.`PovrsinaSume`,`ZAKAZANASECA`.`Datum`,`ZAKAZANASECA`.`Neto`,`ZAKAZANASECA`.`Trosak`,
`MESTO`.`Mesto` AS `NazivMesta` FROM `SUME`.`ZAKAZANASECA` iNNER JOIN `SUME`.`MESTO` ON `SUME`.`ZAKAZANASECA`.`Mesto`=`SUME`.`MESTO`.`Mesto`;

CREATE VIEW `SUME`.`SVESECEPLACENEUNAPRED` AS SELECT `ZAKAZANASECA`.`DoprinosID`,`ZAKAZANASECA`.`VrstaDrveta`,`ZAKAZANASECA`.`PovrsinaSume`,`ZAKAZANASECA`.`Datum`,`ZAKAZANASECA`.`Neto`,`ZAKAZANASECA`.`Trosak`,
`MESTO`.`Mesto` AS `NazivMesta`, `ZAKAZANASECA`.`PlacenoUnapred` FROM `SUME`.`ZAKAZANASECA` iNNER JOIN `SUME`.`MESTO` ON `SUME`.`ZAKAZANASECA`.`Mesto`=`SUME`.`MESTO`.`Mesto`;

-- proverava da li uneti podatci vec postoje u DB
USE `SUME`
DROP PROCEDURE IF EXISTS `ZakaziSecu`
DELIMITER $$
USE `SUME`$$
CREATE PROCEDURE `ZakaziSecu` (IN VrstaDrvetaParametar varchar(30), IN PovrsinaSumeParametar FLOAT, IN DatumParametar date, IN NetoParametar int, IN TrosakParametar int , IN MestoParametar varchar(30), IN PlacenoUnapredParametar int)
BEGIN
INSERT INTO `ZAKAZANASECA` (`VrstaDrveta`, `PovrsinaSume`, `Datum`, `Neto`, `Trosak`, `Mesto`,`PlacenoUnapred`) VALUES (VrstaDrvetaParametar, PovrsinaSumeParametar, DatumParametar, NetoParametar, TrosakParametar, MestoParametar, PlacenoUnapredParametar);
END
$$
DELIMITER $$