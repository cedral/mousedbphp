-- Demo logins: admin / admin and user / user (bcrypt via password_hash)
DELETE FROM `users`;
ALTER TABLE `users` AUTO_INCREMENT = 1;

INSERT INTO `users` (`username`, `password`, `role_id`, `active`) VALUES
('admin', '$2y$10$Fp4zaprNGbMq6FnOhDCosOTaGJ05O8P8SGV5dxjCnmbsvaAlWfLdy', 1, 1),
('user', '$2y$10$Z3zGTyy.5xANR34fHc6Ex.U8Z8quQpkD6P/Uyul2D4u5qOLzXGbrG', 1, 1);
