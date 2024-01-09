-- kreira pogled
CREATE VIEW `SUME`.`SVEZAKAZANESECE` AS SELECT `ZAKAZANASECA`.`VrstaDrveta`,`ZAKAZANASECA`.`PovrsinaSume`,`ZAKAZANASECA`.`Datum`,`ZAKAZANASECA`.`Neto`,
`ZAKAZANASECA`.`Trosak` AS `UkupanTrosak` FROM `SUME`.`ZAKAZANASECA` iNNER JOIN `SUME`.`TROSKOVI` ON `SUME`.`ZAKAZANASECA`.`Trosak`=`SUME`.`TROSKOVI`.`UkupanTrosak`;

CREATE VIEW `SUME`.`SVESECEUNUTARMESTA` AS SELECT `ZAKAZANASECA`.`VrstaDrveta`,`ZAKAZANASECA`.`PovrsinaSume`,`ZAKAZANASECA`.`Datum`,`ZAKAZANASECA`.`Neto`,
`ZAKAZANASECA`.`Trosak` AS `UkupanTrosak`,`ZAKAZANASECA`.`Mesto` FROM `SUME`.`ZAKAZANASECA` iNNER JOIN `SUME`.`TROSKOVI` ON `SUME`.`ZAKAZANASECA`.`Trosak`=`SUME`.`TROSKOVI`.`UkupanTrosak`;

-- proverava da li uneti podatci vec postoje u DB
USE `SUME`;
DROP PROCEDURE IF EXISTS `DodajSecu`;
DELIMETER $$
USE `SUME`$$
CREATE PROCEDURE `DodajSecu` (IN VrstaDrvetaParametar varchar(30), IN PovrsinaSumeParametar FLOAT, IN DatumParametar date, IN NetoParametar int, IN MestoParametar varchar(30), IN TrosakParametar int)
BEGIN
INSERT INTO `ZAKAZANASECA` (`VrstaDrveta`, `PovrsinaSume`, `Datum`, `Neto`, `Mesto`, `Trosak`) VALUES (VrstaDrvetaParametar, PovrsinaSumeParametar, DatumParametar, NetoParametar, MestoParametar, TrosakParametar);
END
$$
DELIMETER $$;