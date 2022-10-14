CREATE DATABASE ludubs;
USE ludubs;

CREATE TABLE IF NOT EXISTS `adminn` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_name VARCHAR(250) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `adminn` (`id`, `user_name`, `password`, `created_at`) VALUES
(1, 'theduy', '$2y$10$X6vPuK04eJnuE0873bkHlOZwSCi6iDX4LBVkB/M0ej6ouVzi4gUbu', '2021-03-06 12:50:20');
INSERT INTO `adminn` (`id`, `user_name`, `password`, `created_at`) VALUES
(2, 'tanluc', '$2y$10$IEtcuucUEtkeRINgTR/0o.tO9/CzVp8nr.tyZNYW2ihQfmIc6UKEq', '2021-03-06 12:52:19');



CREATE TABLE IF NOT EXISTS `users` (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  user_name VARCHAR(250) NOT NULL UNIQUE,
  user_email VARCHAR(250) NOT NULL,
  phonenum VARCHAR(250) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `users` (`id`, `user_name`,`user_email`,`phonenum`, `password`, `created_at`) VALUES
(1, 'ludu', 'thanhvienludu@gmail.com', '+91 033456789','$2y$10$sLpwDWy6jOGWV99he1upZOEJXZ8OSwXPnZN/gReeczpBOyrZQ7iV.', '2022-09-12 17:56:41'),
(2, 'ludu2', 'ludu@gmail.com', '+91 033456789','f8115b07c35e7036fb0bf650069753a5', '2022-09-13 17:56:41');



CREATE TABLE IF NOT EXISTS `books` (
    bookid INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    author VARCHAR(250) NOT NULL,
    description VARCHAR(250) NOT NULL,
    category VARCHAR(250) NOT NULL,
    price INT(250) NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
	image text NOT NULL
);
/* CATEGORY */
/* Travel */
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'In a Sunburned Country', 'Bill Bryson', 'Every time Bill Bryson walks out the door, memorable travel literature threatens to break out. His previous excursion along the Appalachian Trail resulted in the sublime national bestseller A Walk in the Woods. In A Sunburned Country is his report ... Read full overview', 'Travel', 179000, '2020-07-26 08:02:31', 'https://i.ibb.co/y8qxKgj/In-a-Sunburned-Country.webp');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Into the Wild', 'Jon Krakauer', 'In April 1992 a young man from a well-to-do family hitchhiked to Alaska and walked alone into the wilderness north of Mt. McKinley. His name was Christopher Johnson McCandless. He had given $25,000 in savings to charity, abandoned his car and most of ... Read full overview', 'Travel', 162000, '2020-08-12 08:02:31', 'https://i.ibb.co/Q6xCmbD/Into-the-Wild.webp');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, '1,000 Places to See Before You Die', 'Patricia Schultz', 'For adventurers and armchair travelers, it is an unforgettable and inspiring year. Here are hundreds of exciting destinations in full color. Visit Krakow is Ryenek Glowny, the most authentic medieval market square in Europe. The lush Siwa Oasis of Egyp ... Read full overview', 'Travel', 294000, '2020-11-08 08:02:31', 'https://i.ibb.co/r3Z1k3V/1-000-Places-to-See-Before-You-Die.webp');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Dear Bob and Sue', 'Karen Smith, Matt Smith', 'Taking a mid-career break to travel to all 58 U.S. National Parks, the authors describe their sense of awe in exploring the parks and share humorous and quirky observationsNin the form of e-mails written to their friends.', 'Travel', 778000, '2020-07-26 08:02:31', 'https://i.ibb.co/f0SGXxm/Dear-Bob-and-Sue.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Parisian Chic', 'Ines De La Fressange, Sophie Gachet', 'Celebrity model Ines de la Fressange shares the well-kept secrets of how Parisian women maintain effortless glamour and a timeless allure. Her step-by-step do is and donts are accompanied by fashion photography, and the book is personalized with her charming drawings.', 'Travel', 264000, '2017-06-20 08:02:31', 'https://i.ibb.co/71zmtGp/Parisian-Chic.webp');

/* Wildlife */
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Never Cry Wolf', 'Farley Mowat', 'The classic of nature writing--the spellbinding story of adventures among arctic wolves--is now available in a new paperback edition.', 'Wildlife', 713000, '2021-07-26 08:02:31', 'https://i.ibb.co/xSX6F5X/Never-Cry-Wolf.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'The Genius of Birds', 'Jennifer Ackerman', 'Birds are astonishingly intelligent creatures. In fact, according to revolutionary new research, some birds rival primates and even humans in their remarkable forms of intelligence. Like humans, many birds have enormous brains relative to their size. ... Read full overview', 'Wildlife', 796000, '2021-08-22 08:02:31', 'https://i.ibb.co/41MSnyM/The-Genius-of-Birds.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Unlikely Friendships', 'Jennifer S. Holland', 'Jennifer S. Holland is a senior writer for National Geographic magazine, specializing in science and natural history. She is the author of The New York Times Bestselling titles Unlikely Friendships and Unlikely Loves.', 'Wildlife', 207000, '2021-08-22 08:02:31', 'https://i.ibb.co/Z6b6qbh/Unlikely-Friendships.webp');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Does It Fart', 'Nick Caruso, Dani Rabaiotti', 'The New York Times bestselling sensation A scientifically rigorous, fully illustrated guide to animal flatulence that will delight readers of all ages. Dogs do it. Millipedes do it. Dinosaurs did it. You do it. I do it. Octopuses dont ... Read full overview', 'Wildlife', 713000, '2021-08-22 08:02:31', 'https://i.ibb.co/D7zYCMJ/Does-It-Fart.jpg');

/* Nature */
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'What Is That Tree', 'Dorling Kindersley Publishing Staff', 'Suitable for identifying common trees, this book is helpful if you struggle to tell the difference between a Serbian spruce and a Silver birch. It shows you what to look for where and related trees are shown side by side for quick comparison and identification.', 'Nature', 184000, '2021-07-26 08:02:31', 'https://i.ibb.co/2tf4FpX/What-Is-That-Tree.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'A Tree for All Seasons', 'Robin Bernard', 'This picture book records the growth progress of a maple tree over a period of time to illustrate what trees do and how the seasons change. Beautiful full-color photographs and simple text introduce young readers to the wonders of the seasons.', 'Nature', 737000, '2021-07-26 08:02:31', 'https://i.ibb.co/py1HXM3/A-Tree-for-All-Seasons.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'National Wildlife Federation', 'Bruce Kershner', 'This single, portable volume features more than 700 tree species and varieties, with special emphasis on their leaves, bark, fruits, and flowers. More than 2,000 stunning images show these trees in their natural habitats. The guide is unique waterproof cover makes it especially valuable for use in the field.', 'Nature', 888000, '2021-07-26 08:02:31', 'https://i.ibb.co/2MKT6n6/National-Wildlife-Federation.jpg');
INSERT INTO `books`(`bookid`, `name`, `author`, `description`, `category`, `price`, `date`, `image`) VALUES (NULL, 'Wildwood', 'Roger Deakin', 'Celebrates the transforming magic of trees, exploring the fifth element of wood as it exists in nature, in our souls, in our culture and our lives.', 'Nature', 200000, '2021-07-26 08:02:31', 'https://i.ibb.co/1ds9t8R/Wildwood.webp');


CREATE TABLE IF NOT EXISTS `customers` (
  customerid INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) NOT NULL,
  address VARCHAR(80) NOT NULL,
  city VARCHAR(30) NOT NULL,
  state VARCHAR(60) NOT NULL,
  zip_code VARCHAR(10) NOT NULL
);

INSERT INTO `customers` (`customerid`, `name`, `address`, `city`,`state`,`zip_code`) VALUES (1, 'Neha Jha', 'E-273, Delta-1', 'Greater Noida', 'Uttar Pradesh', '201310');
INSERT INTO `customers` (`customerid`, `name`, `address`, `city`,`state`,`zip_code`) VALUES(2, 'Nirali Sahoo', 'D-6/88 Kendriya Vihar', 'Bhubaneswar', 'Odisha', '752054');




CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  `customerid` INT NOT NULL,
  `amount` decimal(6,2) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ship_name` VARCHAR(60) NOT NULL,
  `ship_address` VARCHAR(80) NOT NULL,
  `ship_city` VARCHAR(30) NOT NULL,
  `ship_state` VARCHAR(20) NOT NULL,
  `ship_zip_code` VARCHAR(10) NOT NULL
);

INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `ship_name`, `ship_address`, `ship_city`, `ship_state`, `ship_zip_code`) VALUES (1, 1, '800.00', '2021-03-16 12:30:12', 'Neha Jha', 'E-273, Delta-1', 'Greater Noida', 'Uttar Pradesh', '201310');
INSERT INTO `orders` (`orderid`, `customerid`, `amount`, `date`, `ship_name`, `ship_address`, `ship_city`, `ship_state`, `ship_zip_code`) VALUES (2, 2, '650.00', '2021-03-20 20:34:21', 'Nirali Sahoo', 'D-6/88 Kendriya Vihar', 'Bhubaneswar', 'Odisha', '752054');



CREATE TABLE IF NOT EXISTS `order_items` (
  `orderid` INT NOT NULL,
  `book_isbn` VARCHAR(20) NOT NULL,
  `item_price` decimal(6,2) NOT NULL,
  `quantity` INT NOT NULL
);

INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES (1, '14', '800.00', 1);
INSERT INTO `order_items` (`orderid`, `book_isbn`, `item_price`, `quantity`) VALUES (2, '12', '650.00', 1);