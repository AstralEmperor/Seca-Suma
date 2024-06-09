CREATE DATABASE `SUME` CHARACTER SET utf8 COLLATE utf8_general_ci;

create table `SUME`.`ZAKAZANASECA`
(
    SecaID          int not null AUTO_INCREMENT PRIMARY KEY,
    VrstaDrveta         varchar(30) not null,
    PovrsinaSumeID      int not null, 
    Datum               date not null,    
    Neto                int not null, 
    TrosakPriRaduID     int not null,
    Mesto               varchar(30) not null,  
    PlacenoUnapred      int null
);

create table `SUME`.`MESTO`
(
    Mesto               varchar(30) not null PRIMARY KEY,
    UkupanBrojSeca      int not null
);

create table `SUME`.`TROSAK`
(
    trosakID        int not null AUTO_INCREMENT PRIMARY KEY,
    ukupanTrosak    int not null,
    plate           int not null,
    prevozniTrosak  int not null,
    masineTrosak    int not null
);

create table `SUME`.`POVRSINA`
(
    povrsinaID      int not null AUTO_INCREMENT PRIMARY KEY,
    povrsinaZaSecu  FLOAT not null,
    ukupnaPovrsina  FLOAT not null,
    mladice         FLOAT not null,
    praznina        FLOAT not null
);

alter table `SUME`.`ZAKAZANASECA` add constraint pripada foreign key (Mesto) references `SUME`.`MESTO` (Mesto) on delete restrict on update cascade;
alter table `SUME`.`ZAKAZANASECA` add constraint potrosnja foreign key (TrosakPriRaduID) references `SUME`.`TROSAK` (trosakID) on delete restrict on update cascade;
alter table `SUME`.`ZAKAZANASECA` add constraint povrsina foreign key (PovrsinaSumeID) references `SUME`.`POVRSINA` (povrsinaID) on delete restrict on update cascade;

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

insert into `SUME`.`MESTO` (Mesto,UkupanBrojSeca)
values
("Niš", 1),
("Zrenjanin", 2),
("Novi Sad", 1);

insert into `SUME`.`TROSAK` (ukupanTrosak, plate, prevozniTrosak,  masineTrosak)
values
(72772, 50000, 7772, 15000),
(586050, 150000, 36050, 400000),
(38000, 20000, 5500, 12500),
(32600, 15500, 3100, 14000);

insert into `SUME`.`POVRSINA` (ukupnaPovrsina, mladice,  praznina, povrsinaZaSecu)
values
(9, 2, 1, 6),
(12, 2 ,1, 10),
(9, 4, 0, 5),
(11, 3, 2, 7);

insert into `SUME`.`ZAKAZANASECA` (VrstaDrveta, PovrsinaSumeID, Datum, Neto, TrosakPriRaduID, Mesto, PlacenoUnapred) 
values 
("Smrča", 1, "2024-05-12", 11332, 1,'Niš', 25000),
("Bukva", 2, "2024-08-05", 13865, 2, 'Zrenjanin', 0),
("Bor", 3, "2024-03-24", 4134, 3, 'Novi Sad', 14000),
("Cer", 4, "2024-10-24", 10350, 4, 'Zrenjanin', 0);

