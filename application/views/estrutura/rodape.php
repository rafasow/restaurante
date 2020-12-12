<footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <?php
        if(!empty($js)){
            foreach($js as $key => $cada_js){ ?>
            <script src="<?=base_url($cada_js)?>"></script>

    <?php   }
        }
    ?>
    
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url('assets/libs/jquery-mask/jquery.mask.js')?>"></script>
    <script src="<?=base_url('assets/libs/popper.js/dist/umd/popper.min.js')?>"></script>
    <script src="<?=base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/extra-libs/sparkline/sparkline.js')?>"></script>
    <!--Wave Effects -->
    <script src="<?=base_url('assets/dist/js/waves.js')?>"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url('assets/dist/js/sidebarmenu.js')?>"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url('assets/dist/js/custom.min.js')?>"></script>
    <!--This page JavaScript -->
    <!-- <script src="../../dist/js/pages/dashboards/dashboard1.js"></script> -->
    <!-- Charts js Files -->
    <script src="<?=base_url('assets/libs/flot/excanvas.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot/jquery.flot.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot/jquery.flot.pie.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot/jquery.flot.time.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot/jquery.flot.stack.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot/jquery.flot.crosshair.js')?>"></script>
    <script src="<?=base_url('assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')?>"></script>
    <script src="<?=base_url('assets/dist/js/pages/chart/chart-page-init.js')?>"></script>

</body>

</html>