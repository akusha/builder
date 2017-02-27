
DROP TABLE IF EXISTS `operation_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `operation_view` AS select `o`.`id` AS `id`,`o`.`date` AS `date`,`o`.`value` AS `value`,`k`.`name` AS `kname`,`s`.`name` AS `sname`,`a`.`name` AS `aname`,`k`.`id` AS `kid`,`s`.`id` AS `sid`,`a`.`id` AS `aid` from (((`operation` `o` join `kagent` `k` on((`o`.`k_id` = `k`.`id`))) join `state` `s` on((`o`.`s_id` = `s`.`id`))) join `acount` `a` on((`o`.`a_id` = `a`.`id`)));
