-- Convert every table from MyISAM to InnoDB (transactions, row locking,
-- crash recovery). InnoDB supports the FULLTEXT indexes the search pages
-- use on MySQL 5.6+ and MariaDB 10.0.5+. Safe to run more than once.
-- Back up first; on a large mice/transfers table this rebuilds the data.

ALTER TABLE `acl_resources` ENGINE=InnoDB;
ALTER TABLE `breeding_cages` ENGINE=InnoDB;
ALTER TABLE `cages` ENGINE=InnoDB;
ALTER TABLE `comments` ENGINE=InnoDB;
ALTER TABLE `default_user_prefs` ENGINE=InnoDB;
ALTER TABLE `global_prefs` ENGINE=InnoDB;
ALTER TABLE `litters` ENGINE=InnoDB;
ALTER TABLE `mice` ENGINE=InnoDB;
ALTER TABLE `permissions` ENGINE=InnoDB;
ALTER TABLE `protocols` ENGINE=InnoDB;
ALTER TABLE `roles` ENGINE=InnoDB;
ALTER TABLE `searches` ENGINE=InnoDB;
ALTER TABLE `strains` ENGINE=InnoDB;
ALTER TABLE `tags` ENGINE=InnoDB;
ALTER TABLE `transfers` ENGINE=InnoDB;
ALTER TABLE `users` ENGINE=InnoDB;
ALTER TABLE `user_prefs` ENGINE=InnoDB;
ALTER TABLE `weaning_cages` ENGINE=InnoDB;
