<?php 
// 1. Panggil header yang konsisten
include 'header.php'; 
// 2. Koneksi ke database (disiapkan jika nanti diperlukan)
include 'koneksi/koneksi.php';
?>

<title>Alamat & Kontak - Kampung Ngaglik</title>

<div class="bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto text-center py-12 px-6">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-800">Lokasi & Kontak Kami</h1>
        <p class="text-lg text-gray-600 mt-2">Kami senang bisa terhubung dengan Anda. Kunjungi kami atau hubungi melalui detail di bawah ini.</p>
    </div>
</div>

<div class="bg-white py-16 sm:py-20">
    <div class="container mx-auto max-w-7xl px-6">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <div class="map-container w-full h-96 md:h-full rounded-xl shadow-xl overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.8876439327663!2d112.7383236747511!3d-7.253658692753046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f952c9a9709b%3A0x8a703d120a359560!2sKampung%20Lawas%20Maspati!5e0!3m2!1sen!2sid!4v1718136365449!5m2!1sen!2sid" 
                    width="600" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full">
                </iframe>
            </div>

            <div class="info-panel bg-gray-50 rounded-xl p-8 lg:p-10">
                
                <div>
                    <h2 class="text-2xl font-bold heading-font text-gray-800">Kunjungi Kami</h2>
                    <p class="mt-2 text-gray-600 leading-relaxed">
                        Kampung Lumpia terletak di jantung kota, dikenal sebagai pusat kuliner tradisional yang ramai. Lokasi ini mudah diakses dan dikelilingi oleh berbagai fasilitas umum, menjadikannya destinasi favorit untuk menikmati lumpia khas dan suasana kampung yang hangat.
                    </p>
                </div>

                <hr class="my-8 border-gray-200">

                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-800 mb-5">Detail Kontak</h3>
                    <div class="space-y-5">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-xl w-6 text-green-600 mt-1"></i>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600">Jl. Lumpia No. 123, Ngaglik, Surabaya, Jawa Timur</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-phone-alt text-xl w-6 text-green-600 mt-1"></i>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Telepon</h4>
                                <a href="tel:+6281234567890" class="text-gray-600 hover:text-green-700 transition-colors">+62 812 3456 7890</a>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-envelope text-xl w-6 text-green-600 mt-1"></i>
                            <div class="ml-4">
                                <h4 class="font-semibold text-gray-800">Email</h4>
                                <a href="mailto:info@kampungngaglik.id" class="text-gray-600 hover:text-green-700 transition-colors">info@kampungngaglik.id</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-8 border-gray-200">

                <div>
                    <h3 class="text-xl font-bold heading-font text-gray-800 mb-4">Terhubung dengan Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" aria-label="Facebook" class="w-10 h-10 bg-gray-200 text-gray-600 hover:bg-green-600 hover:text-white rounded-full flex items-center justify-center transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
// 6. Memanggil footer
include 'footer.php'; 
?>