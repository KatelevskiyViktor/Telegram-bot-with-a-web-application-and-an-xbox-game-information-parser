<?php
/**
 * This var from controllers
 * @var $page_name
 * @var $data['title']
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $data['title']?></title>
    <script src="<?= PATH ?>/assets/js/jquery-3.7.1.min.js"></script>
    <script src="<?= PATH ?>/assets/js/function.js"></script>
    <script src="<?= PATH ?>/assets/js/index.js"></script>
    <script src="<?= PATH ?>/assets/fontawesome-free-6.6.0-web/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="<?= PATH ?>/assets/css/css_reset.css">
    <link rel="stylesheet" href="<?= PATH ?>/assets/css/main.css">



</head>
<body>
<?php require_once PATH_TO_PAGES . $page_name . '.php'; ?>
</body>
</html>
