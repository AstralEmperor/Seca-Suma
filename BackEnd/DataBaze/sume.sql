CREATE DATABASE `SUME` CHARACTER SET utf8 COLLATE utf8_general_ci;

create table `SUME`.`ZAKAZANASECA`
(
    DoprinosID          int not null AUTO_INCREMENT PRIMARY KEY,
    VrstaDrveta         varchar(30) not null,
    PovrsinaSume        FLOAT not null, 
    Datum               date not null,    
    Neto                int not null, 
    Mesto               varchar(30) not null,  
    Trosak              int not null,
    PlacenoUnapred      int null      
);

create table `SUME`.`MESTO`
(
    Mesto               varchar(30) not null PRIMARY KEY,
    UkupanBrojSeca      int not null
);

alter table `SUME`.`ZAKAZANASECA` add constraint pripada foreign key(Mesto) references `SUME`.`MESTO` (Mesto) on delete restrict on update cascade;

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
("Niš", 0),
("Zrenjanin", 0),
("Novi Sad", 0);

insert into `SUME`.`ZAKAZANASECA` (VrstaDrveta, PovrsinaSume, Datum, Neto, Mesto, Trosak, PlacenoUnapred) 
values 
("Smrča", 6, "2024-05-12", 11332, 'Niš', 72772, 25000),
("Bukva", 10, "2024-08-05", 13865,'Zrenjanin', 586050, 0),
("Bor", 5, "2024-03-24", 4134,'Novi Sad', 38000, 14000),
("Cer", 6, "2024-10-24", 10350, 'Zrenjanin', 32600, 0);

