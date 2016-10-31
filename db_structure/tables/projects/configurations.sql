CREATE TABLE `project_configuration`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `project_id` INT(11) NOT NULL,
  `hash` VARCHAR(256) NOT NULL,
  `end_user_type` INT(11) NOT NULL,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (project_id) REFERENCES projects(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `project_configuration_version`(
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL,
  `project_id` INT(11) NOT NULL,
  `configuration_id` INT(11) NOT NULL,
  `version` VARCHAR(100) NOT NULL,
  `branch` VARCHAR(100) NOT NULL,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (project_id) REFERENCES projects(id),
  FOREIGN KEY (configuration_id) REFERENCES project_configuration(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;