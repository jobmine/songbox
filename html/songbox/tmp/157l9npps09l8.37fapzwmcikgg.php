<!--
A very simple response View template:
just echoes what the input data were.
The parameter "formData" is an array that
has been set as a global F3 variable, using $f3->set().
 -->

<h1>Thanks for your data, <?= $formData['songname'] ?> ...</h1>
<p> Your tag was <?= $formData['tag'] ?> </p>
<p> Your text was <?= $formData['textarea'] ?> </p>
<hr />
<a href="<?= $BASE ?>/dashboard">Show all songs</a>
