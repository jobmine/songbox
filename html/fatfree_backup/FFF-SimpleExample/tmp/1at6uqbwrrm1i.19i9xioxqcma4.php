<!--
A very simple input form View template:
note that the form method is POST, and the action
is the URL for the route that handles form input.
 -->

 <p><a href="<?= $BASE ?>/dashboard">Back</a> <button id="recordButton">Record/Stop</button> </p>
<form id="form1" name="form1" method="post" action="<?= $BASE ?>/simpleformReq">

          <input name="songname" type="text" value="<?= $hereThisRecord['songname'] ?>" id="songname" size="50">
          <br><br>
          <textarea name="textarea" rows="5" cols="50" id="textarea"><?= $hereThisRecord['textarea'] ?></textarea>

<p>Choose a tag:
  <select name="tag" id="tag">
    <option value="blue">Blue</option>
    <option value="red" selected="selected">Red</option>
    <option value="green">Green</option>
  </select>
</p>
<p>
  <input type="hidden" name="toEdit" value="<?= $hereThisRecord['id'] ?>">  									<!-- //hidden record that passes on the #id value -->
  <input class="create-btn" type="submit" name="Submit" value="Submit" id="submitEditButton"/>
</p>

</form>


<script src="js/javascript.js"></script>
