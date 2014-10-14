Morea Loradenda
=====

* Exekutatzeko LAMP zerbitzari bat besterik ez da behar.
* Objektuetara orientaturiko estruktura
* php.ini fitxategian mysqli gehigarriak gaitua egon behar du
* Modeloak berrerabiligarriak dira

Erabilitako liburutegiak
------------------------

* Pure CSS (Yahoo)
* Featherlight jQuery plugin

Irudiak gehitu produktuei
-------------------------
Irudiak png formatuan egon beharko dute, /public/argazkiak karpetan gordeko dira eta hurrengo nomenklatura jarraituko dute:
>ProduktuarenId-[12345].png

Beraz, 5 argazki gehienez jarri ahal dira produktu bakoitzeko. Hona hemen adibide batzuk:
* 3-1.png
* 3-2.png
* 3-3.png
* 3-4.png
* 3-5.png
* 23453-2.png
* 443-1.png
* etab.

Administratzailea
-----------------

$_GET['ekintza'] erabiltzen da produktuak maneiatzeko. Hiru aukera ditu: gehitu, aldatu eta kendu. Azken bi hauek $_GET['id']
ere beharko dute. Kendu konfirmazio orrialde hutsa izango da. Aurrerago interfaze grafiko bat programatuko dugu hauei guztiei
estekak erabiliz.

mySQLdump erabiltzen degu argazkien eta produktuen artean konflikturik ez izateko. Bai taulak sortzeko SQLa bai produktuen taularen
SQLa config karpetan daude. Hona hemen beharrezko komandoak taula importatzeko eta esportatzeko:

###Esportatzeko

	mysqldump -p --user=morea landare produktu > produktu.sql
		
###Inportatzeko

	mysql -u morea -p -D landare < produktu.sql
