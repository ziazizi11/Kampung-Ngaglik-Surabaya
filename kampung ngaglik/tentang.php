<?php 
// Panggil header yang konsisten
include 'header.php'; 
// Koneksi jika diperlukan di masa depan
include 'koneksi/koneksi.php';
?>

<title>Tentang Kami - Kampung Ngaglik</title>

<style>
    .misi-list li {
        padding-left: 28px;
        position: relative;
    }
    .misi-list li::before {
        content: '\f00c'; /* Font Awesome check icon */
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 5px;
        color: #66BB6A; /* Warna hijau dari header */
    }
</style>

<div class="bg-gray-50 border-b border-gray-200">
    <div class="container mx-auto text-center py-12 px-6">
        <h1 class="text-4xl md:text-5xl font-bold heading-font text-gray-800">Mengenal Kampung Ngaglik</h1>
        <p class="text-lg text-gray-600 mt-2">Sebuah cerita tentang identitas, semangat, dan cita-cita kami.</p>
    </div>
</div>

<div class="bg-white py-16 sm:py-20">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="flex flex-col md:flex-row-reverse items-center gap-12">
            <div class="md:w-1/2">
                <img src="image/tentang.jpeg" alt="Suasana Kampung Ngaglik" class="rounded-xl shadow-2xl w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold heading-font text-gray-800">Sejarah Singkat</h2>
                <div class="w-24 h-1.5 bg-green-500 my-6"></div>
                <div class="article-content text-lg text-gray-700 space-y-4">
                    <p>
                        Kampung Ngaglik merupakan salah satu kawasan padat penduduk di Surabaya yang dikenal dengan kekompakan warganya, 
                        lingkungan yang bersih, dan kegiatan kemasyarakatan yang aktif.
                    </p>
                    <p>
                        Masyarakat Kampung Ngaglik memiliki semangat gotong royong yang tinggi, 
                        yang tercermin dalam berbagai kegiatan sosial, keagamaan, dan lingkungan.
                        Kampung ini juga dikenal sebagai salah satu kampung yang peduli terhadap pengembangan UMKM, pemuda kreatif, 
                        dan kelestarian lingkungan dengan berbagai inovasi berbasis masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-16 sm:py-20">
    <div class="container mx-auto px-6 max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-start">
            <div class="visi-card">
                <h2 class="text-3xl font-bold heading-font text-gray-800 mb-4">Visi Kami</h2>
                <p class="text-lg text-gray-700 italic leading-relaxed border-l-4 border-green-500 pl-6">
                    "Menjadikan Kampung Ngaglik sebagai kampung mandiri, bersih, berbudaya, dan sejahtera melalui partisipasi aktif masyarakat."
                </p>
            </div>
            <div class="misi-card">
                <h2 class="text-3xl font-bold heading-font text-gray-800 mb-4">Misi Kami</h2>
                <ul class="list-none space-y-3 text-lg text-gray-700 leading-relaxed misi-list">
                    <li>Meningkatkan kualitas hidup masyarakat melalui pengembangan program kesehatan, pendidikan, dan ekonomi kerakyatan.</li>
                    <li>Mendorong pelestarian budaya lokal melalui kegiatan seni, adat, dan kebudayaan yang melibatkan semua lapisan masyarakat.</li>
                    <li>Mengembangkan potensi pemuda dan UMKM lokal melalui pelatihan keterampilan dan akses pemasaran.</li>
                    <li>Mewujudkan tata kelola kampung yang transparan dan partisipatif.</li>
                    <li>Mempertegas kegiatan gotong royong untuk menciptakan lingkungan yang bersih, aman, dan nyaman.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-16 sm:py-20">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto bg-green-700 text-white rounded-2xl p-10 sm:p-14 text-center shadow-2xl">
            <h2 class="text-3xl font-bold heading-font">Nilai yang Kami Junjung Tinggi</h2>
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div class="value-item">
                    <div class="text-5xl mb-3">🤝</div>
                    <h3 class="text-xl font-semibold">Gotong Royong</h3>
                </div>
                <div class="value-item">
                    <div class="text-5xl mb-3">💡</div>
                    <h3 class="text-xl font-semibold">Kreativitas</h3>
                </div>
                <div class="value-item">
                    <div class="text-5xl mb-3">🌿</div>
                    <h3 class="text-xl font-semibold">Kebersihan</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
// Panggil footer
include 'footer.php'; 
?>