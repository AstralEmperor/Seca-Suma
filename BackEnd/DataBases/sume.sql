
create table `SUME`.`ZAKAZANASECA`
(
    DoprinosID          int not null AUTO_INCREMENT PRIMARY KEY,
    VrstaDrveta         varchar(30) not null,
    PovrsinaSume        FLOAT not null, 
    Datum               date not null,    
    Neto                int not null, 
    Mesto               varchar(30) not null,  
    Trosak              int not null
);

create table `SUME`.`TROSKOVI`
(
    UkupanTrosak        int not null  PRIMARY KEY,
    NazivDrveta         varchar(30) not null
);

alter table `SUME`.`ZAKAZANASECA` add constraint pripada foreign key(Trosak) references `SUME`.`TROSKOVI` (UkupanTrosak) on delete restrict on update cascade;

create table `SUME`.`KORISNIK`
(
    KorisnikID      int not null AUTO_INCREMENT PRIMARY KEY,
    Prezime         varchar(30) not null,
    Ime             varchar(30) not null,
    Email           varchar(40) not null,
    KorisnickoIme   varchar(30) not null,
    Sifra           varchar(30) not null,
    Ovlascenje      varchar(20) not null
);

insert into `SUME`.`KORISNIK`(Prezime, Ime, Email, KorisnickoIme, Sifra, Ovlascenje)
values
("Kovacevic", "Marko", "kovacevic.marko@gmail.com", "Mare", "marko97", "admin"),
("Jovanovic", "Nikolina", "jovanoc.nikolina@gmail.com", "Niki", "najbolja023", "korisnik");

insert into `SUME`.`TROSKOVI` (NazivDrveta,UkupanTrosak)
values
("Smrča", 72772),
("Bukva", 586050),
("Bor", 38000),
("Cer", 32600);

insert into `SUME`.`ZAKAZANASECA` (VrstaDrveta, PovrsinaSume, Datum, Neto, Mesto, Trosak) 
values 
("Smrča", 6, "2024-05-12", 11332, 'Niš', 72772),
("Bukva", 10, "2024-08-05", 13865,'Zrenjanin', 586050),
("Bor", 5, "2024-03-24", 4134,'Novi Sad', 38000),
("Cer", 6, "2024-10-24", 10350, 'Zrenjanin', 32600);

