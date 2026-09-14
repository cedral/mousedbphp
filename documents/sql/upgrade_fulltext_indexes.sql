-- FULLTEXT indexes required by the search pages.
--
-- The search controllers run MATCH ... AGAINST with these exact column
-- lists, and MySQL/MariaDB require a FULLTEXT index whose column list
-- matches exactly. create_database.sql only ever defined four of them, so
-- the mouse, litter, breeding cage, weaning cage, strain and wean-list
-- searches failed with error 1191. Run once on existing installs.

ALTER TABLE `comments`       ADD FULLTEXT KEY `ft_comment` (`comment`);
ALTER TABLE `cages`          ADD FULLTEXT KEY `ft_assigned_id` (`assigned_id`);
ALTER TABLE `litters`        ADD FULLTEXT KEY `ft_assigned_id` (`assigned_id`);
ALTER TABLE `breeding_cages` ADD FULLTEXT KEY `ft_mating_breeding` (`mating_type`,`breeding_type`);
ALTER TABLE `breeding_cages` ADD FULLTEXT KEY `ft_mating_type` (`mating_type`);
ALTER TABLE `strains`        ADD FULLTEXT KEY `ft_strain_name` (`strain_name`);
ALTER TABLE `strains`        ADD FULLTEXT KEY `ft_strain_promoter` (`strain_name`,`promoter`);
ALTER TABLE `users`          ADD FULLTEXT KEY `ft_username` (`username`);
