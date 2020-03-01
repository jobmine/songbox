<div class="navbar"> 	<!-- navbar div -->
	<span class="web-title">Songbox</span>
	<div class="signup">
		<button class="invisible-border" type="button">Sign in</button>
		<button type="button">Sign up</button>
	</div>
</div>

<div class=main>						<!--2 MAIN CONTAINER -layout -->


	<div class=left-margin> 	<!-- leftdiv - layout -->
	</div>

	<div class=center> 				<!-- center div - layout -->
	<h2>Dashboard</h2>
	<p>Here's your existing songs.</p>


			<?php foreach (($dbData?:[]) as $record): ?>

			<div class="songrow">
					<span class="id"> <?= trim($record['id']) ?> </span>
					<span><?= trim($record['songname']) ?> </span>
					<span class="tag"><?= trim($record['tag']) ?></span>

					<div class="formbox">
						<form class="sameline" id="deleteform" name="deleteform" method="post" action="<?= $BASE ?>/dashboard">
						  <input type="hidden" name="toDelete" value="<?= trim($record['id']) ?>">
							<input type="submit" name="delete" value="Delete" />
						</form>

						<form class="sameline" id="editform" name="editform" method="get" action="<?= $BASE ?>/simpleformReq">
						  <input type="hidden" name="toEdit" value="<?= trim($record['id']) ?>">									<!-- hidden record that passes on the #id value -->
							<input type="submit" name="edit" value="Edit" />
						</form>
					</div>

				</p>
			</div>

			<?php endforeach; ?>

<form name="go" method="get" action="<?= $BASE ?>/simpleform">									<!-- hidden record that passes on the #id value -->
	<input class="create-btn" type="submit" name="create-btn" value="Create Song" />
</form>

</div>

	<div class=right-margin> <!-- right div - layout -->
	</div>

</div> <!--end of MAIN CONTAINER - layout-->

<div class="footer">
<span> © 2020 All Rights Reserved</span>
<span> Designed by Damyana S. </span>
 </div> <!--3 footer div -->