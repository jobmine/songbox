<!DOCTYPE html>
<html>
   <head>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" rel="stylesheet" type="text/css">
     <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <link href="<?= $BASE ?>/css/stylesheet.css" rel="stylesheet">
      <title><?= $html_title ?></title>
      <meta charset='utf8' />
   </head>
   <body id="page-top">

      <?php echo $this->render($content,NULL,get_defined_vars(),0); ?>
      <script src="<?= $BASE ?>/js/jquery.min.js"></script>
      <script src="<?= $BASE ?>/js/bootstrap.bundle.min.js"></script>

   </body>
</html>
