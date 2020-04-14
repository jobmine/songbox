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
	return $this->songIDprint;
}


	// Puts the file data into the DB
	public function store() {
		global $f3;			// because we need f3->get()
		$clip = new DB\SQL\Mapper($f3->get('DB'),$this->cliptable);	// create DB query mapper object
		$parts=pathinfo($this->filedata["name"]);
		$clip->clipname = $parts['dirname'] ."/audioclip" .(($this->songIDprint)+1) ."." .$parts['extension'];

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

		$this->loadLast();
		$this->store();
		//EXPERIMENTAL REMOVE this->>
		$this->renameClips($f3->get("UPLOADS") .$this->filedata["name"], $f3->get("UPLOADS") ."audioclip".$this->songIDprint .".webm");

		return $this->filedata;
	}

	private function renameClips($oldName, $newName) {
			//return "thumb-".pathinfo($clipname,PATHINFO_FILENAME).".jpg";
			rename ($oldName, $newName);
	}




}
?>
