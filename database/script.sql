drop database if exists marcs;
create database marcs default character set utf8 collate utf8_general_ci;
grant all on marcs.* to 'sbs'@'localhost' identified by 'sbs_toro';
use marcs;

create table kanja (
	no int auto_increment primary key,
  kanja_id varchar(100) not null unique,
	name varchar(100) not null,
	password varchar(100) not null,
	line_id int,
  line_name varchar(100),
  facility_code varchar(50),
  yoyaku_datetime varchar(10)
);

create table kanja_line (
  no int auto_increment primary key,
  kanja_id int not null,
	line_id int not null,
  line_name varchar(100) not null
);

insert into kanja values(null, '9000001', '駿河　葵', '9000001', '111111111', '駿河LINE', null, null);
insert into kanja values(null, '9000002', '静岡　菜々子', '9000002', '222222222', '菜々子LINE', null, null);
insert into kanja values(null, '9000003', '菊川　良子', '9000003', '333333333', '菊川LINE', null, null);

insert into kanja_line values(null, '9000001', '111111111', '駿河LINE');
insert into kanja_line values(null, '9000002', '222222222', '菜々子LINE');
insert into kanja_line values(null, '9000003', '333333333', '菊川LINE');
