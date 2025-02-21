<header class="bg-gray-800 p-4 overflow-hidden fixed top-0 w-full z-10 flex justify-between items-center">
    <h2 class="text-white text-2xl font-bold">Welcome <?= $_SESSION['user'] ?? 'Guest '?></h2>


    <?php if ( ($_SESSION['user']) ?? false): ?>
        <form method="post" action="/sessions">
            <input type="hidden" name="_method" value="delete">
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">LogOut</button>
        </form>
    <?php else: ?>
        <a href="/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Login</a>
    <?php endif; ?>
</header>
<main class="mt-16">
    <!-- Your main content goes here -->
</main>