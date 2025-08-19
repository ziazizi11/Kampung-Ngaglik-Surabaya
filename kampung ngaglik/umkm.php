<?php 
// 1. Memanggil header yang konsisten
include 'header.php'; 
// 2. Koneksi ke database
include 'koneksi/koneksi.php';

// 3. Mengambil semua data dari tabel UMKM
$result = $conn->query("SELECT * FROM umkm ORDER BY id DESC");
?>

<title>UMKM Unggulan - Kampung Ngaglik</title>

<div class="bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto text-center py-12 px-6">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-800">Produk Unggulan UMKM</h1>
        <p class="text-lg text-gray-600 mt-2">Dukung dan nikmati produk-produk kreatif dari warga Kampung Ngaglik.</p>
    </div>
</div>

<div class="bg-white py-16">
    <div class="container mx-auto px-6">
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            
            <?php
            // Memeriksa apakah ada data UMKM
            if ($result->num_rows > 0):
                // Loop untuk menampilkan setiap produk
                while ($row = $result->fetch_assoc()):
            ?>
            <div class="umkm-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                
                <div class="relative">
                    <img class="w-full h-56 object-cover" src="image/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['nama_produk']) ?>">
                </div>
                
                <div class="p-5 flex flex-col justify-between flex-1">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800" style="font-family: 'Poppins', sans-serif;">
                            <?= htmlspecialchars($row['nama_produk']) ?>
                        </h3>
                        
                        <div class="mt-3 space-y-2 text-sm text-gray-600">
                            <p class="flex items-start">
                                <i class="fas fa-user mt-1 mr-2 text-gray-400"></i>
                                <span><span class="font-semibold">Pemilik:</span> <?= htmlspecialchars($row['pemilik']) ?></span>
                            </p>
                            <p class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-2 text-gray-400"></i>
                                <span><span class="font-semibold">Alamat:</span> <?= htmlspecialchars($row['alamat']) ?></span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-5">
                        <?php 
                        // Pastikan ada nomor telepon dan format dengan benar (misal: ganti 0 di depan dengan 62)
                        if (!empty($row['telepon'])) {
                            $no_wa = preg_replace('/^0/', '62', htmlspecialchars($row['telepon']));
                        ?>
                        <a href="https://wa.me/<?= $no_wa ?>" target="_blank" class="w-full inline-block text-center bg-green-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-600 transition-colors duration-300">
                            <i class="fab fa-whatsapp mr-2"></i> Hubungi Penjual
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
                <p class="text-center text-gray-500 col-span-full">Belum ada produk UMKM yang ditambahkan.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php 
// 7. Memanggil footer
include 'footer.php'; 
?>