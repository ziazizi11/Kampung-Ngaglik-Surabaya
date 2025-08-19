<?php
session_start();
// Pastikan hanya superadmin yang bisa mengakses halaman ini
if (!isset($_SESSION['admin_role']) || $_SESSION['admin_role'] != 'superadmin') {
    header("Location: login.php"); // Redirect ke login jika tidak ada sesi superadmin
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Admin Baru</title><link rel="icon" href="../image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-xl rounded-lg p-8 sm:p-10 w-full max-w-md text-center">

        <h1 class="text-3xl font-extrabold text-slate-800 mb-4">
            <span class="text-[#A5D6A7]">Kampung</span> Ngaglik
        </h1>

        <h2 class="text-2xl font-bold text-gray-800 mb-8">Registrasi Admin Baru</h2>

        <?php
        // Menampilkan pesan sukses atau error dari sesi
        if (isset($_SESSION['success_message']) && !empty($_SESSION['success_message'])) {
        ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline"><?= htmlspecialchars($_SESSION['success_message']) ?></span>
            </div>
        <?php
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message']) && !empty($_SESSION['error_message'])) {
        ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline"><?= htmlspecialchars($_SESSION['error_message']) ?></span>
            </div>
        <?php
            unset($_SESSION['error_message']);
        }
        ?>

        <form action="proses/proses_register.php" method="POST" class="space-y-6">

            <input type="text" name="nama" placeholder="Nama Lengkap" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out placeholder-gray-500 text-base">

            <input type="email" name="email" placeholder="Email" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out placeholder-gray-500 text-base">

            <input type="password" name="password" placeholder="Password" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out placeholder-gray-500 text-base">

            <select name="role" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out text-base appearance-none bg-no-repeat bg-right-center pr-10"
                style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\'%3e%3cpolyline points=\'6 9 12 15 18 9\'%3e%3c/polyline%3e%3c/svg%3e'); background-size: 1.2em; background-position: right 0.75rem center;">
                <option value="" disabled selected>Pilih Role</option> <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>
            </select>

            <button type="submit"
                class="w-full bg-[#A5D6A7] hover:bg-green-700 text-black font-semibold py-3 rounded-md shadow-lg
                       focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out text-base">
                Daftar Admin
            </button>
        </form>

        <p class="mt-6 text-sm text-center text-gray-600">
            <a href="dashboard.php" class="text-blue-600 hover:text-blue-800 hover:underline font-medium">
                Kembali Ke Dashboard
            </a>
        </p>

    </div>

</body>
</html>