<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Password</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#bdd3be] h-screen flex items-center justify-center">

  <div class="bg-[#f8f0df] shadow-md rounded-lg p-8 w-full max-w-md text-center">

    <!-- Judul -->
    <h1 class="text-2xl font-extrabold text-[#f4a521] mb-4">Kampung Ngaglik</h1>
    <h2 class="text-xl font-bold text-black mb-6">Reset Password</h2>

    <!-- Notifikasi -->
    <?php
    session_start();
    if (isset($_SESSION['success'])) {
        echo '<div class="bg-green-100 text-green-800 p-3 rounded mb-4">' . htmlspecialchars($_SESSION['success']) . '</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="bg-red-100 text-red-800 p-3 rounded mb-4">' . htmlspecialchars($_SESSION['error']) . '</div>';
        unset($_SESSION['error']);
    }
    ?>

    <!-- Form Reset Password -->
    <form action="proses/proses_reset_password.php" method="POST" class="space-y-5">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>">
      <input type="password" name="password" placeholder="Password Baru" required
        class="w-full px-4 py-3 border shadow-md bg-[#f8f0df] text-black rounded-md focus:outline-none">
      <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required
        class="w-full px-4 py-3 border shadow-md bg-[#f8f0df] text-black rounded-md focus:outline-none">
      <button type="submit"
        class="w-full bg-[#5c8672] hover:bg-[#4d725f] text-black font-semibold py-2 rounded shadow-md transition">
        Reset Password
      </button>
    </form>

  </div>

</body>
</html>