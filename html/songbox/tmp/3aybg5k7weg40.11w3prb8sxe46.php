<!--
A very simple input form View template:
note that the form method is POST, and the action
is the URL for the route that handles form input.
 -->

 <div id="wrapper">




 	<!-- SIDE BAR -->

 	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

 		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
 			<div class="sidebar-brand-icon rotate-n-15">
 				<i class="fas fa-laugh-wink"></i>
 			</div>
 			<div class="sidebar-brand-text mx-3">Song Writin</div>
 		</a>

 		<hr class="sidebar-divider my-0">

 		<li class="nav-item active">
 			<a class="nav-link" href="index.html">
 				<i class="fas fa-fw fa-tachometer-alt"></i>
 				<span>Dashboard</span></a>
 		</li>



 		<hr class="sidebar-divider">

 		<div class="sidebar-heading">
 			Users
 		</div>

 		<li class="nav-item">
 			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
 				<i class="fas fa-fw fa-user"></i>
 				<span>[User Name]</span>
 			</a>
 			<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
 				<div class="bg-white py-2 collapse-inner rounded">
 					<h6 class="collapse-header">ready to leave?</h6>
 					<a class="collapse-item" href="forgot-password.html">Logout</a>

 					<div class="collapse-divider"></div>
 					<h6 class="collapse-header">New User?</h6>
 					<a class="collapse-item" href="login.html">Switch Account</a>
 					<a class="collapse-item" href="register.html">Register</a>

 				</div>
 			</div>

 		</li>


 	</ul>





 <!-- DASHBOARD -->



 	<div id="content-wrapper" class="d-flex flex-column">
 		<div id="content">
 			<div class="container-fluid mt-4">
 				<div class="d-sm-flex align-items-center mb-4"> <!-- was set to justify-content-between -->
 					<a href="<?= $BASE ?>/dashboard">back</a>
          <h1 class="h3 mb-0 text-gray-800">Create Song</h1>
 				</div>



 				<div class="row">

          <div class="col-lg-6 mb-4">

 						<!-- Lyrics box -->
 						<div class="card shadow mb-4">
 							<div class="card-header py-3">
                <!--- --------------------------------------------->
                <!-- form content is split between multiple divs -->
                <form id="form1" name="form1" method="post" action="<?= $BASE ?>/simpleform"> <!-- start form -->
                  <input class="writing m-0 font-weight-bold text-primary no-border border-0" name="songname" type="text" placeholder="Song 1" value="Song 1" id="songname" size="50">


 							</div>

 							<div class="card-body">
                <textarea class=" border-0 text-gray-900" name="textarea" rows="5" cols="50" id="textarea"> Start writing! </textarea>

              <p>Choose a tag:
                <select name="tag" id="tag">
                  <option value="rock">Rock</option>
                  <option value="blues" selected="selected">Blues</option>
                  <option value="pop">Pop</option>
                </select>
              </p>
              <p>
                <input class="create-btn" type="submit" name="Submit" value="Submit" id="submitButton" />
              </p>

              </form>                                                                     <!-- end form -->


 							</div>
 						</div>

 					</div>

 					<div class="col-lg-6 mb-4">


  <!-- Record Audio Button -->


                   <a href="#"  id="recordButton" class="btn btn-success btn-icon-split mb-4">
                     <span class="icon text-white-50">
                       <i class="fas fa-microphone"></i>
                     </span>
                     <span class="text">Record Audio</span>
                   </a>

                   <!-- First sample -->
                     <div id="insertHere" class="col-xl-12 col-md-12 mb-4">
                   <div class="card border-left-primary shadow h-100">

                   <div class="card-body" >
                     <audio id="preview" ></audio>
                     <div>
                       <button onclick="document.getElementById('player').play()">Play</button>
                       <button onclick="document.getElementById('player').pause()">Pause</button>
                       <button onclick="document.getElementById('player').volume += 0.1">Vol+ </button>
                       <button onclick="document.getElementById('player').volume -= 0.1">Vol- </button>
                     </div>

                     <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">36 mins ago | Edinburgh, Scotland</div>
                         <div class="row no-gutters align-items-center">
                           <div class="col-auto">
                             <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Clip 001</div>
                           </div>
                           <div class="col">
                             <div class="progress progress-sm mr-2">
                               <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                             </div>
                           </div>
                         </div>
                       </div>
                       <div class="col-auto mt-4 ml-2">
                         <i id="playButton1" class="fas fa-play-circle fa-2x text-primary"></i>
                       </div>

                     </div>
                   </div>
                   </div>
                   </div>

                   <div class="col-xl-12 col-md-12 mb-4">
                   <div class="card border-left-primary shadow h-100">
                   <div class="card-body">
                     <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">2 hrs ago | Edinburgh, Scotland</div>
                         <div class="row no-gutters align-items-center">
                           <div class="col-auto">
                             <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Clip 002</div>
                           </div>
                           <div class="col">
                             <div class="progress progress-sm mr-2">
                               <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                             </div>
                           </div>
                         </div>
                       </div>
                       <div class="col-auto mt-4 ml-2">
                         <i class="fas fa-pause-circle fa-2x text-primary"></i>
                       </div>
                     </div>
                   </div>
                   </div>
                   </div>

                   <div class="col-xl-12 col-md-12 mb-4">
                   <div class="card border-left-primary shadow h-100">
                   <div class="card-body">
                     <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">4 days ago | Edinburgh, Scotland</div>
                         <div class="row no-gutters align-items-center">
                           <div class="col-auto">
                             <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Clip 003</div>
                           </div>
                           <div class="col">
                             <div class="progress progress-sm mr-2">
                               <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                             </div>
                           </div>
                         </div>
                       </div>
                       <div class="col-auto mt-4 ml-2">
                         <i class="fas fa-play-circle fa-2x text-primary"></i>
                       </div>
                     </div>
                   </div>
                   </div>
                   </div>

                   <div class="col-xl-12 col-md-12 mb-4">
                   <div class="card border-left-primary shadow h-100">
                   <div class="card-body">
                     <div class="row no-gutters align-items-center">
                       <div class="col mr-2">
                         <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jan 4, 2020 19:30 | LONDON, ENGLAND</div>
                         <div class="row no-gutters align-items-center">
                           <div class="col-auto">
                             <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Clip 004</div>
                           </div>
                           <div class="col">
                             <div class="progress progress-sm mr-2">
                               <div class="progress-bar bg-primary" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                             </div>
                           </div>
                         </div>
                       </div>
                       <div class="col-auto mt-3 ml-2">
                         <i class="fas fa-play-circle fa-2x text-primary"></i>
                       </div>
                     </div>
                   </div>
                   </div>
                   </div>




 					</div>

 					<!-- -->
 				</div>

 			</div>


 		</div>

 		<!-- Footer -->
 		<footer class="sticky-footer bg-white">
 			<div class="container my-auto">
 				<div class="copyright text-center my-auto">
 					<span>Copyright &copy; Song Writin App 2020</span>
 				</div>
 			</div>
 		</footer>

 	</div>

 </div>

 <script src="js/javascript-rec.js"></script>
