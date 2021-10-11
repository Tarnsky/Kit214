CREATE TABLE `tb_items` (
  `item_id` int(11) NOT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `seller` varchar(255) DEFAULT NULL,
  `item_price` float(11,2) NOT NULL,
  `IP_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (item_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_items` (`item_id`, `itemname`, `seller`, `item_price`, `IP_address`) VALUES
(1, 'BakingSoda', 'John', 5.00, '131.217.174.193'),
(2, 'Grassclippings', 'John', 10.00, '131.217.174.193'),
(3, 'BakingSoda', 'John', 15.00, '131.217.174.193'),
(4, 'kitten', 'John', 15.00, '131.217.174.193'),
(5, 'puppy', 'Paul', 5.00, '131.217.174.90'),
(6, 'kitten', 'Paul', 10.00, '131.217.174.90'),
(7, 'dragon', 'Paul', 15.00, '131.217.174.90'),
(8, 'BakingSoda', 'Paul', 15.00, '131.217.174.90');

CREATE TABLE `tb_users` (
  `user_id` int(11) NOT NULL,
  `account_balance` int(11) DEFAULT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_users` (`user_id`,`account_balance`) VALUES
(1, 55);