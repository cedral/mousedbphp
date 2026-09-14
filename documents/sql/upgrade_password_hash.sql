-- Widen users.password so it can hold password_hash() output (60 chars
-- for bcrypt, longer for future algorithms). Existing MD5 values are left
-- in place; the application still accepts them and replaces each one with
-- a modern hash the next time that user's password is set.

ALTER TABLE `users` MODIFY `password` varchar(255) DEFAULT NULL;
