/**
* CUSTOM TABLES
*/
CREATE TABLE tx_classyear_domain_model_classroom (
  name varchar(255) DEFAULT '' NOT NULL,
  tutor int(10) unsigned DEFAULT NULL,
  FOREIGN KEY (tutor) REFERENCES fe_users(uid)
);

CREATE TABLE tx_classyear_domain_model_subject (
  title varchar(255) DEFAULT '' NOT NULL,
);

/**
* TABLES OVERRIDES
*/
CREATE TABLE fe_users (
  tx_classyear_classroom int(10) unsigned DEFAULT NULL,
  FOREIGN KEY (tx_classyear_classroom) REFERENCES tx_classyear_domain_model_classroom(uid)
);