set foreign_key_checks = 0;

drop table if exists Utenti;
drop table if exists Messaggi;
drop table if exists Missioni;
drop table if exists Utenti_Missioni;

create table Utenti(
	username varchar(20) primary key,
    psswd varchar(25) not null,
    sesso enum('M','F','A'),
    e_mail varchar(30) not null,
    occupazione varchar(50),
    livello enum('generico','dipendente','amministratore')
);

create table Messaggi (
    mittente varchar(20) not null references Utenti(username),
    destinatario varchar(20) not null references Utenti(username),
    oggetto varchar(100),
    testo varchar(2000),
	foreign key(mittente) references Utenti(username) on delete cascade on update cascade,
	foreign key(destinatario) references Utenti(username) on delete cascade on update cascade
);

create table Missioni(
	nome varchar(25) primary key,
    data_inizio date,
    data_fine date,
	stato enum('in preparazione','in corso','rientrata','fallita','terminata') not null,
    affiliazioni varchar(200),
    destinazione varchar(40),
    scopo varchar(200)
);

create table Utenti_Missioni(
	username varchar(20) references Utenti(username) on delete cascade,
	nome varchar(25) references Missioni(nome) on delete cascade,
    primary key(username, nome)
);

-- inserimento dati ----------------------------------

insert into Utenti(username, psswd, sesso, e_mail, occupazione, livello) values
	('marcello', 'what is it', 'M', 'marcello@gmail.com', 'holding a gun', 'amministratore'),
    ('alberto', 'come and look', 'M', 'alberto@gmail.com', 'mamma mia','generico');

insert into Missioni(nome, data_inizio, data_fine, stato, affiliazioni, destinazione, scopo) values
	('Andromeda 1','2024-04-05' ,null , 'in preparazione', 'Nasa, Esa', 'Marte', 'stabilire una base operativa'),
		('Andromeda 2',null ,null ,'in preparazione' , 'Nasa, Esa, Unipd', 'Marte', 'studio e raccolta di materiali preziosi da Marte'),
		('AndromedaX 2',null ,null ,'in preparazione' , 'Nasa, Esa', 'Marte', 'rendere Marte non ostile all&#8217 uomo'),
		('AndromedaX 3',null ,null ,'in preparazione' , 'Nasa, Esa', 'Marte', 'rendere Marte abitabile dall&#8217 uomo'),
		('Venera 1', '1961-02-12', '1961-02-19', 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'prima prova di una sonda per raggiungere Venere'),
		('Mariner 1','1962-07-22', '1962-07-22', 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'seconda prova di una sonda per raggiungere Venere'),
		('Mariner 2','1962-08-27', '1962-12-14', 'terminata', 'Nasa, Asi, Cnsa', 'Venere', 'raccolta di informazioni sul pianeta Venere'),
		('Deus', '1990-10-10', '1990-12-12', 'rientrata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
		('Deus2', '1991-01-15', '1991-05-16', 'terminata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
		('Iuran 24', '2020-01-19', null, 'in corso', 'Nasa, Unipd, Cnsa', 'Urano', 'raccolta di informazioni riguardanti il pianeta Nettuno'),
    ('Voyager 3','2025-01-02', null, 'in preparazione', 'Nasa, Esa, SpaceX, Maunakea', 'Spazio profondo', 'esplorazione e raccolta dati');

insert into Utenti_Missioni(username, nome) values
	('marcello','Andromeda 1'),
		('marcello','Andromeda 2'),
		('marcello','AndromedaX 2'),
		('marcello','AndromedaX 3'),
		('marcello','Venera 1'),
		('marcello','Mariner 2'),
		('marcello','Deus'),
		('marcello','Deus2'),
		('marcello','Iuran 24'),
		('marcello','Voyager 3'),
    ('alberto','Voyager 3');

-- QUERY ---------------------------------------
