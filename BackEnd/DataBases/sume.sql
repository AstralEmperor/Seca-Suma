CREATE DATABASE `SUME` CHARACTER SET utf8 COLLATE utf8_general_ci;

create table `SUME`.`PRETHODNIPRINOS`
(
    doprinosID          int not null AUTO_INCREMENT PRIMARY KEY,
    VrstaDrveta         varchar(30) not null,
    PovršinaSume        FLOAT not null,    
    Bruto               INT not null,
    Otpad               INT not null,  
    Neto                INT not null     
);

create table `SUME`.`TROSKOVI`
(
    NazivDrveta         varchar(30) not null PRIMARY KEY,
    VrstaRada           varchar(30) not null,  
    Cena                FLOAT not null
);

alter table `SUME`.`PRETHODNIPRINOS` add constraint IME foreign key(VrstaDrveta) references `SUME`.`TROSKOVI` (NazivDrveta) on delete restrict on update cascade;


insert into `SUME`.`TROSKOVI` (NazivDrveta, VrstaRada, Cena)
values
("Smrča", "Troškovi pri gajenju šuma", 72772),
("Bukva", "Proizvodnja drvnih sortimenata ", 586050),
("Četinari", "Uređivanje šuma", 38000),
("Cer", "Uređivanje šuma", 32600);

insert into `SUME`.`PRETHODNIPRINOS` (VrstaDrveta, PovršinaSume,  Bruto, otpad, Neto) 
values 
("Smrča", 6, 13332, 2000, 11332),
("Bukva", 10, 16312, 2447, 13865),
("Četinari", 5, 4863, 729, 4134);
("Cer", 6, 13802, 3452,10350);
