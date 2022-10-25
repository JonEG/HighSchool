/**
* CUSTOM TABLES
*/
CREATE TABLE tx_classyear_domain_model_classroom (
  name varchar(255) DEFAULT '' NOT NULL,
  slug varchar(255) DEFAULT '' NOT NULL,
  tutor int(10) unsigned DEFAULT NULL,
  subjects int(11) DEFAULT '0' NOT NULL,
  FOREIGN KEY (tutor) REFERENCES fe_users(uid)
);

CREATE TABLE tx_classyear_domain_model_subject (
  title varchar(255) DEFAULT '' NOT NULL,
  classrooms int(11) DEFAULT '0' NOT NULL,
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