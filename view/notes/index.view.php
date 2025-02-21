<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <style>
        /* Custom scrollbar styles */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background:rgb(47, 58, 80); /* Dark background */
        }

        ::-webkit-scrollbar-thumb {
            background-color: #1e3a8a; /* Dark blue color */
            border-radius: 20px;
            transition: background-color 0.3s;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #3b82f6; /* Lighter blue on hover */
        }
    </style>
</head>


<body class="bg-gray-900 text-gray-100 p-6">
<?php require base_path('partials/banner.php') ?>
    
<h2 class="text-2xl font-bold mb-4 text-center"><?=$heading?></h2>
<?php $i=1; ?>
<div class="max-w-md mx-auto bg-gray-800 p-6 rounded-lg shadow-lg ">
    <ol class=" overflow-y-auto max-h-96" >
        <?php foreach ($results as $row): ?>
            <li class="bg-gray-700 p-4 rounded shadow-md text-lg m-2">
                <span class="text-blue-500 font-bold"><?=$i++?>.</span>
                <a href="note?id=<?= $row['id'];?>" class="text-white hover:underline">
                    <?= htmlspecialchars($row['body']); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ol>
</div>

<div class="flex justify-center mt-6">
    <a href="/note/create" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        New Note
    </a>
</div>
    
</body>
</html>