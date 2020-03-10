CREATE DATABASE test default charset=utf8mb4;
GRANT ALL PRIVILEGES ON test.* TO test_user@'%' IDENTIFIED BY 'RootPass_1';
FLUSH PRIVILEGES;
