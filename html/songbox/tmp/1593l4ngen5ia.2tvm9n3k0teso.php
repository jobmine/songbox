<div id="wrapper">
   <!-- SIDE BAR -->
   <?php if ($SESSION['userName']=='UNSET'): ?>
      
         <script>window.location = "<?= $BASE ?>/dummy_login/unauthorized";</script>
      
      <?php else: ?>
         <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $BASE ?>/dashboard">
               <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-signature"></i>
               </div>
               <div class="sidebar-brand-text mx-3">SongBox</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
               <a class="nav-link" href="<?= $BASE ?>/dashboard">
               <i class="fas fa-fw fa-tachometer-alt"></i>
               <span>Dashboard</span>
               </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
               Submission One
            </div>
            <li class="nav-item">
               <a class="nav-link" target="_blank" href="<?= $BASE ?>/SongBox.pdf">
               <i class="fas fa-fw fa-file-pdf"></i>
               <span>PDF Report</span>
               </a>
               <a class="nav-link pt-0" target="_blank" href="<?= $BASE ?>/SongBox.mp4">
               <i class="fas fa-fw fa-file-video"></i>
               <span>Video Walkthrough</span>
               </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
               Users
            </div>
            <li class="nav-item">
               <a class="nav-link collapsed" href="<?= $BASE ?>/" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
               <i class="fas fa-fw fa-user"></i>
               <span>Hi <?= $SESSION['fname'] ?>!</span>
               </a>
               <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                     <h6 class="collapse-header">ready to leave?</h6>
                     <a class="collapse-item" href="<?= $BASE ?>/dummy_login/logout">Logout</a>
                     <div class="collapse-divider"></div>
                     <h6 class="collapse-header">Not <?= $SESSION['fname'] ?>?</h6>
                     <a class="collapse-item" href="<?= $BASE ?>/dummy_login/switch">Switch account</a>
                     <a class="collapse-item" href="<?= $BASE ?>/dummy_register/in">Craete an account</a>
                  </div>
               </div>
            </li>
         </ul>
         <!-- DASHBOARD -->
         <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
               <div class="container-fluid mt-4">
                  <div class="d-sm-flex align-items-center mb-4">
                     <i class="btn-circle btn-lg fas fa-tachometer-alt mr-1"></i>
                     <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                  </div>
                  <div class="row">
                     <div class="col-lg-6 mb-4">
                        <!-- Record Audio Button -->
                        <!-- Second sample -->
                        <div class="row">
                           <div class="col-lg-6 mb-4">
                              <div class="card bg-light text-gray-800 shadow create-card ">
                                 <div class="card-body text-center mt-4 mb-3">
                                    <span>  </span>
                                    <form name="go" method="get" action="<?= $BASE ?>/simpleform">
                                       <!-- hidden record that passes on the #id value -->
                                       <input class="create-btn btn btn-teal mb-1" type="submit" name="create-btn" value="New Song" />
                                    </form>
                                    <div class="text-gray-800 small mt-1">
                                       Create a new song
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <?php foreach (($dbData?:[]) as $record): ?>
                              <div class="col-lg-6 mb-4">
                                 <div class="card bg-primary text-white shadow">
                                    <div class="card-body">
                                       <!-- <span class="id"> <?= trim($record['id']) ?> </span> -->
                                       <form class="strongTitle" id="editform" name="editform" method="get" action="<?= $BASE ?>/simpleformReq">
                                          <input class="btn p-0 pr-4" type="hidden" name="toEdit" value="<?= trim($record['id']) ?>">
                                          <input class="form-control create-btn btn btn-primary strongTitle" type="submit" name="edit" value="<?= trim($record['songname']) ?>" />
                                       </form>
                                       <div class="text-gray-400 small mb-4 text-center"><?= trim($record['tag']) ?></div>
                                       <div class="buttons">
                                          <div class="container">
                                             <div class="row justify-content-md-center">
                                                <!-- <div class="col"> -->
                                                <form class="sameline" id="editform" name="editform" method="get" action="<?= $BASE ?>/simpleformReq">
                                                   <input class="btn p-0 pr-4" type="hidden" name="toEdit" value="<?= trim($record['id']) ?>">
                                                   <button class="transparent pr-3" id="deleteButton" type="submit" name="edit">
                                                   <i class="fas fa-edit text-gray-400"></i>
                                                   </button>
                                                </form>
                                                <!-- 			</div>
                                                   <div class="col"> -->
                                                <form class="sameline" id="deleteform" name="deleteform" method="post" action="<?= $BASE ?>/dashboard">
                                                   <input class="btn p-0 pr-4" type="hidden" name="toDelete" value="<?= trim($record['id']) ?>">
                                                   <button class="transparent pl-3" id="deleteButton" type="submit" name="delete" >
                                                   <i class="fas fa-trash text-gray-400"></i>
                                                   </button>
                                                </form>
                                                <!-- </div> -->
                                             </div>
                                          </div>
                                       </div>
                                       <!-- formbox end -->
                                    </div>
                                    <!-- card-body end -->
                                 </div>
                                 <!-- card end -->
                              </div>
                              <!-- row end -->
                           <?php endforeach; ?>
                        </div>
                     </div>
                     <div class="col-lg-6 mb-4">
                        <!-- Instruction on the Ride side -->
                        <div class="card shadow mb-4">
                           <div class="card-header py-3">
                              <h6 class="m-0 font-weight-bold text-primary">SongBox Instruction</h6>
                           </div>
                           <div class="card-body">
                              <p>Try writing down an idea! Use the record button to start and stop recording.</p>
                              <p class="mb-0">We're currently using Mediarecorder API which might not work on some browsers - IE/Safari.</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright &copy; SongBox 2020</span>
                  </div>
               </div>
            </footer>
         </div>
      
   <?php endif; ?>
</div>