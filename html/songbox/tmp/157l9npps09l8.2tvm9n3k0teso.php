<h2>Dashboard</h2>
Here's your existing songs.

<table>
	<tr>
		<th>#</th><th>Song</th><th>Tag</th><th>   </th><th>   </th>
	</tr>
	<?php foreach (($dbData?:[]) as $record): ?>
		<tr>
			<td><?= trim($record['id']) ?></td>
			<td><?= trim($record['songname']) ?></td>
			<td><?= trim($record['tag']) ?></td>

			<td><form id="deleteform" name="deleteform" method="post" action="<?= $BASE ?>/dashboard">
			  <input type="hidden" name="toDelete" value="<?= trim($record['id']) ?>">
				<input type="submit" name="delete" value="Delete" />
			</form>
			</td>

			<td><form id="editform" name="editform" method="get" action="<?= $BASE ?>/simpleformReq">
			  <input type="hidden" name="toEdit" value="<?= trim($record['id']) ?>">									<!-- hidden record that passes on the #id value -->
				<input type="submit" name="edit" value="Edit" />
			</form>
			</td>

		</tr>
	<?php endforeach; ?>
</table>

<p><a href="<?= $BASE ?>/simpleform">Create another song</a></p>
