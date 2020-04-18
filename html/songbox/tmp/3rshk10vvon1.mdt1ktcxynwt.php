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
            <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-7">
               <div class="p-5">
                  <div class="text-center">
                     <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" action="<?= $BASE ?>/login">
                     <div class="form-group ">
                        <input name="uname" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                     </div>
                     <div class="form-group">
                        <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                     </div>
                     <div class="pt-2 pb-4">
                        <div class="alert alert-info" role="alert"><?= $message ?></div>
                     </div>
                     <input type="submit" name="submit" value="Login" class="btn btn-primary btn-user btn-block login-signup">
                  </form>
                  <hr>
                  <div class="text-center">
                     <a class="small" href="<?= $BASE ?>/dummy_register/in">Create a new account</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
