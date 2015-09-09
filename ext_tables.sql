---
-- Sponsors
---
CREATE TABLE tx_t3sponsors_companies (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource text NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	name1 varchar(150) DEFAULT '' NOT NULL,
	name2 varchar(150) DEFAULT '' NOT NULL,
	description text NOT NULL,
	comment text NOT NULL,
	damlogo int(11) DEFAULT '0' NOT NULL,
	dampictures int(11) DEFAULT '0' NOT NULL,
	logo text NOT NULL,
	pictures text NOT NULL,
	hasreport tinyint(4) DEFAULT '0' NOT NULL,

	address varchar(150) DEFAULT '' NOT NULL,
	zip varchar(150) DEFAULT '' NOT NULL,
	city varchar(150) DEFAULT '' NOT NULL,
	country int(11) DEFAULT '0' NOT NULL,
	countrycode varchar(20) DEFAULT '' NOT NULL,
	www varchar(150) DEFAULT '' NOT NULL,
	email varchar(150) DEFAULT '' NOT NULL,
	phone varchar(150) DEFAULT '' NOT NULL,
	fax varchar(150) DEFAULT '' NOT NULL,
	mobile varchar(150) DEFAULT '' NOT NULL,
	contactfirstname varchar(150) DEFAULT '' NOT NULL,
	contactlastname varchar(150) DEFAULT '' NOT NULL,
	lng tinytext,
	lat tinytext,
	tags text NOT NULL,
	openingtime tinytext,

	categories int(11) DEFAULT '0' NOT NULL,
	trades int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);



CREATE TABLE tx_t3sponsors_categories (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource text NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	name varchar(150) DEFAULT '' NOT NULL,
	description text NOT NULL,
	damlogo int(11) DEFAULT '0' NOT NULL,
	logo text NOT NULL,

	sponsors int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_t3sponsors_categories_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	tablenames varchar(30) DEFAULT '' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);



CREATE TABLE tx_t3sponsors_trades (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sorting int(10) DEFAULT '0' NOT NULL,
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l18n_parent int(11) DEFAULT '0' NOT NULL,
	l18n_diffsource text NOT NULL,
	deleted tinyint(4) DEFAULT '0' NOT NULL,
	hidden tinyint(4) DEFAULT '0' NOT NULL,

	name varchar(150) DEFAULT '' NOT NULL,
	description text NOT NULL,
	logo int(11) DEFAULT '0' NOT NULL,
	t3logo text NOT NULL,

	sponsors int(11) DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

CREATE TABLE tx_t3sponsors_trades_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	tablenames varchar(30) DEFAULT '' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

