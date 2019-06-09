drop database if exists marcs;
create database marcs default character set utf8 collate utf8_general_ci;
grant all on marcs.* to 'sbs'@'localhost' identified by 'sbs_toro';
use marcs;

create table kanja (
  kanja_id varchar(100) not null unique,
	name varchar(100) not null,
	password varchar(100) not null,
	line_id varchar(100) not null,
  line_name varchar(100),
  facility_code varchar(50),
  yoyaku_datetime varchar(10)
);

create table kanja_line (
  no SERIAL auto_increment primary key,
  kanja_id int not null,
	line_id varchar(100) not null not null,
  line_name varchar(100) not null
);

create table facility (
	no SERIAL primary key,
  facility_code varchar(50) not null unique,
	name varchar(100) not null,
	password varchar(100) not null
);

create table location (
  device_name varchar(50) not null,
  beacon_name varchar(100),
	uuid varchar(100),
	lat double precision,
  lon double precision,
  proximity varchar(10),
  update_datetime timestamp
);

create table device (
  device_name varchar(50) not null,
  name varchar(100)
);

create table beacon (
  uuid varchar(100) not null,
  name varchar(100),
  comment varchar(100)
);

-- insert into kanja values('9000001', '駿河　葵', '9000001', 'U657e8de8b409504ac329af7ebcefc723', '駿河LINE', '', '');
insert into kanja values('9000001', '駿河　葵', '9000001', '111111111', '駿河LINE', '', '');
insert into kanja values('9000002', '静岡　菜々子', '9000002', '222222222', '菜々子LINE', '', '');
insert into kanja values('9000003', '菊川　良子', '9000003', '333333333', '菊川LINE', '', '');

insert into kanja_line values(null, '9000001', '111111111', '駿河LINE');
insert into kanja_line values(null, '9000002', '222222222', '菜々子LINE');
insert into kanja_line values(null, '9000003', '333333333', '菊川LINE');

	insert into facility values(1, '1234567890', 'SBSクリニック', '1234567890');
	insert into facility values(2, '9876543210', 'MARCS診療所', '9876543210');

insert into device values('dmyr-iPhone6s', 'SBS太田');

insert into beacon values('D546DF97-4757-47EF-BE09-3E2DCBDD0C77', '医療2階', 'FeasyBeacom');
insert into beacon values('00000000-216E-1001-B000-001C4D64988A', 'ブースA', 'SK19008');
insert into beacon values('00000000-14FD-1001-B000-001C4D64F49A', 'ブースB', 'SK19009');
