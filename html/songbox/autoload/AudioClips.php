<?php
/// code based on ImageServer.php
///

// Class that provides methods for working with the images.  The constructor is empty, because
// initialisation isn't needed; in fact it probably never really needs to be instanced and all
// could be done with static methods.
class AudioClips extends SimpleController {
	private $filedata;
	private $uploadResult = "Upload failed! (unknown reason) <a href=''>Return</a>";
	private $cliptable = "clips"; // 	private $acceptedTypes = ["image/jpeg", "image/png", "image/gif", "image/tiff", "image/svg+xml"];
	private $acceptedTypes = ["audio/webm"];	// only webm which the recorder outputs
	private $fileLocation; // save UPLOADS + current slug
	private $songIDprint='7';
	private $k="1";
	private $username_here;
	private $counter; //counting var for clip local id-s

	public function __construct() {
		global $f3;						// needed for $f3->get()
		$clip = new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
	}

public function loadLast() {
	global $f3;			// because we need f3->get()
	$clip = new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
	//$clip->clipname = $this->filedata["title"];
	$clip->load();
	$clip->last();
	$this->songIDprint=$clip->get('cID');
		$parts=pathinfo($this->filedata["name"]);
		$directory=$parts['dirname'].'/'.$f3->get('SESSION.userName');
		$clip->clipname = $directory ."/audioclip" .($clip->get('cID')) ."." .$parts['extension'];
	$clip->update();
	return $this->songIDprint;
}


	// Puts the file data into the DB
	public function store() {
		global $f3;			// because we need f3->get()
		$clip = new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
			//$parts=pathinfo($this->filedata["name"]);
			//$directory=$parts['dirname'].'/'.$f3->get('SESSION.userName');
		//$clip->clipname = $directory ."/audioclip" .(($this->songIDprint)+1) ."." .$parts['extension'];
		$clip->clipname=$this->filedata["clipname"];
		$clip->cliptime = $this->filedata["clipTime"];
		$clip->clipdate = $this->filedata["clipDate"];
		$clip->clipsize = $this->filedata["size"];
		$clip->songID = $this->filedata["songID"];
		$clip->save();
	}

	public function upload() {
		global $f3;		// so that we can call functions like $f3->set() from inside here

		$overwrite = false; // set to true, to overwrite an existing file; Default: false
		$slug = true; // rename file to filesystem-friendly version

		Web::instance()->receive(function($file,$anything){
				var_dump($file);

				/* looks like:
				  array(5) {
					  ["name"] =>     string(19) "csshat_quittung.png"
					  ["type"] =>     string(9) "image/png"
					  ["tmp_name"] => string(14) "/tmp/php2YS85Q"
					  ["error"] =>    int(0)
					  ["size"] =>     int(172245)
					}
				*/
				// $file['name'] already contains the slugged name now
				//$this->filedata["name"] = "audioclip $hereThisRecord.webm";
				$this->filedata = $file;		// export file data to outside this function

				return true; // allows the file to be moved from php tmp dir to your defined upload dir
			},

			/////////////////////////////////////////
			// UNUSED EXPERIMENT!! start of RENAME function in place of $slug /////////////////
			// can be replaced with:
			// , $overwrite, $slug (instead of true, function($FileBaseName, $anything) etc.)
			//
			true, function($fileBaseName, $anything){
			// build new file name from base name or input field name
			$parts=pathinfo($fileBaseName);

			return $parts['filename'] .'.webm';
		}
		//end of RENAME function //////////////////////////
		);

		$this->filedata["clipTime"] = $f3->get('POST.clipTime');
		$this->filedata["clipDate"] = $f3->get('POST.clipDate');
		$this->filedata["songID"] = $f3->get('POST.songID');

		//$f3->get("SESSION.userName");
		$this->store();
		$this->loadLast();

		//rename
		$this->renameClips($f3->get("UPLOADS") .$this->filedata["name"], $f3->get("UPLOADS") .$f3->get("SESSION.userName") ."/" ."audioclip".($this->songIDprint) .".webm");

		return $this->filedata;
	}


	private function renameClips($oldName, $newName) {
			global $f3;
			$targetDir = dirname($newName); // Returns a parent directory's path (operates naively on the input string, and is not aware of the actual filesystem)

	    // check if subfolder exists and create if doesn't. code snippet from Petr - https://stackoverflow.com/questions/2653803/rename-folder-into-sub-folder-with-php
	    if (!file_exists($targetDir)) {
	        mkdir($targetDir, 0777, true); // third parameter "true" allows the creation of nested directories
	    }

			rename ($oldName, $newName);
	}

	public function loadAllClips($currentID) {
		global $f3;
		$returnData = array();
		$clip=new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
		$list = $clip->find(['songID=?',$currentID]);
		$this->counter = 0;
			foreach ($list as $record) {
				$recordData = array();
				$recordData["clipID"] = $record["cID"];
				$recordData["clipname"] = $record["clipname"];
				$recordData["cliptime"] = $record["cliptime"];
				$recordData["clipdate"] = $record["clipdate"];
				$recordData["clipsize"] = $record["clipsize"];
				$recordData["songID"] = $record["songID"];
				$this->counter++;
				$recordData["localClipID"] = $this->counter;
				array_push(	$returnData, $recordData);
			}
			return $returnData;

	}

	// Delete data record about the image, and remove its file and thumbnail file
	public function deleteClips($currentClipID) {
		global $f3;
		$clip=new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
		$clip->load(['cID=?',$currentClipID]);							// load DB record matching the given ID
		unlink($clip["clipname"]);										// remove the file
		$clip->erase();													// delete the DB record
	}

// delete all clips when deleting a song!
	public function deleteAllClips($currentID) {
		global $f3;
		$clip=new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object

		$clip->load(['songID=?',$currentID]);
	  while (!$clip->dry()) {
			 unlink($clip["clipname"]);
			 $clip->erase();
			 $clip->next();
	  }

		// loop + find() wasn't working for some reason
		//$list=$clip->find(['songID=?',$currentID]);							// load DB record matching the given ID
  	//foreach ($list as $record) {
		//	unlink($record["clipname"]); // remove the file
		//	$clip->erase();						// delete the DB record
    //}

	}

	//// load single clip - the last entry.
	public function loadClip() {
		global $f3;			// because we need f3->get()
		$clip = new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
		//$clip->clipname = $this->filedata["title"];
		$clip->load();
		$clip->last();
		//$clipData = array();
		$clipData=$clip->get('cID');
		// $clipData["clipname"]=$clip->get('clipname');
		// $clipData["cliptime"]=$clip->get('cliptime');
		// $clipData["clipdate"]=$clip->get('clipdate');
		// $clipData["size"]=$clip->get('size');
		// $clipData["songID"]=$clip->get('songID');
		return $clipData;
	}

	public function showClip($currentClipID) {
		global $f3;
		$clip=new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
		$clip->load(['cID=?',$currentClipID]);	// load DB record matching the given ID

		$clipName=$clip->get('clipname');
		$fileToShow = ($clipName);
			//$parts=pathinfo($fileToShow);
			//$name=$parts['basename'] .$parts['extension'];
		$fileType = ("audio/webm");
		header('Content-type: ' .$fileType);		// write out the file http header
		readfile($fileToShow);						// write out raw file contents (image data)
	}


}
?>
