

                <footer class="footer">
                    <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        2024, feito com <i class="fa fa-heart heart text-danger"></i> por
                        <a href="http://www.themekita.com">Notaro Developer</a>
                    </div>
                    <div>
                        <p>&copy; 2024 Lucia Flores. Todos os direitos reservados.</p>
                    </div>
                    </div>
                </footer>
            </div>
            <!-- End Custom template -->
        </div>
    </main>
    <!--   Core JS Files   -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    @if (env('APP_ENV') === 'local')
      <script src="/assets/js/admin/main.js"></script>
    @else
      <script src="/assets/js/admin/min-main.js"></script>
    @endif
</body>
</html>