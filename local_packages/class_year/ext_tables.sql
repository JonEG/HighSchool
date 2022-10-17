CREATE TABLE tx_classyear_domain_model_classroom (
  name varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_classyear_domain_model_student (
  name varchar(255) DEFAULT '' NOT NULL,
  surname varchar(255) DEFAULT '' NOT NULL,
  email varchar(255) DEFAULT '' NOT NULL,
);

CREATE TABLE tx_classyear_domain_model_subject (
  title varchar(255) DEFAULT '' NOT NULL,
);