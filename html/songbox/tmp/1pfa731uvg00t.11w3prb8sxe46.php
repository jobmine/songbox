<!--
A very simple input form View template:
note that the form method is POST, and the action
is the URL for the route that handles form input.
-->
<div id="wrapper">
  <!-- SIDE BAR -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $BASE ?>/dashboard">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-signature"></i>
      </div>
      <div class="sidebar-brand-text mx-3">SongWriting</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
      <a class="nav-link" href="<?= $BASE ?>/dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Users
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= $BASE ?>/" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-user"></i>
          <span>Hi Lucas!</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">ready to leave?</h6>
            <a class="collapse-item" href="<?= $BASE ?>/dummy_login">Logout</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Not Lucas?</h6>
            <a class="collapse-item" href="<?= $BASE ?>/dummy_login">Switch account</a>
            <a class="collapse-item" href="<?= $BASE ?>/dummy_register">Craete an account</a>
          </div>
        </div>
      </li>
    </ul>
    <!-- DASHBOARD -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <div class="container-fluid mt-4">
          <div class="d-sm-flex align-items-center mb-4"> <!-- was set to justify-content-between -->
          <a class="btn-circle btn-lg" href="<?= $BASE ?>/dashboard"><i class="fas fa-arrow-circle-left mr-1"></i></a>
          <h1 class="h3 mb-0 text-gray-800">Create Song</h1>
          
        </div>
        <div class="row">
          <div class="col-lg-6 mb-4">
            <!-- Lyrics box -->
            <div class="card shadow">
              <div class="card-header py-3">
                <!--- --------------------------------------------->
                <!-- form content is split between multiple divs -->
                <form id="form1" name="form1" method="post" action="<?= $BASE ?>/simpleform"> <!-- start form -->
                <input class="bg-transparent writing m-0 form-control font-weight-bold text-primary no-border border-0" name="songname" type="text" placeholder="Your song name here..." id="songname" size="50">
              </div>
              <div class="card-body">
                <textarea class="bg-transparent m-0 form-control border-0 text-gray-900" name="textarea" rows="10" id="textarea" placeholder="Write down your idea here..."></textarea>
                <p class="mt-2">Choose a tag:
                  <select name="tag" id="tag">
                    <option value="rock">Rock</option>
                    <option value="blues" selected="selected">Blues</option>
                    <option value="pop">Pop</option>
                  </select>
                </p>
                <p class="mb-0 ml-auto text-center">
                  <input class="btn bg-gradient-primary text-white" type="submit" name="Submit" value="Save n' Submit" id="submitButton" />
                </p>
                </form>                                                                     <!-- end form -->
              </div>
            </div>
          </div>
          <div class="col-lg-6 mb-4">
            <!-- Record Audio Button -->
            <div class="col-xl-12 col-md-12 mb-4 pr-0 row">
              <div class="col-md-8">
                <a href="#" id="recordButton" class="btn btn-success btn-icon-split">
                  <span class="icon text-white-50">
                    <i class="fas fa-microphone"></i>
                  </span>
                  <span class="text">Record a New Clip</span>
                </a>
              </div>
              <div class="col-md-4 p-0 ml-auto text-right m-auto">
                <button onclick="document.getElementById('player').volume = 0" class="btn p-0 pr-3">
                <i class="fas fa-volume-mute fa-lg text-secondary"></i> </button>
                <button onclick="document.getElementById('player').volume -= 0.1" class="btn p-0 pr-3">
                <i class="fas fa-volume-down fa-lg text-secondary"></i>
                </button>
                <button onclick="document.getElementById('player').volume += 0.1" class="btn p-0">
                <i class="fas fa-volume-up fa-lg text-secondary"></i> </button>
              </div>
            </div>
            <!-- First sample -->
            <div id="insertHere" class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body" >
                <audio id="preview" ></audio>
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">3 hrs ago | within 500m</div>
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
                </div>
                <div class="text-center m-auto pt-3">
                  
                  <button onclick="document.getElementById('player').backward()" class="btn p-0 pr-3">
                  <i id="backwardButton" class="fas fa-step-backward fa-lg text-primary"></i>
                  </button>
                  <button onclick="document.getElementById('player').play()" class="btn p-0 pr-3">
                  <i id="playButton1" class="fas fa-play-circle fa-2x text-primary"></i>
                  </button>
                  <!-- <button onclick="document.getElementById('player').pause()" class="btn p-0 pr-3">
                  <i class="fas fa-pause-circle fa-2x text-secondary"></i></button> -->
                  <button onclick="document.getElementById('player').forward()" class="btn p-0 pr-4">
                  <i id="ForwardButton" class="fas fa-step-forward fa-lg text-primary"></i>
                  </button>
                  <button id="deleteBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pl-4 pr-3">
                  <i id="deleteButton" class="fas fa-trash fa-lg text-secondary"></i>
                  </button>
                  <button id="shareBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pr-3">
                  <i id="shareButton" class="fas fa-share fa-lg text-secondary"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Second sample -->
            <div id="insertHere" class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body" >
                <audio id="preview" ></audio>
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Yesterday 17:40 | 3 miles away</div>
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
                </div>
                <div class="text-center m-auto pt-3">
                  
                  <button onclick="document.getElementById('player').backward()" class="btn p-0 pr-3">
                  <i id="backwardButton" class="fas fa-step-backward fa-lg text-primary"></i>
                  </button>
                  <!-- <button onclick="document.getElementById('player').play()" class="btn p-0 pr-3">
                  <i id="playButton1" class="fas fa-play-circle fa-2x text-primary"></i>
                  </button> -->
                  <button onclick="document.getElementById('player').pause()" class="btn p-0 pr-3">
                  <i class="fas fa-pause-circle fa-2x text-primary"></i></button>
                  <button onclick="document.getElementById('player').forward()" class="btn p-0 pr-4">
                  <i id="ForwardButton" class="fas fa-step-forward fa-lg text-primary"></i>
                  </button>
                  <button id="deleteBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pl-4 pr-3">
                  <i id="deleteButton" class="fas fa-trash fa-lg text-secondary"></i>
                  </button>
                  <button id="shareBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pr-3">
                  <i id="shareButton" class="fas fa-share fa-lg text-secondary"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>


          <!-- Third sample -->
            <div id="insertHere" class="col-xl-12 col-md-12 mb-4">
              <div class="card border-left-primary shadow h-100">
                <div class="card-body" >
                <audio id="preview" ></audio>
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">20 Feb 5:10 | London, England</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">Clip 003</div>
                      </div>
                      <div class="col">
                        <div class="progress progress-sm mr-2">
                          <div class="progress-bar bg-primary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center m-auto pt-3">
                  
                  <button onclick="document.getElementById('player').backward()" class="btn p-0 pr-3">
                  <i id="backwardButton" class="fas fa-step-backward fa-lg text-primary"></i>
                  </button>
                  <button onclick="document.getElementById('player').play()" class="btn p-0 pr-3">
                  <i id="playButton1" class="fas fa-play-circle fa-2x text-primary"></i>
                  </button>
                  <!-- <button onclick="document.getElementById('player').pause()" class="btn p-0 pr-3">
                  <i class="fas fa-pause-circle fa-2x text-primary"></i></button> -->
                  <button onclick="document.getElementById('player').forward()" class="btn p-0 pr-4">
                  <i id="ForwardButton" class="fas fa-step-forward fa-lg text-primary"></i>
                  </button>
                  <button id="deleteBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pl-4 pr-3">
                  <i id="deleteButton" class="fas fa-trash fa-lg text-secondary"></i>
                  </button>
                  <button id="shareBtn" onclick="document.getElementById('player').forward()" class="btn p-0 pr-3">
                  <i id="shareButton" class="fas fa-share fa-lg text-secondary"></i>
                  </button>
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