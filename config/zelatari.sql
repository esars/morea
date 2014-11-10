--
-- MySQL 5.5.5
-- Sun, 09 Nov 2014 10:08:22 +0000
--

CREATE TABLE `zelatari` (
   `id` int(8) not null auto_increment,
   `ip` varchar(15) not null,
   `user_agent` varchar(80) not null,
   `referer` varchar(40) not null,
   `orrialdea` varchar(40) not null,
   `uid` varchar(10) not null,
   `data` datetime,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
