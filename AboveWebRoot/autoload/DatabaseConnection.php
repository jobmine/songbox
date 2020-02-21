<?php
// database connection class that will be kept above web root
// can just use a static method here, no need to create an object

class DatabaseConnection {

	static function connect() {
		  return new DB\SQL(
			'mysql:host=playground.eca.ed.ac.uk;port=3306;dbname=s2006146',
			's2006146',
			'ZypdgMQ6Qh'
		  );
	}

}

?>
