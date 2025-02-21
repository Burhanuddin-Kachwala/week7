<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single Note</title>
    
</head>
<?php require base_path('partials/banner.php') ?>

<body class="bg-gray-900 text-gray-100 p-6">
    
<h2 class="text-2xl font-bold mb-4 text-center"><?=$heading?></h2>

<div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-lg">
    <ul class="list-none">       
        <li class="bg-gray-700 p-4 rounded shadow-md ">
            <?= htmlspecialchars($results["body"]); ?>            
        </li>
        <form action="" method="POST" class="mt-4">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="note_id" value="<?= htmlspecialchars($results["id"]); ?>">
            <button type="submit" class="bg-red-500 text-white p-2 rounded">Delete</button>
            <a href="/note/edit?id=<?= $results['id'] ?>" class="bg-yellow-500 text-white p-2 rounded">Edit</a>
        </form>
    </ul>
</div>
    
</body>
</html>
