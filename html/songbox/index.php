<?php

/////////////////////////////////////
// index.php for SimpleExample app //
/////////////////////////////////////

// Create f3 object then set various global properties of it
// These are available to the routing code below, but also to any
// classes defined in autoloaded definitions

$f3 = require('../../AboveWebRoot/fatfree-master/lib/base.php');

// autoload Controller class(es) and anything hidden above web root, e.g. DB stuff
$f3->set('AUTOLOAD','autoload/;../../AboveWebRoot/autoload/');
$f3->set('UPLOADS','../../AboveWebRoot/AudioClips/'); // set uploads folder

$db = DatabaseConnection::connect(); // defined as autoloaded class in AboveWebRoot/autoload/
$f3->set('DB', $db);

$f3->set('DEBUG', 3); // set maximum debug level
$f3->set('UI', 'ui/'); // folder for View templates

// create session
new \DB\SQL\Session($f3->get('DB'));
if (!$f3->exists('SESSION.userName'))
    $f3->set('SESSION.userName', 'UNSET');
// add another session (first name) in the session so we could display username in the front-end
if (!$f3->exists('SESSION.fname'))
    $f3->set('SESSION.fname', 'UNSET');

//$f3->set('currentID',0); //set a variable to put # song ID in for simpleformReq (edit screen for songs)

/////////////////////////////////////////////
// Simple Example URL application routings //
/////////////////////////////////////////////

//home page (index.html) -- actually just shows form entry page with a different title
$f3->route('GET /', function($f3)
{
    $f3->set('html_title', 'Home - SongBox');
    $f3->set('content', 'homepage.html');
    echo Template::instance()->render('layout.html');
});

// When using GET, provide a form for the user to upload an image via the file input type
$f3->route('GET /simpleform', function($f3)
{
    // create new song entry on opening the form, so recorded clips can be saved to it
    $formdata             = array(); // array to pass on the entered data in
    $formdata["songname"] = 'New Song'; // whatever was called "name" on the form
    $formdata["textarea"] = 'Write down your idea here...'; // whatever was called "colour" on the form
    $formdata["tag"]      = 'Blues'; // whatever was called "address" on the form
    $formdata["username"] = $f3->get('SESSION.userName');

    $controller = new SimpleController;
    $controller->putIntoDatabase($formdata); //save entry to DB

    //get song ID; use it to create custom name; update database entry;
    $loadLastSong=$controller->loadLastSong();
    $f3->set("songID", $loadLastSong);
    $formdata["songname"] = 'New Song ' .$loadLastSong; // whatever was called "name" on the form
    $controller->updateDatabase($formdata);

    $part2=$f3->get('songID');
    $f3->reroute('/simpleformReq/?toEdit=' .$part2 .'&edit=');
    //$f3->set('html_title', 'Dashboard - SongBox');
    //$f3->set('content', 'simpleform.html');
    //echo template::instance()->render('layout.html');
});

// When using POST (e.g.  form is submitted), invoke the controller, which will process
// any data then return info we want to display. We display
// the info here via the response.html template
$f3->route('POST /simpleform', function($f3)
{   //save
    $formdata             = array(); // array to pass on the entered data in
    $formdata["songname"] = $f3->get('POST.songname'); // whatever was called "name" on the form
    $formdata["textarea"] = $f3->get('POST.textarea'); // whatever was called "colour" on the form
    $formdata["tag"]      = $f3->get('POST.tag'); // whatever was called "address" on the form
    $formdata["username"] = $f3->get('SESSION.userName');

    $controller = new SimpleController;
    $controller->updateDatabase($formdata);
    $f3->set("dbData", $alldata);

    $f3->reroute('/dashboard');

  }
);

//////// UPLOAD snippets ///
$f3->route('POST /clipSave',
    function($f3) {
  	$is = new AudioClips;
    $filedata = $is->upload();
    $f3->set('filedata', $filedata); // add filedata to f3 variable??
    //echo json_encode($filedata);
  }
);

//////// LOAD a single snippet ///
$f3->route('GET /clipLoad',
    function($f3) {
  	$is = new AudioClips;
    $filedata = $is->loadClip();
    $f3->set('filedata', $filedata); // add filedata to f3 variable??
    echo $filedata;
    //echo json_encode($filedata);
  }
);



$f3->route('GET /simpleformReq',
  function($f3) {
    $controller = new SimpleController;
    $currentID = $f3->get('GET.toEdit'); // get the requested ID from hidden form element

    $thisRecord = $controller->loadFromDatabase($currentID); // in this case, edit selected data record
    $f3->set('hereThisRecord', $thisRecord);

    $is = new AudioClips;
    $audioClipList = $is->loadAllClips($currentID);
    $f3->set('audioClipList', $audioClipList);

    $f3->set('html_title', 'Simple Form Edit');
    $f3->set('content', 'simpleformReq.html');
    echo template::instance()->render('layout.html');
});

$f3->route('POST /simpleformReq', // edit songs
    function($f3)
{

    $currentID = $f3->get('POST.toEdit'); // get the requested ID from hidden form element

    $controller = new SimpleController;
    $controller->editFromDatabase($currentID);

    $f3->reroute('/dashboard'); // will show edited data (GET route)
});


$f3->route('GET /simpleformReq/deleteClip/@id', // delete clip
    function($f3) {
  	$is = new AudioClips;
    $currentClipID = $f3->get('PARAMS.id'); // catch the clipID from the url
    $currentSongID = $f3->get('GET.songID'); //catch the song ID being sent by form
  	$is->deleteClips($currentClipID);

    ////// a somewhat blunt way to open the same song again. ////
    $part2=$f3->get('GET.songID');
    $f3->reroute('/simpleformReq/?toEdit=' .$part2 .'&edit=');
    //////
}
);

$f3->route('GET /getClip/@id',
  function($f3) {
	$is = new AudioClips;
	$is->showClip($f3->get('PARAMS.id'));
  }
);


$f3->route('GET /dashboard', function($f3)
{


    $controller = new SimpleController;
    $un=$f3->get('SESSION.userName');
    $alldata    = $controller->getData($un);
    $f3->set("dbData", $alldata);

    $f3->set('html_title', 'Dashboard - SongBox');
    $f3->set('content', 'dashboard.html');
    echo template::instance()->render('layout.html');
});

//$f3->route('GET /editView',       // exactly the same as dataView, apart from the template used
//  function($f3) {
//    $controller = new SimpleController;
//    $alldata = $controller->getData();
//    $f3->set("dbData", $alldata);
//    $f3->set('html_title','Viewing the data');
//    $f3->set('content','editView.html');
//    echo template::instance()->render('layout.html');
//  }
//);

$f3->route('POST /dashboard', // this is used when the form is submitted, i.e. method is POST
    function($f3)
{
    $currentID=$f3->get('POST.toDelete');
    $is = new AudioClips;
    $is->deleteAllClips($currentID); // delete all clips belonging to song (files & DB info)

    $controller = new SimpleController;
    $controller->deleteFromDatabase($currentID); // in this case, delete selected data record

    $f3->reroute('/dashboard');
} // will show edited data (GET route)
    );

/////other links - to dummy login/register screens ///
/////////////////////////////////////////////////////


// Login error message exception handle logic
$f3->route('GET /dummy_login/@msg', ///Log in///
    function($f3)
{
    switch ($f3->get('PARAMS.msg')) {
        case "err":
            $msg = "You have entered an invalid username and/or password. Please try again.";
            break;

        case "logout":
            $msg = "You have been logged out.";
            break;

        case "reg_success":
            $msg = "You have successfully registered! Welcome onboard.";
            break;

        case "switch":
            $msg = "Signed out. Please sign in to switch to another user.";
            break;

        case "unauthorized":
            $msg = "You are not signed in! Sign in to continue.";
            break;

        default:
            $msg = "Please enter your username and password above to log in.";
            break;
    }
    $f3->set('html_title', 'Sign In - SongBox');
    $f3->set('content', 'dummy_login.html');
    $f3->set('message', $msg);
    echo template::instance()->render('layout.html');
});

// Login logic
$f3->route('POST /login', function($f3)
{
    $controller = new SimpleController;
    $f3->set('SESSION.userName', 'UNSET');
    $uname = $f3->get('POST.uname');
    // Check the user name and password if they match with the database
    if ($controller->loginUser($uname, $f3->get('POST.password'))) {
        $f3->set('SESSION.userName', $uname);

        // load user info
        $user_record = $controller->loadUserInfo($uname);
        $f3->set('SESSION.fname', $user_record->FirstName);

        // load song info
        // $alldata = $controller->getData();
        // $f3->set("dbData", $alldata);

        // $f3->set('html_title','Dashboard - SongBox');
        // $f3->set('content','dashboard.html');
        // echo template::instance()->render('layout.html');

        $f3->reroute('/dashboard');
    } else {
        // If login is not successful, then reroute to the error login page and dipslay the error message defined above
        $f3->reroute('dummy_login/err');
    }
});

// Logout logic - clear the session and go back to the login page
$f3->route('POST /logout', function($f3)
{
    $f3->set('SESSION.userName', 'UNSET');
    $f3->reroute('dummy_login/logout');
});


//Logic to pass the error message for register and redirect back to the register page after failuer
$f3->route('GET /dummy_register/@msg', function($f3)
{
    // Error messages
    switch ($f3->get('PARAMS.msg')) {
        // Error displays if the registration is failed
        case "err":
            $msg     = "The username already exists.";
            $msgspan = "Please use a different username and try again.";
            break;
        default:
            $msg = "Sign up an account to join SongBox!";
            break;
    }
    $f3->set('html_title', 'Registeration - SongBox');
    $f3->set('content', 'dummy_register.html');
    $f3->set('reg_err_msg', $msg);
    $f3->set('reg_err_msgspan', $msgspan);
    echo template::instance()->render('layout.html');
});


//Logic for register a user
$f3->route('POST /register', function($f3)
{
    $f3->set('SESSION.userName', 'UNSET');
    $controller = new SimpleController;
    // If success, go to login with success message
    if ($controller->registerUser($f3->get('POST.uname'), $f3->get('POST.password'), $f3->get('POST.fname'), $f3->get('POST.lname'), $f3->get('POST.re_password'))) {
        $f3->reroute('/dummy_login/reg_success');
    } else {
        $f3->reroute('dummy_register/err');
    }
});






////////////////////////
// Run the FFF engine //
////////////////////////

$f3->run();

?>
