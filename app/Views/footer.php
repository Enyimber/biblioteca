</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" id="scrollTopLink">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <!-- Usar el helper 'base_url' para la ruta en CodeIgniter 4 -->
                <a class="btn btn-primary" href="<?= base_url('login/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Logout Modal -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('plantilla/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('plantilla/js/desplasar.js') ?>"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

<!-- DataTables for Bootstrap 4 -->
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('plantilla/js/sb-admin-2.min.js') ?>"></script>
<script src="<?= base_url('plantilla/js/notificaciones.js') ?>"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successMessage = "<?= session()->getFlashdata('success'); ?>";
    const errorMessage = "<?= session()->getFlashdata('error'); ?>";

        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: successMessage
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: errorMessage
            });
        }
    });
</script>

</body>

</html>