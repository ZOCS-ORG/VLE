    </div>
    </div>
      <!-- Footer -->
      <footer class="sticky-footer sidebar_new_bg">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span style="color:#ffffff">Powered by <?php echo $app_name.".  &copy; ".date('Y') ?>. </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <!-- Bootstrap core JavaScript-->
  <script src="../../../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../../../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../../../assets/sb-admin-2.min.js"></script>

  <!-- J-Query -->
  <script src="jquery.js"></script>
  <script src="jquery-ui.js"></script>
  <!-- DataTables -->
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> -->
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> -->
  <!-- <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script> -->

  <script>
    /** DataTable Printable/Exportable... */
    $(document).ready(function() {
        var table = $('#export').DataTable( {
            lengthChange: false,
            buttons: [ 'excel', 'pdf' ]
        } );
        table.buttons().container()
            .appendTo( '#export_wrapper .col-md-6:eq(0)' );
    } );

  </script>




</body>

</html>
