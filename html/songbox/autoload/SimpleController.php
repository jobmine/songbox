<?php
// Class that provides methods for working with the form data.
// There should be NOTHING in this file except this class definition.

class SimpleController {
	private $mapper;

	public function __construct() {
		global $f3;						// needed for $f3->get()
		$this->mapper = new DB\SQL\Mapper($f3->get('DB'),"songs");	// create DB query mapper object
																			// for the "Songs" table
	}

	public function putIntoDatabase($data) {
		$this->mapper->songname = $data["songname"];					// set value for "name" field
		$this->mapper->textarea = $data["textarea"];				// set value for "colour" field
		$this->mapper->tag = $data["tag"];				// set value for "address" field
		$this->mapper->save();									// save new record with these fields
	}

	public function getData() {
		$list = $this->mapper->find();
		return $list;
	}

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


}

?>
