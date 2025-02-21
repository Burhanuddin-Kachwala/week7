<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<?php require base_path('partials/banner.php') ?>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl mb-4"><?=$heading?></h1>
        <form  method="POST" action="/note">
            <div class="mb-4">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" value="<?= $results['id'] ?>">
                <label for="notesbody" class="block text-sm font-medium text-gray-300">Notes Body</label>
                <textarea id="notesbody" name="notesbody" rows="4" class="mt-1 block w-full p-2.5 bg-gray-800 border border-gray-700 rounded-md text-gray-300 focus:ring-blue-500 focus:border-blue-500" ><?= $_POST['notesbody'] ?? '' ?><?= $results['body'] ?></textarea>
                <?php if(isset($errors['body'])): ?>
                    <p class="text-red-500 text-sm mt-1"><?= $errors['body']; ?></p>
                <?php endif; ?>
            </div>
            <a href="/notes" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md">Edit</button>
        </form>

    </div>
</body>
</html>