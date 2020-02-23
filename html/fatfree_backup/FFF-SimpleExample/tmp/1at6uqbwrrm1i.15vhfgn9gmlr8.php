<!DOCTYPE html>
<html>
   <head>
      <link href="https://fonts.googleapis.com/css?family=Martel&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Mate&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Mate|Open+Sans&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="css/css-stylesheet.css">
      <title><?= $html_title ?></title>
      <meta charset='utf8' />
   </head>
   <body>
      <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>
   </body>
</html>
