<!-- [Head] start -->
<title><?= $pageTitle ?? 'Dashboard' ?> | <?= $config->appName ?? 'CI4 Admin' ?></title>

<!-- [Meta] -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="<?= $config->appName ?? 'CI4 Admin' ?> - Modern admin dashboard">
<meta name="keywords" content="admin dashboard, bootstrap admin, php admin, codeigniter admin">
<meta name="author" content="CI4 Admin">

<!-- [Favicon] icon -->
<link rel="icon" href="<?= $themePath ?>/assets/images/favicon.svg" type="image/x-icon">

<!-- [Font] Family -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/inter/inter.css" id="main-font-link">

<!-- [phosphor Icons] https://phosphoricons.com/ -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/phosphor/duotone/style.css">

<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/tabler-icons.min.css">

<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/feather.css">

<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/fontawesome.css">

<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/fonts/material.css">

<!-- [Template CSS Files] -->
<link rel="stylesheet" href="<?= $themePath ?>/assets/css/style.css" id="main-style-link">
<link rel="stylesheet" href="<?= $themePath ?>/assets/css/style-preset.css">

<?php if (isset($additionalCss) && is_array($additionalCss)): ?>
    <?php foreach ($additionalCss as $css): ?>
        <link rel="stylesheet" href="<?= $css ?>">
    <?php endforeach; ?>
<?php endif; ?>

<!-- [Head] end -->