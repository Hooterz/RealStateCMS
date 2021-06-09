DROP DATABASE IF EXISTS RealState;
CREATE DATABASE RealState;

use RealState;

create table Location(
    lo_id int auto_increment primary key,
    lo_name varchar(100) unique
);

create table Image(
    img_id int auto_increment primary key,
    img_path varchar(500)
);

create table Property(
	prop_id varchar(25) primary key ,
	prop_name varchar(100) default '-' not null,
	prop_address varchar(100) default '-' not null,
	prop_location int not null,
	foreign key (prop_location) references Location(lo_id),
	prop_description text null,
	prop_area float null,
	prop_price double default 0 not null,
	prop_pubDate date null unique,
	prop_isHidden int
);

create table Property_Image(
    propImg_prop_id varchar(25),
    foreign key (propImg_prop_id) references Property(prop_id),
    propImg_img_id int,
    foreign key (propImg_img_id) references Image(img_id)
);


