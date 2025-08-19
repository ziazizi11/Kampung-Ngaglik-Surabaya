<?php
session_start(); // Pastikan session_start() ada di paling atas, sebelum output HTML apapun
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin</title><link rel="icon" href="../image/logo.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white shadow-xl rounded-lg p-8 sm:p-10 w-full max-w-md text-center">

        <div class="mb-6">
            <img src="../image/logo.png" alt="Logo Kampung Ngaglik" class="h-50 w-auto mx-auto object-contain">
            </div>

        <h1 class="text-3xl font-extrabold text-slate-800 mb-4">
            <span class="text-[#A5D6A7]">Kampung</span> Ngaglik
        </h1>

        <h2 class="text-2xl font-bold text-gray-800 mb-8">Login Admin Panel</h2>

        <?php
        if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error']) && !empty($_SESSION['error'])) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="proses/proses_login.php" method="POST" class="space-y-6">
            <input type="email" name="email" placeholder="Email" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out placeholder-gray-500 text-base">

            <input type="password" name="password" placeholder="Password" required
                class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                       transition duration-150 ease-in-out placeholder-gray-500 text-base">

            <button type="submit"
                class="w-full bg-[#A5D6A7] hover:bg-green-700 text-black font-semibold py-3 rounded-md shadow-lg
                       focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-150 ease-in-out text-base">
                Masuk
            </button>
        </form>

        <div class="mt-6 text-sm text-center">
            <a href="#" class="text-blue-600 hover:text-blue-800 hover:underline font-medium"
               onclick="document.getElementById('forgotPasswordModal').classList.remove('hidden')">Lupa Password?</a>

            </div>

    </div>

    <div id="forgotPasswordModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-lg p-8 w-full max-w-md shadow-lg text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Reset Password</h2>
            <form action="proses/proses_forgot_password.php" method="POST" class="space-y-6">
                <input type="email" name="email" placeholder="Masukkan Email Anda" required
                    class="w-full px-5 py-3 border border-gray-300 rounded-md bg-gray-50 text-gray-800
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent
                           transition duration-150 ease-in-out placeholder-gray-500 text-base">
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-5 rounded-md transition"
                        onclick="document.getElementById('forgotPasswordModal').classList.add('hidden')">Batal</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-md transition">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>