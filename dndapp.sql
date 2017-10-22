drop database if exists dndapp;
create database dndapp default character set utf8;
use dndapp;

#utf 8 on byethost
#alter database default character set utf8;


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


create table feat_and_trait(
id int not null primary key auto_increment,
name varchar(50),
description text
);

create table equipment(
id int not null primary key auto_increment,
name varchar(50),
type varchar(50),
distance int,
dmg varchar(50),
ac int
);

#izmjena vanjskih ključeva iz tablica equipment, skill i feat_and_tait tablica u nove, međutablice

create table pc_feat_and_trait(
pc 	int not null,
feat_and_trait 		int not null
);

create table pc_equipment(
pc 	int not null,
equipment 			int not null,
quantity int default 1
);





alter table adventure add foreign key(dm) references player(id);

alter table player_adventure add foreign key(player) references player(id);
alter table player_adventure add foreign key(adventure) references adventure(id);
alter table player_adventure add foreign key(pc) references pc(id);

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
			
insert into stat(strength,dexterity, constitution, intelligence, wisdom, charisma, pc) 
	values (15,17,13,12,15,7,1),
    (8,15,14,13,10,16,2),
    (8,17,14,10,14,12,3);
    
insert into equipment(name, type, distance, dmg, ac)
	values("Longbow", "P",60, "1d8",null),
		("Greataxe", "S", 0, "1d12", null),
        ("Dagger", "P", 20, "1d4", null),
        ("Leather Armor", "A", 0, null, 11),
        ("Studded Leather", "A", 0, null, 12),
        ("Shortsword", "P", 0, "1d6", null),
        ("Unarmed", "B", 0, "1d4", null),
        ("Dart", "P", 20, "1d4", null),
        ("Healing potion", "H", 0, "2d4 + 2", null),
        ("Rapier", "P", 0,"1d8",null ),
       	("Heavy Crossbow", "P", 100,"1d6",null ),
       	("Longsword", "S", 0,"1d8",null ),
       	("Pike", "P", 10,"1d10",null ),
       	("Javelin", "P", 30,"1d6",null ),
       	("Chainmail", "A", 0, null, 16),
       	("Shield", "A", 0,null,2),
       	("Maul", "B", 0,"2d6",null ),
	    ("Halberd", "S", 10,"1d10",null ),
	    ("Spear", "P", 20,"1d6",null ),
	    ("Warhammer", "B", 0,"1d8",null ),
	    ("Handaxe", "S", 0,"1d6",null );
        
insert into pc_equipment(pc, equipment)
	values(1,1),
		(1,2),
        (1,3),
        (1,4),
        (3,3),
        (3,5),
        (3,9),
        (2,6),
        (2,7),
        (2,8);
        
insert into feat_and_trait(name, description)
		values("Darkvision","can see 60 ft in the dark"),
        ("Fey Ancestry","Immune to Charmed and Sleep effects"),
        ("Poison resistance","Racial trait"),
        ("Spellcasting","Ability to cast spells"),
        ("Natural Explorer - Forest","An hour in forest makes you familiar with it and can easily find tracks and forage for food"),
        ("Favored Enemy - Dragon","You can feel presence of dragon one mile from you or 6 miles if in favored terrain"),
        ("Relentless Endurance","If reduced to 0 hit points but not killed outright, you can drop to 1 hit point instead. You can't use this feature again until you finish a long rest."),
        ("Second Wind","On your turn you can use a bonus action to regain hit points equal to 1d10 + your fighter level. Once you use this feature, you must finish a short or long rest before you can use it again.");        

    