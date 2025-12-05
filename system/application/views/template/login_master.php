<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets_2/'; ?>vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets_2/'; ?>vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets_2/'; ?>vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url().'static/adminpanel/assets_2/'; ?>css/style.css"> <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url().'static/adminpanel/assets/'; ?>images/icon/favicon_new.png" />

    <style>
        #preloader {
                position: fixed;
                left: 0;
                top: 0;
                z-index: 99999;
                height: 100%;
                width: 100%;
                background: #fff;
                display: flex;
            }

            .loader{
                margin: auto;
                height: 50px;
                width: 50px;
                border-radius: 50%;
                position: relative;
            }


            .loader:before{
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                background: #000;
                border-radius: 50%;
                opacity: 0;
                animation: popin 1.5s linear infinite 0s;
            }

            .loader:after{
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 100%;
                background: #000;
                border-radius: 50%;
                opacity: 0;
                animation: popin 1.5s linear infinite 0.5s;
            }
    </style>

  </head>
  <body>

    <div id="preloader">
            <div class="loader"></div>
        </div>        
      
    <div class="container-scroller">
      
        <?php echo $contents  ;?>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url().'static/adminpanel/assets_2/'; ?>vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url().'static/adminpanel/assets_2/'; ?>js/off-canvas.js"></script>
    <script src="<?php echo base_url().'static/adminpanel/assets_2/'; ?>js/misc.js"></script>
    <!-- endinject -->

        <script>
            var preloader = $('#preloader');
            $(window).on('load', function() {
                setTimeout(function() {
                    preloader.fadeOut('fast', function() { $(this).remove(); });
                }, 10)
            });
        </script>        

  </body>
</html>