<!doctype html>
<html lang="en">

<head>
    <?= view('partials/head', $data) ?>
</head>
<body<?= $bodyClasses ?>>
    <!-- [ Pre-loader ] start -->
    <div class="page-loader">
        <div class="bar"></div>
    </div>
    <!-- [ Pre-loader ] End -->

    <!-- [ Sidebar Menu ] start -->
    <?= view('components/sidebar', $data) ?>
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    <?= view('components/header', $data) ?>
    <!-- [ Header ] end -->

    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <?= view('components/breadcrumb', $data) ?>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <?= $content ?>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- [ Footer ] start -->
    <?= view('components/footer', $data) ?>
    <!-- [ Footer ] end -->

    <!-- [ Settings Panel ] start -->
    <?= view('components/settings-panel', $data) ?>
    <!-- [ Settings Panel ] end -->

    <!-- Required Js -->
    <?= view('partials/scripts', $data) ?>
    </body>

</html>