                <footer class="footer text-center">
                    All Rights Reserved by Alnat. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>
        
        <?php
            if(!empty($js)){
                foreach($js as $key => $cada_js){ ?>
                <script src="<?=base_url($cada_js)?>"></script>

        <?php   }
            }
        ?>
    
   
        <script src="<?=base_url('assets/libs/jquery-mask/jquery.mask.js')?>"></script>
        <script src="<?=base_url('assets/libs/popper.js/dist/umd/popper.min.js')?>"></script>
        <script src="<?=base_url('assets/libs/bootstrap/dist/js/bootstrap.min.js')?>"></script>
        <script src="<?=base_url('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')?>"></script>
        <script src="<?=base_url('assets/extra-libs/sparkline/sparkline.js')?>"></script>
        <script src="<?=base_url('assets/dist/js/waves.js')?>"></script> 
        <script src="<?=base_url('assets/dist/js/sidebarmenu.js')?>"></script>
        <script src="<?=base_url('assets/dist/js/custom.min.js')?>"></script>
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