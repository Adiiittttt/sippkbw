<!-- Konten utama berakhir di sini -->
</main>

<footer class="bg-light py-4 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5><?php echo SITE_NAME; ?></h5>
                <p>Menyediakan layanan penjualan dan perbaikan komputer terbaik untuk Anda.</p>
            </div>
            <div class="col-md-4">
                <h5>Links</h5>
                <ul class="list-unstyled">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="../produk/index.php">Produk</a></li>
                    <li><a  href="<?php echo BASE_URL; ?>/perbaikan/form.php?service=<?php ['IDperbaikan']; ?>">Perbaikan</a></li>
                    <li><a href="../tentang-kami.php">Tentang Kami</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Kontak</h5>
                <address>
                    Jl.kenangan bersama No. 02<br>
                    Kota banjarmasin, 70654<br>
                    Indonesia<br>
                    <br>
                    Email: info@komputerstore.com<br>
                    Telp: (021) 1234-5678
                </address>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p>&copy; <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.</p>
            </div>
            
        </div>
    </div>
</footer>

<script src="<?php echo BASE_URL; ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo BASE_URL; ?>/assets/js/custom.js"></script>
<!-- Tambahkan script JavaScript tambahan di sini -->
</body>
</html>