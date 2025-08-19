<?php 
include 'header.php'; 
include 'koneksi/koneksi.php';
?>

<title>Kegiatan - Kampung Ngaglik</title>

<div class="bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto text-center py-12 px-6">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-800">Kegiatan Warga</h1>
        <p class="text-lg text-gray-600 mt-2">Setiap momen kebersamaan adalah cerita berharga di kampung kami.</p>
    </div>
</div>

<div class="bg-white py-16">
    <div class="container mx-auto px-6 space-y-10">
        
        <?php
        $kegiatan_query = mysqli_query($conn, "SELECT * FROM berita ORDER BY id DESC");
        
        if (mysqli_num_rows($kegiatan_query) > 0) {
            while ($row = mysqli_fetch_assoc($kegiatan_query)) {
        ?>
        <div class="kegiatan-card bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-xl hover:scale-[1.02]">
            
            <img class="w-full md:w-1/3 h-64 object-cover" 
                 src="image/<?= htmlspecialchars($row['gambar']) ?>" 
                 alt="<?= htmlspecialchars($row['judul']) ?>">
            
            <div class="p-6 md:p-8 flex flex-col justify-between flex-1">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 heading-font"><?= htmlspecialchars($row['judul']) ?></h3>
                    
                    <p class="text-sm text-gray-500 mt-2 mb-4">
                        <i class="far fa-clock mr-1.5"></i>
                        <?= date('d F Y, H:i', strtotime($row['created_at'])) ?>
                    </p>
                    
                    <div class="article-content clamp-3">
                        <?= nl2br(htmlspecialchars($row['deskripsi_singkat'])) ?>
                    </div>
                </div>

                <div class="mt-6 text-left">
                    <a href="detail_kegiatan.php?id=<?= $row['id'] ?>" class="inline-block bg-red-500 text-white font-semibold py-2 px-5 rounded-lg hover:bg-red-600 transition-colors duration-300">
                        Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        <?php 
            }
        } else {
            echo '<p class="text-center text-gray-500 py-16">Tidak ada kegiatan yang tersedia saat ini.</p>';
        }
        ?>
    </div>
</div>

<?php 
include 'footer.php'; 
?>
</body>
</html>