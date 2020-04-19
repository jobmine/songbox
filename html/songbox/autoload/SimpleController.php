<?php
// Class that provides methods for working with the form data.
// There should be NOTHING in this file except this class definition.

class SimpleController {
	private $mapper;
	private $loginMapper;
	private $user_global;
	private $songID; // used in putIntoDatabase function

	public function __construct() {
		global $f3;						// needed for $f3->get()
		$this->mapper = new DB\SQL\Mapper($f3->get('DB'),"songs");	// create DB query mapper object
																			// for the "Songs" table
		$this->loginMapper = new DB\SQL\Mapper($f3->get('DB'),'usertable'); // create DB query mapper object
																	   			// for the 'UserTable' table
	}

// Visiting the Create song page creates a song entry with default data.
	public function putIntoDatabase($data) {
		$this->mapper->songname = $data["songname"];					// set value for "name" field
		$this->mapper->textarea = $data["textarea"];				// set value for "colour" field
		$this->mapper->tag = $data["tag"];				// set value for "address" field
		$this->mapper->username = $data["username"];
		$this->mapper->save();									// save new record with these fields
	}

	public function loadLastSong() {
		// load song ID of last record
		$this->mapper->load();
		$this->mapper->last();
		$this->songID=$this->mapper->get('id');
		return $this->songID;
	}

// Save data when "Save and submit"
	public function updateDatabase($data) {
		$this->mapper->songname = $data["songname"];					// set value for "name" field
		$this->mapper->textarea = $data["textarea"];				// set value for "colour" field
		$this->mapper->tag = $data["tag"];				// set value for "address" field
		//$this->mapper->username = $data["username"];
		$this->mapper->update();									// save new record with these fields
	}

	public function getData($un) {
		$list = $this->mapper->find(['username=?', $un]);
		return $list;
	}

	//public function loadLastRecord() {
	//	global $f3;
	//	$this->loginMapper->load();
	//	$this->loginMapper->last();
	//	$this->$user_global=$this->loginMapper->get('Username');				// set username FK in songs table
	//}

	public function deleteFromDatabase($idToDelete) {
		$this->mapper->load(['id=?', $idToDelete]);				// load DB record matching the given ID
		$this->mapper->erase();									// delete the DB record
	}

	public function loadFromDatabase($currentID) {
		$record = $this->mapper->load(['id=?', $currentID]);				// load DB record matching the given ID
		return $record;
	}


	public function editFromDatabase($currentID) {
		$this->mapper->load(['id=?', $currentID]);
		$this->mapper->copyFrom('POST');
		$this->mapper->update();									// update records
	}


	// Function to login a user
	public function loginUser($user, $pwd) {
		//Return the username and password typed
		$auth = new \Auth($this->loginMapper, array('id' => 'Username', 'pw' => 'Password'));
		return $auth->login($user, $pwd);
	}

	// Function to register a user
	public function registerUser($user, $pwd, $f_name, $l_name, $re_pwd) {

		// Check if the fileds are valid (null or password does not match)
		if ($user == null || $user == '' || $pwd == null || $pwd == '') {
			return 0;
		}

		if ($pwd != $re_pwd) {
			return 0;
		}

		// Log into This to prepare the query and send to SQL
		$this->loginMapper->Username = $user;
		$this->loginMapper->Password = $pwd;
		$this->loginMapper->FirstName = $f_name;
		$this->loginMapper->LastName = $l_name;
		try {
    		return $this->loginMapper->save();
		} catch (\PDOException $e) {
		    return 0;
		}

	}

	// Function to load user info after a successful login
	public function loadUserInfo($username) {
		return $this->loginMapper->load(['Username=?', $username]);
	}
}




?>
