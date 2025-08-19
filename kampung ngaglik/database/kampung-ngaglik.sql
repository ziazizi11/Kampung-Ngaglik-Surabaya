-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2025 at 12:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampung-ngaglik`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','superadmin') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(4, 'azizi', 'alfarizkiklh37@gmail.com', '$2y$10$cmVQyWa9t5S.LoNMo4UaUeylGYD6Oc9TRSEFdH3LhlV7J7fozX9KO', 'superadmin', '2025-05-26 11:29:21'),
(12, 'admin1', '3130023043@student.unusa.ac.id', '$2y$10$Mp3NV53EPVOckMsnKOS5pu/Va5nl8qcxsg6.mZm4QEJmbUj9PE8y.', 'admin', '2025-05-31 16:25:04'),
(18, 'dimas', 'mr.504nk@gmail.com', '$2y$10$0z8piTxhCfy/ciG9dHIZguZWqCqc2EZrIZr6.F6mM35uL.7LO39Si', 'admin', '2025-06-10 16:27:33');

-- --------------------------------------------------------

--
-- Table structure for table `beranda`
--

CREATE TABLE `beranda` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `beranda`
--

INSERT INTO `beranda` (`id`, `judul`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(11, 'Kampung Ngaglik Memiliki Sebutan Kampung Lumpiaa', 'Kampung Ngaglik, yang terletak di kawasan Jalan Ngaglik Gang Kuburan, Kelurahan Kapasari, Surabaya, secara luas dikenal dengan sebutan \\\\\\\"Kampung Lumpia\\\\\\\" karena perannya sebagai sentra produksi lumpia terbesar di kota tersebut. Julukan ini lahir secara alami dari masyarakat setelah tradisi pembuatan lumpia yang dirintis oleh warga seperti pasangan Kasno dan Sukarsipah puluhan tahun lalu berkembang pesat dan diwariskan secara turun-temurun. Kini, puluhan industri rumahan di kampung ini secara kolektif memproduksi ribuan lumpia setiap hari dengan ciri khas tekstur yang renyah atau \\\\\\\"kriuk\\\\\\\", tidak hanya untuk memenuhi permintaan pasar di seluruh Surabaya tetapi juga untuk didistribusikan ke kota-kota lain, sekaligus menjadi penggerak utama perekonomian bagi masyarakat setempat.', 'kampung-lumpia-surabaya-2.jpeg', '2025-05-26 18:25:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deskripsi_singkat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `deskripsi`, `gambar`, `created_at`, `deskripsi_singkat`) VALUES
(7, 'Megengan', 'Megengan adalah sebuah tradisi budaya dan spiritual masyarakat Jawa yang sangat dijaga kelestariannya di Kampung Ngaglik, Surabaya. Berasal dari kata megeng yang berarti \"menahan diri\", tradisi ini merupakan penanda simbolis bahwa umat Islam akan segera memasuki bulan Ramadan, di mana mereka akan menahan hawa nafsu. Kegiatan ini biasanya dilaksanakan pada akhir bulan Sya\'ban.\r\n\r\nFilosofi dan Makna\r\n\r\nBagi warga Kampung Ngaglik, Megengan bukan sekadar ritual, melainkan sebuah momen introspeksi dan rekonsiliasi. Tujuannya adalah untuk menyiapkan diri secara lahir dan batin, memasuki bulan Ramadan dengan hati yang suci, bersih dari kesalahan dan dendam kepada sesama. Hal ini dilambangkan secara kuat melalui kue apem, yang namanya diyakini berasal dari kata Arab \'afwun\' atau \'afuwwun\' yang berarti ampunan.\r\n\r\nRangkaian Tradisi di Kampung Ngaglik\r\n\r\nPersiapan di Rumah:\r\nBeberapa hari menjelang Megengan, para ibu di setiap rumah akan mulai membuat kue apem dan penganan tradisional lainnya. Selain itu, mereka juga menyiapkan hidangan lain untuk dibawa ke acara komunal dalam sebuah wadah yang disebut besek atau rantang.\r\n\r\nProsesi Komunal:\r\nPada hari yang ditentukan, biasanya sore hari atau setelah shalat Maghrib, seluruh warga akan berbondong-bondong menuju pusat kegiatan, seperti masjid, mushola, atau balai RW. Setiap kepala keluarga datang dengan membawa hidangan yang telah disiapkan dari rumah.\r\n\r\nDoa Bersama (Tahlil dan Kenduri):\r\nAcara inti adalah doa bersama yang dipimpin oleh tokoh agama atau sesepuh kampung. Warga duduk bersila di atas tikar, mengelilingi hidangan yang telah tertata rapi. Lantunan tahlil dan doa dikumandangkan, memohon ampunan kepada Tuhan, mendoakan para leluhur, serta memohon kekuatan dan kelancaran dalam menjalankan ibadah puasa mendatang.\r\n\r\nSentuhan Khas \"Kampung Lumpia\":\r\nDi sinilah keunikan Kampung Ngaglik terlihat. Di samping kue apem yang wajib ada, tak jarang dalam bungkusan berkatan (hidangan yang akan dibagikan) yang dibawa warga, terselip beberapa buah lumpia hangat. Ini adalah cara mereka memasukkan identitas modern dan kebanggaan lokal ke dalam sebuah tradisi kuno, sebagai simbol bahwa rezeki yang mereka dapatkan dari usaha lumpia juga patut disyukuri dan dibagikan.\r\n\r\nSaling Berbagi Berkatan (Ater-ater):\r\nSetelah doa selesai, hidangan yang telah \"didoakan\" tersebut kemudian saling ditukarkan antar warga atau langsung dibagikan. Proses ini melambangkan semangat berbagi berkah dan mempererat tali persaudaraan. Setiap keluarga akan pulang dengan membawa makanan dari tetangganya, menciptakan rasa kebersamaan yang nyata.\r\n\r\nMakna Bagi Komunitas\r\nMegengan di Kampung Ngaglik adalah pilar yang memperkuat fondasi sosial dan spiritual mereka. Ini adalah momen di mana:\r\n\r\nTradisi Leluhur Dihidupkan: Mereka secara aktif melestarikan warisan budaya Jawa.\r\nIkatan Sosial Dipererat: Semangat saling memaafkan dan berbagi makanan menghilangkan sekat antar warga.\r\nIdentitas Lokal Ditegaskan: Dengan memasukkan lumpia, mereka menunjukkan bahwa tradisi bisa berjalan beriringan dengan identitas kontemporer kampung mereka.\r\nDengan demikian, Megengan menjadi gerbang spiritual yang khusyuk sekaligus perayaan komunal yang hangat bagi warga Kampung Ngaglik sebelum memasuki madrasah Ramadan.', 'IMG_20220401_111958.jpg', '2025-05-26 13:57:14', 'Megengan di Kampung Ngaglik adalah sebuah tradisi warisan leluhur yang khidmat dan penuh kehangatan untuk menyambut datangnya bulan suci Ramadan. Warga berkumpul di masjid atau balai RW untuk doa bersama, saling memaafkan, dan membersihkan hati. Tradisi ini ditandai dengan hadirnya kue apem sebagai simbol permohonan ampun. Sebagai ciri khasnya, warga Kampung Ngaglik seringkali menyertakan lumpia dalam hidangan yang mereka bawa, memadukan tradisi agung dengan identitas lokal yang menjadi kebanggaan mereka dalam semangat berbagi dan kebersamaan.'),
(8, '17 Agustus 2024', 'Perayaan Hari Ulang Tahun (HUT) Kemerdekaan Republik Indonesia pada 17 Agustus di Kampung Ngaglik adalah sebuah panggung besar di mana semangat nasionalisme dan kekompakan warga berpadu dengan identitas unik mereka sebagai \"Kampung Lumpia\". Sejak awal bulan Agustus, suasana kampung sudah berubah semarak, dihiasi bendera Merah Putih, umbul-umbul, dan gapura yang dicat ulang melalui kerja bakti.\r\n\r\nRangkaian Kegiatan\r\n\r\nPersiapan dan Kerja Bakti Kemerdekaan:\r\nSeminggu sebelum tanggal 17, warga secara gotong royong membersihkan dan menghias lingkungan. Jalanan kampung menjadi kanvas merah putih. Kegiatan ini tidak hanya mempercantik kampung, tetapi juga memupuk semangat kebersamaan dan kepemilikan kolektif.\r\n\r\nUpacara Bendera 17 Agustus:\r\nPada pagi hari tanggal 17 Agustus, warga menggelar upacara pengibaran bendera sederhana namun khidmat di lapangan atau jalan utama kampung. Dipimpin oleh Ketua RW, upacara ini diikuti oleh seluruh warga, dari anak-anak berseragam sekolah hingga para lansia, sebagai wujud penghormatan kepada jasa para pahlawan.\r\n\r\nPesta Rakyat: Aneka Perlombaan Seru dan Khas:\r\nSetelah upacara, kemeriahan sesungguhnya dimulai. Berbagai perlombaan diadakan untuk semua kalangan, yang terbagi menjadi dua kategori:\r\n\r\nLomba Tradisional: Lomba-lomba yang selalu sukses mengundang gelak tawa seperti panjat pinang, balap karung memakai helm, tarik tambang antar-RT, serta lomba makan kerupuk dan balap kelereng untuk anak-anak.\r\nLomba Khas \"Kampung Lumpia\": Inilah yang menjadi pembeda utama. Untuk merayakan identitas mereka, diadakan kompetisi spesial seperti:\r\nLomba Membuat Lumpia Tercepat dan Terenak: Peserta (biasanya ibu-ibu atau perwakilan produsen) ditantang untuk membuat lumpia dari proses melipat kulit hingga siap saji dalam waktu terbatas. Kriteria penilaian meliputi kecepatan, kerapian, dan tentu saja, rasa.\r\nLomba Menghias Tumpeng Lumpia: Tim dari setiap RT berkreasi menghias tumpeng yang tidak terbuat dari nasi, melainkan dari ratusan lumpia yang disusun menjulang dan dihias dengan garnish sayuran.\r\nLomba Makan Lumpia Pedas: Lomba paling menantang bagi para pemuda, di mana peserta harus menghabiskan lumpia yang telah diberi isian super pedas.\r\nMalam Puncak Kemerdekaan (Malam Tasyakuran):\r\nSebagai penutup rangkaian acara, biasanya pada malam hari atau di akhir pekan, diadakan \"Malam Puncak\". Acara ini meliputi:\r\n\r\nPembagian Hadiah: Pemenang dari seluruh perlombaan akan dipanggil ke atas panggung untuk menerima hadiah yang seringkali juga disponsori oleh para pengusaha lumpia setempat.\r\nPentas Seni: Panggung diisi oleh penampilan kreativitas warga, mulai dari anak-anak yang menari tarian tradisional, pemuda yang bermain band, hingga ibu-ibu yang menampilkan paduan suara.\r\nDoa dan Tasyakuran: Momen untuk berdoa bersama, bersyukur atas nikmat kemerdekaan dan memohon keselamatan bagi bangsa, dipimpin oleh tokoh agama setempat.\r\nMakan Bersama: Puncak kemeriahan ditutup dengan makan bersama. Selain hidangan umum seperti tumpeng nasi kuning, stan lumpia gratis selalu tersedia, di mana semua warga bisa menikmati sepuasnya produk kebanggaan kampung mereka.\r\nMakna dan Semangat\r\nBagi warga Kampung Ngaglik, perayaan 17 Agustus lebih dari sekadar pesta. Ini adalah cara mereka menerjemahkan cinta tanah air ke dalam aksi nyata yang mempererat persaudaraan, melestarikan tradisi, sekaligus merayakan dan mempromosikan identitas unik yang menghidupi mereka sehari-hari.', 'fo7wxqma8hibch3.jpeg', '2025-05-26 17:27:01', 'Perayaan Hari Kemerdekaan 17 Agustus di Kampung Ngaglik, Surabaya, berlangsung dengan sangat meriah dan penuh semangat kebersamaan. Selain menggelar upacara bendera dan aneka lomba klasik seperti panjat pinang dan balap karung, kampung ini memiliki ciri khas unik dengan mengadakan perlombaan bertema lumpia, seperti lomba membuat lumpia tercepat dan terenak. Puncak acara berupa malam tasyakuran yang diisi dengan pembagian hadiah, pentas seni warga, dan tentu saja, hidangan lumpia gratis untuk semua, menjadikan perayaan ini cerminan semangat nasionalisme yang berpadu dengan kearifan lokal.'),
(16, 'buka bersama', 'Kegiatan buka puasa bersama (bukber) di Kampung Ngaglik, Surabaya, bukan sekadar acara makan bersama untuk membatalkan puasa. Ini adalah sebuah perayaan komunal yang telah mengakar menjadi tradisi, merefleksikan semangat kebersamaan dan identitas unik kampung sebagai pusat produksi lumpia.\r\n\r\nSuasana dan Persiapan\r\n\r\nSejak sore hari, suasana di kampung sudah terasa berbeda. Biasanya, acara dipusatkan di lokasi yang strategis seperti balai RW, masjid, atau bahkan dengan menutup salah satu gang untuk umum. Semangat gotong royong terlihat jelas; para bapak dan pemuda menyiapkan terpal, tikar, dan meja panjang, sementara para ibu sibuk di dapur masing-masing, menyiapkan hidangan terbaik untuk dibawa dan dinikmati bersama. Aroma masakan rumahan berpadu dengan wangi khas lumpia yang baru digoreng, menciptakan atmosfer yang khas dan menggugah selera.\r\n\r\nRangkaian Acara\r\n\r\nMenjelang Maghrib: Warga mulai berdatangan dan berkumpul, saling sapa dan bertukar cerita. Anak-anak berlarian dengan riang gembira. Seringkali, untuk mengisi waktu menunggu adzan (ngabuburit), acara diisi dengan ceramah singkat (kultum) dari ustadz setempat yang memberikan pencerahan rohani.\r\nSaat Berbuka: Ketika adzan Maghrib berkumandang, suasana menjadi hening sejenak. Warga bersama-sama membatalkan puasa. Di sinilah keunikan Kampung Ngaglik paling menonjol. Meja takjil tidak hanya diisi kurma dan minuman manis, tetapi juga diramaikan oleh parade lumpia aneka rupa. Setiap keluarga membawa lumpia hasil produksinya, memberikan kesempatan bagi warga untuk saling mencicipi dan mengapresiasi karya tetangga. Ini menjadi etalase kebanggaan dan kekayaan kuliner kampung.\r\nShalat Maghrib Berjamaah: Setelah menyantap takjil, warga akan bersama-sama menunaikan ibadah shalat Maghrib berjamaah. Momen ini memperkuat sisi spiritual dari kegiatan buka bersama.\r\nMakan Malam Bersama: Usai shalat, acara puncak yaitu makan malam bersama dimulai. Hidangan yang disajikan adalah hasil kontribusi setiap keluarga (potluck), menciptakan keberagaman menu yang melimpah. Warga duduk berdampingan di atas tikar, menikmati makanan sambil bercengkerama dengan akrab.\r\nRamah Tamah: Acara ditutup dengan obrolan santai. Ini adalah waktu terbaik untuk mempererat ikatan sosial, menyelesaikan masalah lingkungan secara informal, atau sekadar berbagi tawa, memperkuat rasa kekeluargaan di antara warga.\r\nTujuan dan Makna\r\n\r\nBagi warga Kampung Ngaglik, buka bersama memiliki makna yang dalam:\r\n\r\nMempererat Silaturahmi: Menjadi ajang untuk menyambung dan memperkuat hubungan antar tetangga.\r\nMenumbuhkan Semangat Berbagi: Mendorong budaya memberi dan berbagi rezeki dengan sesama.\r\nMelestarikan Tradisi: Menjaga tradisi Ramadan yang penuh kebaikan dan kebersamaan.\r\nMemperkuat Identitas Kampung: Menegaskan kembali identitas mereka sebagai \"Kampung Lumpia\" yang tidak hanya produktif secara ekonomi tetapi juga solid secara sosial.\r\nDengan demikian, buka bersama di Kampung Ngaglik adalah cerminan dari harmoni sosial dan kebanggaan komunal yang hidup di tengah-tengah denyut nadi kota Surabaya.', 'desa-kledokan-kecamatan-bendo-magetan-gelar-megengan-agung_20180516_180657.jpg', '2025-05-28 08:45:27', 'Buka bersama di Kampung Ngaglik adalah tradisi tahunan yang hangat dan meriah saat bulan suci Ramadan tiba. Acara ini menjadi momen bagi seluruh warga, dari anak-anak hingga orang tua, untuk berkumpul, berbagi, dan mempererat tali silaturahmi. Yang membuat buka bersama di sini unik adalah hidangan takjilnya yang istimewa, yaitu aneka lumpia khas buatan warga kampung sendiri. Dalam semangat kebersamaan dan gotong royong, kegiatan ini merefleksikan identitas Kampung Ngaglik sebagai komunitas yang solid, guyub,'),
(17, 'Khitan Masalll', 'Kegiatan sunat massal di Kampung Ngaglik merupakan sebuah inisiatif sosial yang biasanya diorganisir oleh tokoh masyarakat, pengurus kampung, atau bekerja sama dengan organisasi kemasyarakatan, lembaga kesehatan, atau donatur. Pelaksanaan kegiatan ini seringkali bertempat di fasilitas umum seperti balai RW, masjid, atau bahkan di salah satu rumah warga yang cukup luas.\r\n\r\nPersiapan: Sebelum hari pelaksanaan, panitia akan melakukan beberapa tahapan persiapan, termasuk:\r\n\r\nPendaftaran Peserta: Mengumumkan dan membuka pendaftaran bagi anak-anak laki-laki yang ingin mengikuti sunat massal. Biasanya, kriteria peserta adalah warga Kampung Ngaglik dan sekitarnya, dengan prioritas bagi keluarga kurang mampu.\r\nKoordinasi dengan Tenaga Medis: Bekerja sama dengan dokter, perawat, atau tenaga medis profesional yang berpengalaman dalam melakukan tindakan sunat. Hal ini penting untuk memastikan keamanan dan kesehatan peserta.\r\nPenyediaan Peralatan dan Perlengkapan: Memastikan ketersediaan alat sunat yang steril, obat-obatan, perlengkapan pendukung, serta bingkisan atau hadiah untuk anak-anak yang telah disunat.\r\nSosialisasi: Memberikan informasi kepada masyarakat mengenai jadwal, tempat, dan detail pelaksanaan kegiatan.\r\nPelaksanaan: Pada hari pelaksanaan, kegiatan sunat massal biasanya berlangsung dengan tertib dan ceria. Alurnya dapat meliputi:\r\n\r\nRegistrasi dan Pemeriksaan Awal: Peserta yang datang akan melakukan registrasi ulang dan menjalani pemeriksaan kesehatan singkat oleh tenaga medis untuk memastikan kondisi mereka memungkinkan untuk dilakukan sunat.\r\nPelaksanaan Sunat: Tindakan sunat dilakukan oleh tim medis di ruangan yang telah disterilkan. Proses ini biasanya dibuat senyaman mungkin bagi anak-anak, terkadang dengan pendampingan orang tua atau relawan.\r\nPemberian Obat dan Edukasi: Setelah sunat, peserta akan diberikan obat-obatan seperti pereda nyeri dan antibiotik (jika diperlukan), serta edukasi mengenai perawatan luka pasca sunat kepada orang tua atau pendamping.\r\nPemberian Bingkisan: Sebagai bentuk perhatian dan apresiasi, anak-anak yang telah disunat biasanya akan menerima bingkisan berupa makanan ringan, alat tulis, sarung, atau uang saku.\r\nRamah Tamah (Opsional): Terkadang, kegiatan ini juga diisi dengan acara ramah tamah atau hiburan sederhana untuk memeriahkan suasana.\r\nDampak dan Tujuan: Kegiatan sunat massal di Kampung Ngaglik memiliki beberapa dampak dan tujuan positif, antara lain:\r\n\r\n- Membantu Masyarakat: Memberikan akses layanan sunat gratis bagi keluarga yang mungkin kesulitan secara ekonomi untuk membiayainya.\r\n- Mewujudkan Tradisi Agama: Memfasilitasi pelaksanaan kewajiban agama atau tradisi sunat bagi anak laki-laki Muslim.\r\n- Meningkatkan Kesehatan: Sunat memiliki manfaat kesehatan, seperti mengurangi risiko infeksi saluran kemih dan penyakit menular seksual.\r\n- Mempererat Kebersamaan: Menjalin silaturahmi antar warga dan menumbuhkan rasa solidaritas dan gotong royong dalam komunitas.\r\n- Citra Positif Kampung: Memperkuat citra Kampung Ngaglik sebagai kampung yang peduli sosial dan memiliki nilai-nilai kemasyarakatan yang kuat, di samping identitasnya sebagai \"Kampung Lumpia\".\r\nKegiatan sunat massal menjadi salah satu wujud nyata kepedulian sosial dan semangat kebersamaan yang hidup di Kampung Ngaglik, Surabaya.', '05 Khitan Massal(1).jpeg', '2025-05-28 08:46:41', 'Kampung Ngaglik, yang terkenal sebagai sentra produksi lumpia di Surabaya, secara rutin atau dalam momen-momen tertentu menyelenggarakan kegiatan sunat massal. Kegiatan sosial ini bertujuan untuk membantu masyarakat sekitar, terutama keluarga kurang mampu, untuk melaksanakan kewajiban atau tradisi sunat bagi anak laki-laki mereka secara gratis. Selain memberikan manfaat kesehatan, kegiatan ini juga mempererat tali silaturahmi antar warga dan memperkuat citra Kampung Ngaglik sebagai komunitas yang peduli dan gotong royong.');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id` int NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  `waktu_kegiatan` date DEFAULT NULL,
  `tempat_kegiatan` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id`, `gambar`, `nama_kegiatan`, `waktu_kegiatan`, `tempat_kegiatan`, `status`) VALUES
(8, '1000017242.jpg', 'Sehat Bersama Warga Bonek', '2024-11-27', 'Kampung Ngaglik', 'Selesai'),
(9, 'kegiatan_1749671464.png', 'Masak Bersama', '2025-11-12', 'Depan Kelurahan', 'Non-Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `email`, `token`, `created_at`, `expires_at`) VALUES
(1, 'alfarizkiklh37@gmail.com', '60f79f3c747a3ac010b12ba72534118387d3013de8d895fa174be43dc733e858', '2025-06-10 23:26:35', '2025-06-10 17:26:35'),
(2, 'mr.504nk@gmail.com', 'baa689597dfb9e14f0957d389ddd67fcc69c1b0cd575b647e38edbffd06cd886', '2025-06-10 23:28:04', '2025-06-10 17:28:04');

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`nama`, `value`) VALUES
('benner', 'benner.png'),
('foto benner', 'banner_1749535417.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `umkm`
--

CREATE TABLE `umkm` (
  `id` int NOT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `pemilik` varchar(100) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `umkm`
--

INSERT INTO `umkm` (`id`, `nama_produk`, `alamat`, `pemilik`, `gambar`, `created_at`) VALUES
(7, 'Lumpia', 'Kampung Lumpia', 'Prof. H. Loris S.Pd., M.Kom', '68345de0c1a6f_IMG-20250209-WA0034.jpg', '2025-06-11 21:26:31'),
(8, 'Bakso Pak No', 'Gg. Masjid - Kampung Ngaglik', 'Pak No', '68373b7dc07c8_images (1).jpg', '2025-06-11 21:26:31'),
(9, 'martabak madura', 'gg makam', 'bu elok', '683b44d082d73_360b8332-e1fd-4736-8daa-3ca029c7a490_Go-Biz_20201218_202533.jpeg', '2025-06-11 21:26:31'),
(12, 'sempol ayam', 'kampung ngaglik 3 rt 2, rw 12', 'bu ida', 'umkm_1749683806.jpg', '2025-06-11 23:16:46'),
(13, 'Toko Sembako', 'gg makam', 'bu elok', 'umkm_1749683895.jpeg', '2025-06-11 23:18:15'),
(15, 'Bengkel Motor Jayadi', 'gg makam no 22', 'pak jayadi', 'umkm_1749684139.jpg', '2025-06-11 23:22:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `beranda`
--
ALTER TABLE `beranda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `umkm`
--
ALTER TABLE `umkm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `beranda`
--
ALTER TABLE `beranda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `umkm`
--
ALTER TABLE `umkm`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD CONSTRAINT `password_reset_tokens_ibfk_1` FOREIGN KEY (`email`) REFERENCES `admin` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
