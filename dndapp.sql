#drop database if exists dndapp;
#create database dndapp default character set utf8;
#use dndapp;

create table player(
id 			int not null primary key auto_increment,
username 	varchar(59) not null,
password	char(32) not null,
email 		varchar(50) not null
);


create table pc(
id 			int not null primary key auto_increment,
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
adventure 	int not null,
pc 			int not null
);

create table stat(
id 					int not null primary key auto_increment,
strength    int not null,
dexterity    int not null,
constitution    int not null,
intelligence    int not null,
wisdom    int not null,
charisma    int not null,
pc 			int not null
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
pc 	int not null,
skill 				int not null
);

create table pc_feat_and_trait(
pc 	int not null,
feat_and_trait 		int not null
);

create table pc_equipment(
pc 	int not null,
equipment 			int not null
);





alter table adventure add foreign key(dm) references player(id);

alter table player_adventure add foreign key(player) references player(id);
alter table player_adventure add foreign key(adventure) references adventure(id);
alter table player_adventure add foreign key(pc) references pc(id);


alter table pc_skill add foreign key(pc) references pc(id);
alter table pc_skill add foreign key(skill) references skill(id);

alter table stat add foreign key(pc) references pc(id);

alter table pc_feat_and_trait add foreign key(pc) references pc(id);
alter table pc_feat_and_trait add foreign key(feat_and_trait) references feat_and_trait(id);

alter table pc_equipment add foreign key(pc) references pc(id);
alter table pc_equipment add foreign key(equipment) references equipment(id);


insert into player(username, password, email) 
	values	("Jurica",md5("password"), "juraos1@yahoo.com"),
			("Edunova",md5("e"), "edunova@gmail.com"),
			("Đuro", md5("1234"), "djuro@gmail.com");

insert into adventure(name, dm, synopsis) 
	values	("Test adventure", 1,"Forming adventure"),
			("Lost Mines Of Phandelver", 1, "Lorem ipsum"),
			("Tmeple Of Elemental Evil", 1, "You are in the tavern..."),	
        	("Out Of The Abyss", 1, "You are sitting in the tavern with your companions...");

insert into pc(name, race, class, level, background, alignment, hd, hp, proficiency) 
	values	("Bark", "Half-Orc", "Ranger", 3, "Outlander", "CG", "d10", 22, 2),
			("Bender","Halfling","Monk", 1,"Acolyte","LG","1d8" ,10 ,2 ),
			("Richard","Tiefling","Warlock", 1,"Hermit","LN","1d8" ,10 ,2 );
			
insert into  player_adventure(player, adventure, pc) 
	values	(1,3,3),
			(1, 1,1),
			(2,1,2);