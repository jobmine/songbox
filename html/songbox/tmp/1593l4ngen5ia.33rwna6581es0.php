<nav class="navbar navbar-marketing navbar-expand-lg bg-transparent navbar-dark fixed-top">
   <div class="container">
      <a class="navbar-brand text-white" href="<?= $BASE ?>/">SongBox</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i data-feather="menu"></i></button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav ml-auto mr-lg-5">
            <li class="nav-item"><a class="nav-link" href="<?= $BASE ?>/"> </a></li>
         </ul>
      </div>
   </div>
</nav>
<div class="container pt-4">
   <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
         <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
               <div class="p-5">
                  <div class="text-center">
                     <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                  </div>
                  <form class="user" method="post" action="<?= $BASE ?>/register">
                     <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                           <input name="fname" type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" required>
                        </div>
                        <div class="col-sm-6">
                           <input name="lname" type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" required>
                        </div>
                     </div>
                     <div class="form-group">
                        <input name="uname" type="text" class="form-control form-control-user" id="exampleInputEmail" placeholder="Username" required>
                     </div>
                     <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                           <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 8 characters' : ''); if(this.checkValidity()) form.re_password.pattern = this.value;"  required>
                        </div>
                        <div class="col-sm-6">
                           <input name="re_password" type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" pattern="^\S{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" required>
                        </div>
                     </div>
                     <div class="pt-2">
                        <div class="alert alert-info " role="alert"><?= $reg_err_msg ?></div>
                        <p class="pb-2"><?= $reg_err_msgspan ?></p>
                     </div>
                     <input type="submit" name="submit" value="Register" class="btn btn-primary btn-user btn-block">
                  </form>
                  <hr>
                  <div class="text-center">
                     <a class="small" href="<?= $BASE ?>/dummy_login/in">Already have an account? Login!</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>