<?php
// database connection class that will be kept above web root
// can just use a static method here, no need to create an object

class DatabaseConnection {

	static function connect() {
		  return new DB\SQL(
			// 'mysql:localhost=127.0.0.1;port=3306;dbname=s1965998',
			// 's1965998',
			// 'V4NLWlPQja'

			'mysql:localhost=127.0.0.1;port=3306;dbname=s2006146',
            's2006146',
            'ZypdgMQ6Qh'
		  );
	}

}

?>
