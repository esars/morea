CREATE TABLE `zelatari` (
   `id` int(8) not null auto_increment,
   `ip` varchar(15) not null,
   `user_agent` varchar(80) not null,
   `referer` varchar(40) not null,
   `orrialdea` varchar(40) not null,
   `uid` int(5) not null,
   `data` datetime,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
