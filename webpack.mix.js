const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles('resources/css/main.css', 'public/css/main.css')
    .sourceMaps();


mix.copyDirectory(
    "resources/js/datatable/jquery.dataTables.js",
    "public/assets" + "/js/datatable/datatable.js"
)
    .copyDirectory(
        "resources/css/datatable/jquery.dataTables.css",
        "public/assets" + "/css/datatable/datatable.css"
    )

    .copyDirectory(
        "resources/js/ace.js",
        "public/assets" + "/js/ace.js"
    )

    .copyDirectory(
        "resources/js/apexcharts.js",
        "public/assets" + "/js/apexcharts.js"
    )

    .copyDirectory(
        "resources/js/bootstrap-colorpicker.js",
        "public/assets" + "/js/bootstrap-colorpicker.js"
    )

    .copyDirectory(
        "resources/js/bootstrap-maxlength.js",
        "public/assets" + "/js/bootstrap-maxlength.js"
    )

    .copyDirectory(
        "resources/js/carousel.js",
        "public/assets" + "/js/carousel.js"
    )

    .copyDirectory(
        "resources/js/carousel-rtl.js",
        "public/assets" + "/js/carousel-rtl.js"
    )

    .copyDirectory(
        "resources/js/chartjs.js",
        "public/assets" + "/js/chartjs.js"
    )

    .copyDirectory(
        "resources/js/chat.js",
        "public/assets" + "/js/chat.js"
    )

    .copyDirectory(
        "resources/js/cropper.js",
        "public/assets" + "/js/cropper.js"
    )

    .copyDirectory(
        "resources/js/dashboard.js",
        "public/assets" + "/js/dashboard.js"
    )

    .copyDirectory(
        "resources/js/data-table.js",
        "public/assets" + "/js/data-table.js"
    )

    .copyDirectory(
        "resources/js/datepicker.js",
        "public/assets" + "/js/datepicker.js"
    )

    .copyDirectory(
        "resources/js/demo.js",
        "public/assets" + "/js/demo.js"
    )

    .copyDirectory(
        "resources/js/dropify.js",
        "public/assets" + "/js/dropify.js"
    )

    .copyDirectory(
        "resources/js/dropzone.js",
        "public/assets" + "/js/dropzone.js"
    )

    .copyDirectory(
        "resources/js/email.js",
        "public/assets" + "/js/email.js"
    )

    .copyDirectory(
        "resources/js/file-upload.js",
        "public/assets" + "/js/file-upload.js"
    )

    .copyDirectory(
        "resources/js/form-validation.js",
        "public/assets" + "/js/form-validation.js"
    )

    .copyDirectory(
        "resources/js/fullcalendar.js",
        "public/assets" + "/js/fullcalendar.js"
    )

    .copyDirectory(
        "resources/js/inputmask.js",
        "public/assets" + "/js/inputmask.js"
    )

    .copyDirectory(
        "resources/js/jquery.flot.js",
        "public/assets" + "/js/jquery.flot.js"
    )

    .copyDirectory(
        "resources/js/morris.js",
        "public/assets" + "/js/morris.js"
    )

    .copyDirectory(
        "resources/js/peity.js",
        "public/assets" + "/js/peity.js"
    )

    .copyDirectory(
        "resources/js/select2.js",
        "public/assets" + "/js/select2.js"
    )

    .copyDirectory(
        "resources/js/simplemde.js",
        "public/assets" + "/js/simplemde.js"
    )

    .copyDirectory(
        "resources/js/sparkline.js",
        "public/assets" + "/js/sparkline.js"
    )

    .copyDirectory(
        "resources/js/spinner.js",
        "public/assets" + "/js/spinner.js"
    )

    .copyDirectory(
        "resources/js/sweet-alert.js",
        "public/assets" + "/js/sweet-alert.js"
    )

    .copyDirectory(
        "resources/js/tags-input.js",
        "public/assets" + "/js/tags-input.js"
    )

    .copyDirectory(
        "resources/js/template.js",
        "public/assets" + "/js/template.js"
    )

    .copyDirectory(
        "resources/js/timepicker.js",
        "public/assets" + "/js/timepicker.js"
    )

    .copyDirectory(
        "resources/js/tinymce.js",
        "public/assets" + "/js/tinymce.js"
    )

    .copyDirectory(
        "resources/js/typeahead.js",
        "public/assets" + "/js/typeahead.js"
    )

    .copyDirectory(
        "resources/js/wizard.js",
        "public/assets" + "/js/wizard.js"
    )

    .copyDirectory(
        "resources/js/custom.js",
        "public" +  "/js/custom.js"
    )