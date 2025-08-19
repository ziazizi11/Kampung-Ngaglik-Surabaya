<footer class="bg-[#A5D6A7] text-black">
    <div class="container mx-auto px-6 py-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <a href="index.php" class="flex items-center space-x-3 mb-4">
                    <img class="h-10 w-auto" src="image/logo.png" alt="Logo Kampung Ngaglik">
                    <span class="text-xl font-bold">Kampung Ngaglik</span>
                </a>
                <p class="text-sm opacity-90">
                    Sebuah kampung kreatif dan mandiri di jantung Kota Surabaya, berkomitmen pada budaya, kebersihan, dan kesejahteraan warganya.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="index.php" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="kegiatan.php" class="hover:text-white transition-colors">Kegiatan</a></li>
                    <li><a href="umkm.php" class="hover:text-white transition-colors">UMKM</a></li>
                    <li><a href="tentang.php" class="hover:text-white transition-colors">Sejarah</a></li>
                    <li><a href="alamat.php" class="hover:text-white transition-colors">Tentang Kami</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                <div class="space-y-3 text-sm">
                    <p class="flex items-start">
                        <i class="fas fa-map-marker-alt w-4 mr-3 mt-1"></i>
                        <span>Jl Lumpia, Kampung Ngaglik<br>Kota Surabaya - Jawa Timur</span>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-phone-alt w-4 mr-3"></i>
                        <a href="tel:+6281234567890" class="hover:text-white transition-colors">+62 812 3456 7890</a>
                    </p>
                    <p class="flex items-center">
                        <i class="fas fa-envelope w-4 mr-3"></i>
                        <a href="mailto:info@kampungngaglik.go.id" class="hover:text-white transition-colors">info@kampungngaglik.go.id</a>
                    </p>
                </div>
            </div>

            <div>
                <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="#" aria-label="Facebook" class="w-10 h-10 bg-black/10 hover:bg-white hover:text-green-700 rounded-full flex items-center justify-center transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                </div>
            </div>
            
        </div>

        <hr class="border-black/20 my-6" />
        <div class="text-center text-sm">
            <p>&copy; <?= date('Y') ?> Kampung Ngaglik Surabaya. All Rights Reserved.</p>
        </div>

    </div>
</footer>

</body>
</html>