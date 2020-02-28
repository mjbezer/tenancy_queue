const mix = require('laravel-mix') ;
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


mix 

    // CSS E JS DA LANDING PAGE - SITE
    .styles([
    'resources/site/css/bootstrap.min.css',
    'resources/site/css/jarallax-demo.min.css',
    'resources/site/css/waves.min.css',
    'resources/site/css/lightbox.css',
    'resources/site/slick-carousel/slick/slick.css',
    'resources/site/css/main.css',
    'resources/site/css/responsive.css',
    'resources/site/css/landingpage.css',
    ],'public/site/site.css')
  
    .styles([
    'resources/site/icon/icofont/css/icofont.css'
    ],'public/site/icon/icofont/css/icofont.css')
    
    .styles([
        'resources/site/css/register/codebase.css'
        ],'public/site/css/register/codebase.css')

    .scripts([
    'resources/site/js/jquery.min.js',
    'resources/site/js/tether.min.js',
    'resources/site/js/lightbox-plus-jquery.min.js',
    'resources/site/js/waves.min.js',
    'resources/site/js/bootstrap/bootstrap.min.js',
    'resources/site/js/jarallax.min.js',
    'resources/site/js/plugins2.js',
    'resources/site/slick-carousel/slick/slick.min.js',
    'resources/site/js/jquery.isotope.js',
    'resources/site/js/isotope.pkgd.min.js',
    'resources/site/js/landing-page.js'
    ],'public/site/site.js')

    .scripts([
        'resources/site/js/jquery.mask.js',
    ],'public/site/js/register/jquery.mask.js')    


    .scripts([
        'resources/site/js/register/codebase.core.min.js',
    ],'public/site/js/register/codebase.core.min.js')    

    .scripts([
        'resources/site/js/register/codebase.app.min.js',
    ],'public/site/js/register/codebase.app.min.js')

    .scripts([
        'resources/site/js/register/jquery-validation/jquery.validate.min.js',
    ],'public/site/js/register/jquery-validation/jquery.validate.min.js')

    .scripts([
        'resources/site/js/validade/cadastro.js',
    ],'public/site/js/validade/cadastro.js')
    

    .copyDirectory('resources/site/images/loading.gif','public/images/loading.gif')
    .copyDirectory('resources/site/images/prev.png','public/images/prev.png')
    .copyDirectory('resources/site/images/landingpage/menu.png','public/images/landingpage/menu.png')
    .copyDirectory('resources/site/images/landingpage/aboutus.jpg','public/landing/images/landingpage/aboutus.jpg')
    .copyDirectory('resources/site/images/landingpage/03.jpg','public/landing/images/landingpage/03.jpg')
    .copyDirectory('resources/site/images/landingpage/data-ex.jpg','public/landing/images/landingpage/data-ex.jpg')
    .copyDirectory('resources/site/images/landingpage/footer-bg.jpg','public/landing/images/landingpage/footer-bg.jpg')
    .copyDirectory('resources/site/images/landingpage/cabelereiro.png','public/images/landingpage/cabelereiro.png')
    .copyDirectory('resources/site/images/landingpage/fisioterapeuta.png','public/images/landingpage/fisioterapeuta.png')
    .copyDirectory('resources/site/images/landingpage/coaching.png','public/images/landingpage/coaching.png')
    .copyDirectory('resources/site/images/landingpage/quiropraxista.png','public/images/landingpage/quiropraxista.png')
    .copyDirectory('resources/site/images/landingpage/tatuadores.png','public/images/landingpage/tatuadores.png')
    .copyDirectory('resources/site/images/landingpage/pilates.png','public/images/landingpage/pilates.png')
    .copyDirectory('resources/site/images/landingpage/esteticista.png','public/images/landingpage/esteticista.png')
    .copyDirectory('resources/site/images/landingpage/manicure.png','public/images/landingpage/manicure.png')
    .copyDirectory('resources/site/icon/icofont/fonts','public/site/icon/icofont/fonts')
    .copyDirectory('resources/imagens/IconeAA.ico','public/images/favicon.ico')
    
    // FINAL DO MIX DA LANDING PAGE




    // ELEMENTOS CSS BÁSICOS APP
    // CODEBASE E SWEETALERT
    .styles([
        'resources/app/css/codebase.css'
    ], 'public/app/css/app.css')

    // SWEET ALERT
    .styles([
        'resources/assets/sweetalert2/css/sweetalert2.min.css'
    ],'public/assets/sweetalert2/css/sweetalert2.min.css')
    .scripts([
        'resources/assets/sweetalert2/js/sweetalert2.min.js'
    ],'public/assets/sweetalert2/js/sweetalert2.min.js')


    // SELECT2
    .styles([
        'resources/assets/select2/css/select2.css'
    ],'public/assets/select2/css/select2.css')
    .scripts([
        'resources/assets/select2/js/select2.js'
    ],'public/assets/select2/js/select2.js')

    // FONTS
    .copyDirectory('resources/app/fonts','public/app/fonts')


    // FULLCALENDAR
    .styles([
        'resources/assets/fullcalendar/packages/core/main.css',
        'resources/assets/fullcalendar/packages/bootstrap/main.css',
        'resources/assets/fullcalendar/packages/daygrid/main.css',
        'resources/assets/fullcalendar/packages/list/main.css',
        'resources/assets/fullcalendar/packages/timegrid/main.css'
    ],'public/assets/fullcalendar/fullcalendar.css')
    .scripts([
        'resources/assets/fullcalendar/packages/bootstrap/main.js',
        'resources/assets/fullcalendar/packages/core/main.js',
        'resources/assets/fullcalendar/packages/core/locales/pt-br.js',
        'resources/assets/fullcalendar/packages/daygrid/main.js',
        'resources/assets/fullcalendar/packages/list/main.js',
        'resources/assets/fullcalendar/packages/timegrid/main.js',
        'resources/assets/fullcalendar/packages/rrule/main.js',
        'resources/assets/fullcalendar/packages/moment/main.js'
    ],'public/assets/fullcalendar/fullcalendar.js')



    // DATATABLES
    .styles([        
        'resources/assets/DataTables/css/dataTables.bootstrap4.css',
        'resources/assets/AutoFill-2.3.4/css/autoFill.bootstrap4.min.css',
        'resources/assets/Buttons-1.6.1/css/buttons.bootstrap4.css',
        'resources/assets/ColReorder-1.5.2/css/colReorder.bootstrap4.css',
        'resources/assets/FixedColumns-3.3.0/css/fixedColumns.bootstrap4.css',
        'resources/assets/FixedHeader-3.1.6/css/fixedHeader.bootstrap4.css',
        'resources/assets/KeyTable-2.5.1/css/keyTable.bootstrap4.css',
        'resources/assets/Responsive-2.2.3/css/responsive.bootstrap4.css',
        'resources/assets/RowGroup-1.1.1/css/rowGroup.bootstrap4.css',
        'resources/assets/RowReorder-1.2.6/css/rowReorder.bootstrap4.css',
        'resources/assets/Scroller-2.0.1/css/scroller.bootstrap4.css',
        'resources/assets/SearchPanes-1.0.1/css/searchPanes.bootstrap4.css',
        'resources/assets/Select-1.3.1/css/select.bootstrap4.css'
    ],'public/assets/datatable/datatable.css')
    .scripts([
        'resources/assets/DataTables/JSZip-2.5.0/jszip.js',
        'resources/assets/DataTables/pdfmake-0.1.36/pdfmake.js',
        'resources/assets/DataTables/pdfmake-0.1.36/vfs_fonts.js',
        'resources/assets/DataTables/DataTables-1.10.20/js/jquery.dataTables.js',
        'resources/assets/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.js',
        'resources/assets/DataTables/AutoFill-2.3.4/js/dataTables.autoFill.js',
        'resources/assets/DataTables/AutoFill-2.3.4/js/autoFill.bootstrap4.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/dataTables.buttons.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/buttons.bootstrap4.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/buttons.colVis.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/buttons.flash.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/buttons.html5.js',
        'resources/assets/DataTables/Buttons-1.6.1/js/buttons.print.js',
        'resources/assets/DataTables/ColReorder-1.5.2/js/dataTables.colReorder.js',
        'resources/assets/DataTables/FixedColumns-3.3.0/js/dataTables.fixedColumns.js',
        'resources/assets/DataTables/FixedHeader-3.1.6/js/dataTables.fixedHeader.js',
        'resources/assets/DataTables/KeyTable-2.5.1/js/dataTables.keyTable.js',
        'resources/assets/DataTables/Responsive-2.2.3/js/dataTables.responsive.js',
        'resources/assets/DataTables/RowGroup-1.1.1/js/dataTables.rowGroup.js',
        'resources/assets/DataTables/RowReorder-1.2.6/js/dataTables.rowReorder.js',
        'resources/assets/DataTables/Scroller-2.0.1/js/dataTables.scroller.js',
        'resources/assets/DataTables/SearchPanes-1.0.1/js/dataTables.searchPanes.js',
        'resources/assets/DataTables/Select-1.3.1/js/dataTables.select.js'
    ],'public/assets/datatable/datatable.js')





    .version() ;