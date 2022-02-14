<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; WN7Soft <?php echo date('Y')?></div>
                            <div>
                                <!--<a href="#" target="_blank">Privacy Policy</a>-->
                                &middot;
                                <!--<a href="#" target="_blank">Terms &amp; Conditions</a>-->
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url();?>/js/scripts.js"></script>
        <!--<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>-->
        <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>

        
        <!--<script src="<?php // echo base_url();?>/js/datatables-simple-demo.js"></script>-->
        <script src="<?php echo base_url();?>/assets/demo/datatables-demo.js"></script> 
        

<script>
    //$('#modal-confirma').modal('show');

    $('#modal-confirma').on('show.bs.modal', function(e){
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>

<script type="text/javascript">
// hacer que los mensajes de validacion nos aparezcan y se vayan en 3 segundos
$(document).ready(function() {
    setTimeout(function() {
        $(".alert").fadeOut(1500);
    },3000);
    /*setTimeout(function() {
        $("#datatablesSimple").reload();
    },3000);  */
    //setInterval($("#datatablesSimple").reload(), 180000);
});
</script>

    </body>
</html>
