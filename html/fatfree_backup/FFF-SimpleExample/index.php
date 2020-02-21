<?php

  /////////////////////////////////////
 // index.php for SimpleExample app //
/////////////////////////////////////

// Create f3 object then set various global properties of it
// These are available to the routing code below, but also to any
// classes defined in autoloaded definitions

$f3 = require('../../../AboveWebRoot/fatfree-master/lib/base.php');

// autoload Controller class(es) and anything hidden above web root, e.g. DB stuff
$f3->set('AUTOLOAD','autoload/;../../../AboveWebRoot/autoload/');

$db = DatabaseConnection::connect();		// defined as autoloaded class in AboveWebRoot/autoload/
$f3->set('DB', $db);

$f3->set('DEBUG',3);		// set maximum debug level
$f3->set('UI','ui/');		// folder for View templates

//$f3->set('idCurrent',0); //set variable to put @record.id (# song ID) in for simpleformReq (edit screen for songs)

  /////////////////////////////////////////////
 // Simple Example URL application routings //
/////////////////////////////////////////////

//home page (index.html) -- actually just shows form entry page with a different title
$f3->route('GET /',
  function ($f3) {
    $f3->set('html_title','Simple Example Home');
    $f3->set('content','simpleHome.html');
    echo Template::instance()->render('layout.html');
  }
);

// When using GET, provide a form for the user to upload an image via the file input type
$f3->route('GET /simpleform',
  function($f3) {
    $f3->set('html_title','Simple Input Form');
    $f3->set('content','simpleform.html');
    echo template::instance()->render('layout.html');
  }
);

// When using POST (e.g.  form is submitted), invoke the controller, which will process
// any data then return info we want to display. We display
// the info here via the response.html template
$f3->route('POST /simpleform',
  function($f3) {
	$formdata = array();			// array to pass on the entered data in
	$formdata["songname"] = $f3->get('POST.songname');			// whatever was called "name" on the form
	$formdata["textarea"] = $f3->get('POST.textarea');		// whatever was called "colour" on the form
	$formdata["tag"] = $f3->get('POST.tag');		// whatever was called "address" on the form

  	$controller = new SimpleController;
    $controller->putIntoDatabase($formdata);

	$f3->set('formData',$formdata);		// set info in F3 variable for access in response template

    $f3->set('html_title','Simple Example Response');
	$f3->set('content','response.html');
	echo template::instance()->render('layout.html');
  }
);

$f3->route('POST /simpleformReq',
  function($f3) {
    $controller = new SimpleController;

    $currentID = $f3->get('POST.toEdit');
    echo $currentID;

    $thisRecord = $controller->getData([$currentID]);
    echo $thisRecord;
    $f3->set("hereThisRecord", $thisRecord);
    echo $thisRecord;

    //$thisRecord = $controller->loadFromDatabase($currentID);      // in this case, edit selected data record
    //$f3-> set("hereThisRecord",$thisRecord);

    $f3->set('html_title','Simple Form Edit');
	$f3->set('content','simpleformReq.html');
	echo template::instance()->render('layout.html');
  }
);

$f3->route('GET /dashboard',
  function($f3) {
  	$controller = new SimpleController;
    $alldata = $controller->getData();
    $f3->set("dbData", $alldata);
    $f3->set('html_title','Dashboard');
    $f3->set('content','dashboard.html');
    echo template::instance()->render('layout.html');
  }
);

//$f3->route('GET /editView',				// exactly the same as dataView, apart from the template used
//  function($f3) {
//  	$controller = new SimpleController;
//    $alldata = $controller->getData();
//    $f3->set("dbData", $alldata);
//    $f3->set('html_title','Viewing the data');
//    $f3->set('content','editView.html');
//    echo template::instance()->render('layout.html');
//  }
//);

$f3->route('POST /dashboard',		// this is used when the form is submitted, i.e. method is POST
  function($f3) {
  	$controller = new SimpleController;
    $controller->deleteFromDatabase($f3->get('POST.toDelete'));		// in this case, delete selected data record

	$f3->reroute('/dashboard');  }		// will show edited data (GET route)
);


  ////////////////////////
 // Run the FFF engine //
////////////////////////

$f3->run();

?>
