<!--
A very simple input form View template:
note that the form method is POST, and the action
is the URL for the route that handles form input.
 -->



 <p><a href="<?= $BASE ?>/dashboard">Back</a> <button id="recordButton">Record/Stop</button> </p>
<form id="form1" name="form1" method="post" action="<?= $BASE ?>/simpleform">
          <?php foreach (($hereThisRecord[$currentID]?:[]) as $record): ?><?php endforeach; ?>

          <input name="songname" type="text" value="<?= $record['songname'] ?>" id="songname" size="50">
          <br> <br>
          <textarea name="textarea" rows="5" cols="50" id="textarea"> <?= $record['textarea'] ?> </textarea>

<p>Choose a tag:
  <select name="tag" id="tag">
    <option value="blue">Blue</option>
    <option value="red" selected="selected">Red</option>
    <option value="green">Green</option>
  </select>
</p>
<p>
  <input type="submit" name="Submit" value="Submit" />
</p>

</form>


<script src="js/javascript.js"></script>
