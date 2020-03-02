<div id="wrapper">




	<!-- SIDE BAR -->

	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= $BASE ?>/">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-laugh-wink"></i>
			</div>
			<div class="sidebar-brand-text mx-3">Song Writin</div>
		</a>

		<hr class="sidebar-divider my-0">

		<li class="nav-item active">
			<a class="nav-link" href="#">
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
					<a class="collapse-item" href="<?= $BASE ?>/dummy_login">Logout</a>

					<div class="collapse-divider"></div>
					<h6 class="collapse-header">New User?</h6>
					<a class="collapse-item" href="<?= $BASE ?>/dummy_login">Switch Account</a>
					<a class="collapse-item" href="<?= $BASE ?>/dummy_register">Register</a>

				</div>
			</div>

		</li>


	</ul>





<!-- DASHBOARD -->



	<div id="content-wrapper" class="d-flex flex-column">
		<div id="content">
			<div class="container-fluid mt-4">
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
				</div>




				<div class="row">
					<div class="col-lg-6 mb-4">


<!-- Record Audio Button -->

						 <!-- Second sample -->
						<div class="row">

								<div class="col-lg-6 mb-4">
									<div class="card bg-primary text-white shadow create-card">
										<div class="card-body">

											<span> // </span>
											<form name="go" method="get" action="<?= $BASE ?>/simpleform">									<!-- hidden record that passes on the #id value -->
												<input class="create-btn" type="submit" name="create-btn" value="Create Song" />
											</form>

											<div class="text-white-50 small">  Create a new song  </div>
											<div class="text-white-50 small"> '                                           ' </div>
										</div>
									</div>
								</div>

								<?php foreach (($dbData?:[]) as $record): ?>

								<div class="col-lg-6 mb-4">
									<div class="card bg-primary text-white shadow">
										<div class="card-body">
												<span class="id"> <?= trim($record['id']) ?> </span>
												<span><?= trim($record['songname']) ?> </span>

												<div class="buttons">
													<form class="sameline" id="deleteform" name="deleteform" method="post" action="<?= $BASE ?>/dashboard">
														<input type="hidden" name="toDelete" value="<?= trim($record['id']) ?>">
														<input id="deleteButton" type="submit" name="delete" value="Delete" />
													</form>

													<form class="sameline" id="editform" name="editform" method="get" action="<?= $BASE ?>/simpleformReq">
														<input type="hidden" name="toEdit" value="<?= trim($record['id']) ?>">									<!-- hidden record that passes on the #id value -->
														<input id="editButton" type="submit" name="edit" value="Edit" />
													</form>
												</div> <!-- formbox end -->
										</div> <!-- card-body end -->
											<div class="text-white-50 small date-padding tag">
												Feb 23, 2020 8:20
												<span class=""><?= trim($record['tag']) ?></span>
											</div>
									</div>  <!-- card end -->
								</div>		<!-- row end -->
										<?php endforeach; ?>

						</div>




					</div>

					<div class="col-lg-6 mb-4">



						<!-- Instruction on the Ride side -->
						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">Song Writing Instruction</h6>
							</div>
							<div class="card-body">
								<p>Domestic confined any but son bachelor advanced remember. How proceed offered her offence shy forming. Returned peculiar pleasant but appetite differed she. Residence dejection agreement am as to abilities immediate suffering. Ye am depending propriety sweetness distrusts belonging collected.</p>
								<p class="mb-0">Call park out she wife face mean. Invitation excellence imprudence understood it continuing to. Ye show done an into. Fifteen winding related may hearted colonel are way studied. County suffer twenty or marked no moment in he. Meet shew or said like he.</p>
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
					<span>Copyright &copy; Song Writin App 2020</span>
				</div>
			</div>
		</footer>

	</div>

</div>
