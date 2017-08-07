#drop database if exists dndapp;
#create database dndapp default character set utf8;
use dndapp;

create table player(
id 			int not null primary key auto_increment,
username 	varchar(59) not null,
password	char(32) not null,
email 		varchar(50) not null
);


create table player_character(
id 			int not null primary key auto_increment,
player_adventure int not null,
name 		varchar(50) not null,
race 		varchar(50) not null,
class 		varchar(50) not null,
level 		int not null,
background	varchar(50) not null,
alignment	varchar(50),
hd 			varchar(5),
hp 			int,
proficiency int
);

create table adventure(
id 			int not null primary key auto_increment,
name 		varchar(50) not null,
dm 			int not null,
synopsis 	text
);

create table player_adventure(
id 			int not null primary key auto_increment,
player 		int not null,
adventure 	int not null
);

create table stat(
id 					int not null primary key auto_increment,
strength    int not null,
dexterity    int not null,
constitution    int not null,
intelligence    int not null,
wisdom    int not null,
charisma    int not null,
player_character int
);

create table skill(
id int not null primary key auto_increment,
name varchar(50),
stat_link varchar(50),
proficiency boolean,
value int
);

create table feat_and_trait(
id int not null primary key auto_increment,
name varchar(50),
description varchar(50)
);

create table equipment(
id int not null primary key auto_increment,
name varchar(50),
type varchar(50),
distance int,
dmg varchar(50)
);

#izmjena vanjskih ključeva iz tablica equipment, skill i feat_and_tait tablica u nove, međutablice

create table pc_skill(
player_character 	int not null,
skill 				int not null
);

create table pc_feat_and_trait(
player_character 	int not null,
feat_and_trait 		int not null
);

create table pc_equipment(
player_character 	int not null,
equipment 			int not null
);



alter table player_character add foreign key(player_adventure) references player_adventure(id);

alter table adventure add foreign key(dm) references player(id);

alter table player_adventure add foreign key(player) references player(id);
alter table player_adventure add foreign key(adventure) references adventure(id);


alter table pc_skill add foreign key(player_character) references player_character(id);
alter table pc_skill add foreign key(skill) references skill(id);

alter table stat add foreign key(player_character) references player_character(id);

alter table pc_feat_and_trait add foreign key(player_character) references player_character(id);
alter table pc_feat_and_trait add foreign key(feat_and_trait) references feat_and_trait(id);

alter table pc_equipment add foreign key(player_character) references player_character(id);
alter table pc_equipment add foreign key(equipment) references equipment(id);


