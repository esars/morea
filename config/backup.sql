--
-- MySQL 5.5.5
-- Tue, 04 Nov 2014 12:50:11 +0000
--

CREATE TABLE `erabiltzaile` (
   `izena` varchar(30) not null,
   `abizena` varchar(30) not null,
   `email` varchar(40) not null,
   `telefonoa` int(12) not null,
   `pasahitza_hash` varchar(255) not null,
   `pasahitza_salt` varchar(255) not null,
   `helbidea` varchar(70) not null,
   `id` int(5) not null auto_increment,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `erabiltzaile` (`izena`, `abizena`, `email`, `telefonoa`, `pasahitza_hash`, `pasahitza_salt`, `helbidea`, `id`) VALUES 
('Eneko', 'Sarasol', 'enekosar@gmail.com', '648510874', '$2y$10$CoYNyg3BwV5NdcZvtvNoqO6sv8wcGyBHb2x6x1y9E1l2ad7bqmJk6', '654bb3367f1e40d2', 'Arratzainbide', '1'),
('Garatx', 'Heriz', 'garatx@op.com', '2345678', '$2y$10$ySno795K0obez6mPY5AgsOAfEf81Hgui4.KaGS9QeO8SuWW92VhZ2', '7eb70b685692d2cb', 'Heriz 118 Itxasaurre', '2'),
('Armando', 'Broncas', 'armando@gmail.com', '2345', '$2y$10$pqmqkbz1iaiY5cUlZWpnHuge.hfCRIrzVYuiURGteO2JEy77s1dsq', '73ca08a138b52ef1', 'Tony Hawk kalea', '3'),
('Admin', 'Jauna', 'admin@gmail.com', '2345', '$2y$10$0eTdjUTmVpEk541yoEzdj.cTxjZs6F5TPsfcVs8KdeHsMN6UPW7MW', 'e6c20c24073449', 'admin kalea, donostia', '4'),
('Magic', 'Johnson', 'mjonson@gmail.com', '23456', '$2y$10$0czOScFwo1/aehLu65jZrurpe/yJKRgQYpENKh/a815akbLLrAd.y', '7c4e9de94d39dbb1', 'USA - NBA', '5');

CREATE TABLE `produktu` (
   `id` int(5) not null auto_increment,
   `izena` varchar(30) not null,
   `deskripzioa` text not null,
   `prezioa` float(7,2) not null,
   `stock` int(5) not null,
   `kategoria` varchar(15),
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=15;

INSERT INTO `produktu` (`id`, `izena`, `deskripzioa`, `prezioa`, `stock`, `kategoria`) VALUES 
('1', 'Alkatxofa', 'Alkatxifa haziak. 2tik 3 urtera artako hazkuntza', '2.00', '100', ''),
('2', 'Baratxuria', 'Baratxuri haziak, zure errezetei zapore bizi bat emateko', '4.00', '200', ''),
('3', 'Kiwia', 'Kiwi (Actinidia deliciosa) Actinidiaceae familiako landare igokaria, Txinan, Ibai Urdinaren inguruan, jatorria duena. 1904an Zeelanda Berrian sartu eta bere fruitu jangarriari esker kiwi izena eman zioten, horixe baitzen bertoko animaliaren maorierazko izena.', '20.00', '50', 'Zuhaitzak'),
('4', 'Kalabazina', 'Kalabazina Euskal Herrian oso oparoa den barazkia da.', '3.00', '300', ''),
('5', 'Estragoia', 'El estragón tiene propiedades medicinales: en cataplasma, se ponen hojas y flores frescas y trituradas dentro de una gasa para aliviar el dolor de muelas; en infusión, ayuda a mejorar la digestión; tomar baños de pies y manos de agua con un puñado de hojas frescas de estragón alivia la artrosis.', '5.00', '700', ''),
('6', 'Albahaka', 'Gozotzaile naturala, entsaladari botatzeko oso aproposa.', '1.00', '30', ''),
('7', 'Kamelia', 'Etxe barruko landare polita eta bizia.', '40.00', '50', ''),
('8', 'Geranioa', 'Al final de invierno o principios de primavera haz una poda severa cerca del suelo. Aprovecha el material cortado para hacer esquejes. También se debe despuntar con frecuencia para que emita brotes laterales; cuantos más tallos, más flores.\r\n', '3.50', '400', ''),
('9', 'Sativa Jack Herer', 'Jack Herer is a sativa-dominant cannabis strain that has gained as much renown as its namesake, the marijuana activist and author of The Emperor Wears No Clothes. Combining a Haze hybrid with a Northern Lights #5 and Shiva Skunk cross, Sensi Seeds created Jack Herer hoping to capture both the cerebral elevation associated with sativas and the heavy resin production of indicas. Its rich genetic background gives rise to several different variations of Jack Herer, each phenotype bearing its own unique features and effects. However, consumers typically describe this 55% sativa hybrid as blissful, clear-headed, and creative.', '10.50', '420', 'Matujak'),
('10', 'Indica White Rhino', 'White Rhino is a hybrid of White Widow and an unknown North American indica strain, creating a bushy and stout plant. The buds give off a strong and heady high. The plant\'s parentage hails from Afghanistan, Brazil, and India. White Rhino is one of the best types of marijuana for medicinal use since it has such a high THC content.', '16.50', '300', 'Matujak'),
('11', 'Peyote', 'Xamanek aintzinatik erabili izan duten kaktus haluzinogenoa', '25.75', '300', ''),
('13', 'Orkidea', 'La palabra orquídea deriva del griego ορχις (orchis = testículo), vocablo que se encontró por primera vez en los manuscritos de la obra De causis plantarum del filósofo griego Teofrasto y que datan aproximadamente del año 375 antes de Cristo.10 Tal vocablo hace referencia a la forma de los tubérculos de las especies del género Orchis, orquídeas de hábito terrestre cuyos tubérculos dobles parecen testículos,20 como puede apreciarse en la imagen de la derecha.', '20.65', '350', 'Erramuak'),
('14', 'Salvia Divinorum', 'Recientemente se ha descubierto que es un potente agonista de los receptores opioides kappa (que producen analgesia espinal, miosis y sedación) y que no tiene acciones sobre los 5-HT2A serotoninérgicos, principal mecanismo molecular responsable de las acciones de los alucinógenos clásicos. Estos estudios sugieren un importante papel de los receptores kappa sobre la modulación de la percepción humana y una nueva vía terapéutica para el tratamiento de las patologías relacionadas con las distorsiones percepturales tales como la esquizofrenia, la demencia y los desórdenes bipolares.', '35.50', '5', 'Matujak');

CREATE TABLE `salmentak` (
   `id` int(5) not null auto_increment,
   `id_er` int(5) not null,
   `id_prod` int(100) not null,
   `kantitatea` int(3) not null default '1',
   `codigo` varchar(10) not null,
   `data` datetime not null,
   `egoera` int(1) default '1',
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=80;

INSERT INTO `salmentak` (`id`, `id_er`, `id_prod`, `kantitatea`, `codigo`, `data`, `egoera`) VALUES 
('74', '4', '3', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1'),
('75', '4', '2', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1'),
('76', '4', '1', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1'),
('77', '4', '6', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1'),
('78', '4', '7', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1'),
('79', '4', '8', '1', 'EM04hXbOZP', '2014-11-04 12:25:42', '1');
