-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2019 年 05 月 24 日 14:11
-- 服务器版本: 5.5.53
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `ass`
--

-- --------------------------------------------------------

--
-- 表的结构 `kit202_product`
--

CREATE TABLE IF NOT EXISTS `kit202_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COMMENT='产品表' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `kit202_product`
--

INSERT INTO `kit202_product` (`id`, `name`, `price`, `description`, `images`) VALUES
(1, 'latte ', 5, 'A latte is a coffee drink made with espresso and steamed milk. The term as used in English is a shortened form of the Italian caffè latte, caffelatte or caffellatte, which means milk coffee', './pic/caffelatte.png'),
(2, 'cappuccino', 5, 'A cappuccino is an espresso-based coffee drink that originated in Italy, and is traditionally prepared with steamed milk foam "', './pic/Cappuccino.png'),
(3, 'flat white', 5, 'A flat white is a coffee drink consisting of espresso with microfoam (steamed milk with small, fine bubbles and a glossy or velvety consistency)', './pic/bacon.jpg'),
(4, 'bacon, egg and cheese sandwich', 15, 'A bacon, egg and cheese sandwich is a breakfast sandwich popular in the United States. The sandwich is typically made with bacon, eggs (typically fried or scrambled), cheese and bread, which may be buttered and toasted.', './pic/pancake.jpg'),
(5, 'pancake', 15, 'A pancake is a flat cake, often thin and round, prepared from a starch-based batter that may contain eggs, milk and butter and cooked on a hot surface such as a griddle or frying pan, often frying with oil or butter.', './pic/cafe-latte.jpg'),
(6, 'tea', 20, 'A pancake is a flat cake, often thin and round, prepared from a starch-based batter that may contain eggs, milk and butter and cooked on a hot surface such as a griddle or frying pan, often frying with oil or butter.', './pic/cafe-latte.jpg'),
(13, 'Burger', 10, 'deliciousdeliciousdeliciousdeliciousdeliciousdeliciousdeliciousdelicious', './pic/cafe-latte.jpg'),
(14, 'Burger', 10, 'delicious', './pic/cafe-latte.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Price` double NOT NULL,
  `Description` varchar(128) NOT NULL,
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) DEFAULT NULL,
  `order_sn` varchar(128) DEFAULT NULL,
  `price` double unsigned DEFAULT NULL,
  `description` varchar(256) DEFAULT NULL,
  `inputtime` int(11) DEFAULT '0',
  `pickuptime` varchar(50) DEFAULT NULL,
  `goods_name` varchar(255) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  UNIQUE KEY `OrderID` (`orderid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `orders`
--

INSERT INTO `orders` (`orderid`, `username`, `order_sn`, `price`, `description`, `inputtime`, `pickuptime`, `goods_name`, `goods_id`) VALUES
(1, 'jianyi1', '2019051910275124053', 5, '', 1558276071, '730', 'latte ', 1),
(2, 'jianyi2', '2019052101550385731', 40, '', 1558418103, '730', 'tea', 6),
(3, 'jianyi2', '2019052102025473928', 20, '', 1558418574, '730', 'tea', 6),
(4, 'jianyi2', '2019052102034678336', 15, '', 1558418626, '730', 'pancake', 5),
(5, 'jianyi2', '2019052102071097854', 20, '', 1558418830, '730', 'tea', 6),
(6, 'jianyi3', '2019052102302212459', 40, '', 1558420222, '730', 'tea', 6),
(7, 'jianyi3', '2019052102303284098', 40, '', 1558420232, '1000', 'tea', 6),
(8, 'jianyi3', '2019052102350317788', 20, '', 1558420503, '730', 'Burger', 13),
(9, 'jianyi3', '2019052102432387738', 30, 'hot', 1558421003, '730', 'Burger', 15),
(10, 'jianyi4', '2019052103243070215', 5, 'hot', 1558423470, '945', 'latte ', 1),
(11, 'jianyi4', '2019052103243011982', 5, 'cold', 1558423470, '945', 'cappuccino', 2),
(12, 'jianyi4', '2019052103243011029', 5, '1 suger', 1558423470, '945', 'flat white', 3),
(13, 'jianyi4', '2019052209192147790', 20, '', 1558487961, '945', 'Burger', 14),
(14, 'jianyi1', '2019052209571094614', 20, '', 1558490230, '1045', 'Burger', 14),
(15, 'jianyi2', '2019052210162150988', 20, '', 1558491381, '1045', 'Burger', 13),
(16, 'jianyi5', '2019052204470193762', 20, '', 1558514821, '730', 'Burger', 14),
(17, 'jianyi5', '2019052204493845773', 10, '', 1558514978, '730', 'Burger', 14),
(18, 'jianyi0', '2019052204521772995', 80, '', 1558515137, '730', 'Burger', 14),
(19, 'jianyi0', '2019052204523266137', 90, '', 1558515152, '730', 'Burger', 13),
(20, 'jianyi2', '2019052401420799356', 40, '', 1558676527, '1200', 'Burger', 14);

-- --------------------------------------------------------

--
-- 表的结构 `staff_list`
--

CREATE TABLE IF NOT EXISTS `staff_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '名字',
  `position` text NOT NULL COMMENT '职位',
  `branch` text NOT NULL COMMENT '分店',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COMMENT='员工表（董事长）' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `staff_list`
--

INSERT INTO `staff_list` (`id`, `name`, `position`, `branch`) VALUES
(2, 'Jack', 'Stuff', 'Hobart'),
(3, 'Kent', 'Manager', 'Hobart'),
(4, 'Bill', 'Manager', 'Hobart'),
(10, 'Bill7', 'Manager', 'Hobart'),
(11, 'Bill64', 'Manager', 'Hobart'),
(12, 'Bill', 'Manager', 'Hobart'),
(13, 'Bill', 'Manager', 'Hobart'),
(16, 'Jack', 'Stuff', 'Hobart'),
(17, 'Bill5', 'Manager', 'Hobart'),
(18, 'jianyi3', 'Manager', 'Melbourne'),
(19, 'Bill77', 'Manager', 'Hobart'),
(20, 'Jack5', 'Stuff', 'Hobart'),
(21, 'Bill99', 'Stuff', 'Hobart');

-- --------------------------------------------------------

--
-- 表的结构 `store_date`
--

CREATE TABLE IF NOT EXISTS `store_date` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `week_name` varchar(50) DEFAULT NULL,
  `open_time` varchar(50) DEFAULT NULL,
  `close_time` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COMMENT='开店，关店时间' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `store_date`
--

INSERT INTO `store_date` (`id`, `week_name`, `open_time`, `close_time`) VALUES
(2, 'Mon', '7:00AM', '7:00PM'),
(3, 'Tue', '7:00AM', '7:00PM'),
(4, 'Wed', '7:00AM', '7:00PM'),
(5, 'Thu', '7:00AM', '7:00PM'),
(6, 'Fri', '7:00AM', '7:00PM'),
(7, 'Sat', '7:00AM', '7:00PM'),
(8, 'Sun', '7:00AM', '7:00PM');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `permission` varchar(8) DEFAULT NULL COMMENT 'permission',
  `discount` int(10) unsigned DEFAULT '100' COMMENT 'discount',
  `balance` int(10) unsigned DEFAULT '0' COMMENT 'balance',
  `username` varchar(128) DEFAULT NULL COMMENT 'username',
  `passwrod` varchar(128) DEFAULT NULL COMMENT '密码',
  `firstname` varchar(64) DEFAULT NULL COMMENT '第一个名字',
  `lastname` varchar(64) DEFAULT NULL COMMENT '姓氏',
  `mobile` varchar(10) DEFAULT NULL COMMENT '手机号码',
  `card` varchar(16) DEFAULT NULL COMMENT 'CR card',
  `email` varchar(128) DEFAULT NULL COMMENT '邮箱',
  `sex` varchar(10) DEFAULT NULL COMMENT '性别',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=63 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `permission`, `discount`, `balance`, `username`, `passwrod`, `firstname`, `lastname`, `mobile`, `card`, `email`, `sex`) VALUES
(57, 'BM', 20, 96, 'jianyi1', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '52000000', 'jianyil@utas.edu.au', 'Male'),
(58, 'CM', 15, 91, 'jianyi2', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '1234567890987654', 'jianyil@utas.edu.au', 'Male'),
(59, 'UE', 100, 100, 'jianyi3', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '12344567890', 'jianyil@utas.edu.au', 'Male'),
(60, 'CS', 90, 100, 'jianyi4', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '12134567890', 'jianyil@utas.edu.au', 'Male'),
(61, 'US', 93, 72, 'jianyi5', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '1234567890', 'jianyil@utas.edu.au', 'Male'),
(62, 'DB', 0, 100, 'jianyi0', '666e84f34a95d3857991b612ae69ef61', 'li', 'li', '466030455', '123456789', 'jianyil@utas.edu.au', 'Male');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
