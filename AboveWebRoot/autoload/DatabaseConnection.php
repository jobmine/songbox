<?php
// database connection class that will be kept above web root
// can just use a static method here, no need to create an object

class DatabaseConnection {

	static function connect() {
		  return new DB\SQL(
			'mysql:localhost=127.0.0.1;port=3306;dbname=db',
			'root',
			'thisisApass#'
		  );
	}

}

?>
