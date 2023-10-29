CREATE DATABASE `SUME` CHARACTER SET utf8 COLLATE utf8_general_ci;

create table `SUME`.`PRETHODNESECE`
(
    doprinosID          int not null AUTO_INCREMENT PRIMARY KEY,
    VrstaDrveta         varchar(30) not null,
    PovršinaSume        FLOAT not null, 
    Datum               date not null,    
    Neto                INT not null    
);

create table `SUME`.`TROSKOVI`
(
    NazivDrveta         varchar(30) not null PRIMARY KEY,
    VrstaRada           varchar(100) not null,  
    Cena                FLOAT not null
);

alter table `SUME`.`PRETHODNESECE` add constraint IME foreign key(VrstaDrveta) references `SUME`.`TROSKOVI` (NazivDrveta) on delete restrict on update cascade;


insert into `SUME`.`TROSKOVI` (NazivDrveta, VrstaRada, Cena)
values
("Smrča", "Troškovi pri gajenju šuma", 72772),
("Bukva", "Proizvodnja drvnih sortimenata ", 586050),
("Četinari", "Uređivanje šuma", 38000),
("Cer", "Uređivanje šuma", 32600);

insert into `SUME`.`PRETHODNESECE` (VrstaDrveta, PovršinaSume, Datum, Neto) 
values 
("Smrča", 6, "2021-05-12", 11332),
("Bukva", 10, "2023-08-05", 13865),
("Četinari", 5, "2021-03-24", 4134),
("Cer", 6, "2022-10-24", 10350);
