<?php 
// 1. Panggil header yang konsisten
include 'header.php'; 
// 2. Koneksi ke database
include 'koneksi/koneksi.php';
?>

<title>Agenda - Kampung Ngaglik</title>

<div class="bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto text-center py-12 px-6">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-800">Agenda Kampung</h1>
        <p class="text-lg text-gray-600 mt-2">Catat tanggalnya dan jangan lewatkan setiap acara menarik di kampung kami.</p>
    </div>
</div>

<div class="bg-white py-16">
    <div class="container mx-auto px-6 space-y-10">
        
        <?php
        // Proses PHP Anda untuk mengambil data tidak diubah sama sekali
        $kegiatan = $conn->query("SELECT * FROM kegiatan ORDER BY waktu_kegiatan DESC");
        
        if ($kegiatan && $kegiatan->num_rows > 0) {
            while ($row = $kegiatan->fetch_assoc()):
        ?>
        <div class="kegiatan-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
            
            <img class="w-full md:w-1/3 h-64 object-cover" 
                 src="admin/proses/image/<?= htmlspecialchars($row['gambar']) ?>" 
                 alt="<?= htmlspecialchars($row['nama_kegiatan']) ?>">
            
            <div class="p-6 md:p-8 flex flex-col justify-center flex-1">
                
                <h3 class="text-2xl font-bold text-gray-800 heading-font"><?= htmlspecialchars($row['nama_kegiatan']) ?></h3>
                
                <div class="flex flex-wrap text-sm text-gray-500 mt-3 mb-4 gap-x-6 gap-y-2">
                    <span class="flex items-center">
                        <i class="far fa-calendar-alt mr-2 text-gray-400"></i>
                        <?= date('d F Y', strtotime($row['waktu_kegiatan'])) ?>
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-2 text-gray-400"></i>
                        <?= htmlspecialchars($row['tempat_kegiatan']) ?>
                    </span>
                    <span class="flex items-center">
                        <i class="fas fa-info-circle mr-2 text-gray-400"></i>
                        Status: <strong class="ml-1 text-green-600"><?= htmlspecialchars($row['status']) ?></strong>
                    </span>
                </div>
                
                <div class="article-content border-t border-gray-100 pt-4 mt-2">
                    <?php 
                    if (!empty($row['deskripsi'])): 
                        $deskripsi = htmlspecialchars($row['deskripsi']);
                        // Fitur pemotongan deskripsi Anda tetap dipertahankan
                        if (strlen($deskripsi) > 200) { // Batas karakter bisa disesuaikan
                            echo substr($deskripsi, 0, 200) . "...";
                        } else {
                            echo $deskripsi;
                        }
                    endif; 
                    ?>
                </div>
            </div>
        </div>
        <?php 
            endwhile;
        } else {
            echo '<div class="text-center py-16"><p class="text-gray-500 text-lg">Tidak ada agenda yang tersedia saat ini.</p></div>';
        }
        ?>

    </div>
</div>

<?php 
// 6. Memanggil footer
include 'footer.php'; 
?>