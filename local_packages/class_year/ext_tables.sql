/**
* CUSTOM TABLES
*/
CREATE TABLE tx_classyear_domain_model_classroom (
  name varchar(255) DEFAULT '' NOT NULL,
  slug varchar(255) DEFAULT '' NOT NULL,
  tutor int(10) unsigned DEFAULT NULL,
  subjects int(11) DEFAULT '0' NOT NULL,
  students int(11) DEFAULT '0' NOT NULL,
  FOREIGN KEY (tutor) REFERENCES fe_users(uid)
);

CREATE TABLE tx_classyear_domain_model_subject (
  title varchar(255) DEFAULT '' NOT NULL,
  classrooms int(11) DEFAULT '0' NOT NULL,
);

CREATE TABLE tx_classyear_domain_model_exam (
  title varchar(255) DEFAULT '' NOT NULL,
  date varchar(255) DEFAULT '' NOT NULL,
  classroom int(10) unsigned DEFAULT NULL,
  subject int(10) unsigned DEFAULT NULL,
  questions varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_classyear_domain_model_examquestion (
  title varchar(255) DEFAULT '' NOT NULL,
  correct_answer INT DEFAULT NULL,
);

CREATE TABLE `cache_classyear` (
`id` int(10) UNSIGNED NOT NULL auto_increment,
`identifier` varchar(250) NOT NULL DEFAULT '',
`expires` int(10) UNSIGNED NOT NULL DEFAULT 0,
`content` longblob DEFAULT NULL,
PRIMARY KEY(id)
);

/**
* TABLE RELATIONSHIP MANY TO MANY
* ? Two sided many to many relation
*/
CREATE TABLE tx_classyear_mm_classroom_subject (
    uid_local int(10) unsigned DEFAULT NULL,
    uid_foreign int(10) unsigned DEFAULT NULL,
    sorting int(11) DEFAULT '0' NOT NULL,
    sorting_foreign int(11) DEFAULT '0' NOT NULL,
    KEY uid_local (uid_local),
    KEY uid_foreign (uid_foreign)
);

/**
* TABLES OVERRIDES
*/
CREATE TABLE fe_users (
  tx_classyear_classroom int(10) unsigned DEFAULT NULL,
  FOREIGN KEY (tx_classyear_classroom) REFERENCES tx_classyear_domain_model_classroom(uid)
);

CREATE TABLE tt_content (
    tx_classyear_random_image_url varchar(225) DEFAULT '' NOT NULL,
);