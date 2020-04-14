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
            <form class="user">
              <div class="form-group ">
                <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox small">
                  <input type="checkbox" class="custom-control-input" id="customCheck">
                  <label class="custom-control-label" for="customCheck">Remember Me</label>
                </div>
              </div>
              <a href="<?= $BASE ?>/dashboard" class="btn btn-primary btn-user btn-block">
                Login
              </a>
            </form>
            <hr>
            <div class="text-center">
              <a class="small" href="<?= $BASE ?>/dummy_register">Create a new account</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>