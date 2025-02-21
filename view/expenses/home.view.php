<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracking App</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-200 flex flex-col items-center ">

    <!-- Navbar Section Start -->
    <nav class="w-full bg-gray-800 text-white shadow-lg p-3">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-semibold">Expense Tracker</h1>
            <a href="/dashboard" target="_blank" class="bg-white text-gray-700 font-bold py-2 px-4 rounded-lg shadow hover:bg-gray-100 transition duration-300">Dashboard</a>
        </div>
    </nav>
    <!-- Navbar Section End -->

    <!-- Main Content Section Start -->
    <div class="w-full max-w-xl mt-8">
        <!-- Form Section Start -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Add Expense</h2>
            <form class="space-y-4" method="post" action="/add-expense">
                <div>
                    <label for="amount" class="block text-gray-700 font-semibold">Amount (RS)</label>
                    <input type="number" id="amount" name="amount" placeholder="Enter amount " class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" min="0">
                </div>
                <div>
                    <label for="category" class="block text-gray-700 font-semibold">Category</label>
                    <select id="category" name="category" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" <?= empty($category) ? 'disabled' : '' ?>>
                        <!-- <option value=""><?= empty($category) ? 'Add Category' : 'Select Category' ?></option> -->
                        <?php if (!empty($category)): ?>
                            <?php foreach ($category as $cat): ?>
                                <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div>
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label for="date" class="block text-gray-700 font-semibold">Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400">
                    <p id="dateError" class="text-red-500 text-sm mt-1 hidden">Date cannot be in the future.</p>
                </div>
                <button id="btnSubmit" type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Add Expense
                </button>
            </form>
        </div>
        <!-- Form Section End -->
    </div>
    <!-- Main Content Section End -->

    <!-- Buttons Section Start -->
    <div class="flex justify-between">
    <button id="toggleCategoryInput" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal">New Category</button>
    </div>
    <!-- Buttons Section End -->

    <!-- Main Modal Section Start -->
    <div id="add-category-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Add New Category
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="add-category-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Form For category Addition -->
                <form id="categoryForm" class="p-4 md:p-5" method="post" action="/add-category">
                    <div class="mb-4">
                        <label for="categoryName" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category Name</label>
                        <input type="text" name="categoryName" id="categoryName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Enter category name" required>
                    </div>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                        </svg>
                        Add Category
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Modal Section End -->

    <script src="scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
