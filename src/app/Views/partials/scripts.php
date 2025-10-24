<!-- Required Js -->
<script src="<?= $themePath ?>/assets/js/plugins/popper.min.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/simplebar.min.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= $themePath ?>/assets/js/fonts/custom-font.js"></script>
<script src="<?= $themePath ?>/assets/js/pcoded.js"></script>
<script src="<?= $themePath ?>/assets/js/plugins/feather.min.js"></script>

<!-- Theme Configuration -->
<script>
    // Set theme mode
    layout_change('<?= $theme['mode'] ?>');

    // Set layout
    main_layout_change('<?= $theme['layout'] ?>');

    // Set sidebar caption
    layout_caption_change('<?= $theme['sidebar_caption'] ? 'true' : 'false' ?>');

    // Set direction
    layout_rtl_change('<?= $theme['direction'] === 'rtl' ? 'true' : 'false' ?>');

    // Set container
    change_box_container('<?= $theme['container'] === 'container' ? 'true' : 'false' ?>');

    // Set preset
    preset_change('<?= $theme['color_preset'] ?>');

    // Set contrast
    layout_theme_contrast_change('<?= $theme['contrast'] ? 'true' : 'false' ?>');
</script>

<?php if (isset($additionalJs) && is_array($additionalJs)): ?>
    <?php foreach ($additionalJs as $js): ?>
        <script src="<?= $js ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>