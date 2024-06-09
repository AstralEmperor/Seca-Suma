-- proverava da li uneti podatci vec postoje u DB
USE `SUME`
DROP PROCEDURE IF EXISTS `ZakaziSecu`
DELIMITER $$
USE `SUME`$$
CREATE PROCEDURE `ZakaziSecu` (IN VrstaDrvetaParametar varchar(30), IN PovrsinaSumeIDParametar FLOAT, IN DatumParametar date, IN NetoParametar int, IN TrosakPriRaduIDParametar int , IN MestoParametar varchar(30), IN PlacenoUnapredParametar int)
BEGIN
INSERT INTO `ZAKAZANASECA` (`VrstaDrveta`, `PovrsinaSumeID`, `Datum`, `Neto`, `TrosakPriRaduID`, `Mesto`,`PlacenoUnapred`) VALUES (VrstaDrvetaParametar, PovrsinaSumeIDParametar, DatumParametar, NetoParametar, TrosakPriRaduIDParametar, MestoParametar, PlacenoUnapredParametar);
END
$$
DELIMITER $$