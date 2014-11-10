Morea Loradenda
=====

* Exekutatzeko LAMP zerbitzari bat besterik ez da behar.
* Objektuetara orientaturiko estruktura
* php.ini fitxategian mysqli gehigarriak gaitua egon behar du
* Modeloak berrerabiligarriak dira

Erabilitako liburutegiak
------------------------

* [Pure CSS](http://purecss.io/)
* [Featherlight jQuery plugin](http://noelboss.github.io/featherlight/)
* [font-awesome 4.2.0](http://fortawesome.github.io/Font-Awesome/)
* [Unslider](http://unslider.com/)

Administratzailea
-----------------

$_GET['ekintza'] erabiltzen da produktuak maneiatzeko. Hiru aukera ditu: gehitu, aldatu eta kendu. Azken bi hauek $_GET['id']
ere beharko dute. Kendu konfirmazio orrialde hutsa izango da. Aurrerago interfaze grafiko bat programatuko dugu hauei guztiei
estekak erabiliz.

mySQLdump erabiltzen degu argazkien eta produktuen artean konflikturik ez izateko. Bai taulak sortzeko SQLa bai produktuen taularen
SQLa config karpetan daude. Hona hemen beharrezko komandoak taula importatzeko eta esportatzeko:

###Esportatzeko

	mysqldump -p --user=morea landare produktu > produktuak.sql
		
###Inportatzeko

	mysql -u morea -p -D landare < produktuak.sql
