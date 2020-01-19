set foreign_key_checks = 0;

drop table if exists Utente;
drop table if exists Messaggi;
drop table if exists Missioni;
drop table if exists Utenti_Missioni;

create table Utenti(
	username varchar(20) primary key,
    psswd varchar(25) not null,
    sesso enum('M','F','A'),
    e_mail varchar(30) not null,
    occupazione varchar(50),
    livello enum('generico','dipendente','amministratore'),
    foreign key(username) references messaggi(mittente) on delete cascade on update cascade,
	foreign key(username) references messaggi(destinatario) on delete cascade on update cascade
);

create table Messaggi (
	id smallint unsigned primary key,
    mittente varchar(20) not null references Utenti(username),
    destinatario varchar(20) not null references Utenti(username),
    oggetto varchar(100),
    testo varchar(2000)
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
	('Andromeda 1',5/4/2024 ,null , 'in preparazione', 'Nasa, Esa', 'Marte', 'stabilire una base operativa'),
		('Andromeda 2',null ,null ,'in preparazione' , 'Nasa, Esa, Unipd', 'Marte', 'studio e raccolta di materiali preziosi da Marte'),
		('AndromedaX 2',null ,null ,'in preparazione' , 'Nasa, Esa', 'Marte', 'rendere Marte non ostile all&rsquo uomo'),
		('AndromedaX 3',null ,null ,'in preparazione' , 'Nasa, Esa', 'Marte', 'rendere Marte abitabile dall&rsquo uomo'),
		('Venera 1', 12/2/1961, 19/2/1961, 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'prima prova di una sonda per raggiungere Venere'),
		('Mariner 1', 22/7/1962, 22/7/1962, 'fallita', 'Nasa, Asi, Cnsa', 'Venere', 'seconda prova di una sonda per raggiungere Venere'),
		('Mariner 2', 27/8/1962, 14/12/1962, 'terminata', 'Nasa, Asi, Cnsa', 'Venere', 'raccolta di informazioni sul pianeta Venere'),
		('Deus', 10/10/1990, 12/12/1990, 'rientrata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
		('Deus2', 15/1/1991, 16/5/1991, 'terminata', 'Nasa, Asi', 'Giove', 'raccolta di informazioni'),
		('Iuran 24', 19/1/2020, null, 'in corso', 'Nasa, Unipd, Cnsa', 'Urano', 'raccolta di informazioni riguardanti il pianeta Nettuno'),
    ('Voyager 3', 2/1/2025, null, 'in preparazione', 'Nasa, Esa, SpaceX, Maunakea', 'Spazio profondo', 'esplorazione e raccolta dati');

insert into Utenti_Missioni(username, nome) values
	('marcello','Andromeda 1'),
		('marcello','Andromeda 2'),
		('marcello','AndromedaX 2'),
		('marcello','AndromedaX 3'),
		('marcello','Venera 1'),
		('marcello','Mariner 2'),
		('marcello','Mariner 2'),
		('marcello','Deus'),
		('marcello','Deus2'),
		('marcello','Iuran 24'),
		('marcello','Voyager 3'),
    ('alberto','Voyager 3');

-- QUERY ---------------------------------------
