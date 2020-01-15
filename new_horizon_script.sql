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
	('andromeda1',null ,null , 'in preparazione', 'Nasa, Esa', 'Marte', 'stabilire una base operativa'),
    ('voyager3', 2/1/2025, null, 'in preparazione', 'Nasa, Esa, SpaceX', 'spazio profondo', 'esplorazione e raccolta dati');

insert into Utenti_Missioni(username, nome) values
	('marcello','andromeda1'),
    ('marcello','voyager3'),
    ('alberto','voyager3');

-- QUERY ---------------------------------------
