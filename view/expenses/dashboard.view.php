<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard || Expense Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #4B5563;
            /* Gray-600 */
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #9CA3AF;
            /* Gray-400 */
        }

        ::-webkit-scrollbar-track {
            background-color: #1F2937;
            /* Gray-800 */
            border-radius: 4px;
        }
    </style>

</head>

<body class="font-sans bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-60 bg-gray-800 text-white p-6">
            <h2 class="text-2xl font-bold mb-6">Expense Tracker</h2>
            <nav>
                <ul>
                    <li>
                        <a class="block py-2 px-4 bg-green-600 hover:bg-green-700 text-white rounded-full flex items-center justify-center" target="_blank" data-modal-toggle="add-expense-modal" data-modal-target='add-expense-modal'>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg> Expense
                        </a>
                    </li>
                    <li class="mt-4">
                        <a class="block py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center" target="_blank" data-modal-toggle="add-category-modal" data-modal-target='add-category-modal'>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg> Category
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-auto">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <!-- Maximum Expense -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-white">Maximum Expense</h3>
                    <?php
                    $maxExpense = null;
                    foreach ($months as $data) {
                        foreach ($data['expenses'] as $expense) {
                            if ($maxExpense === null || $expense['amount'] > $maxExpense['amount']) {
                                $maxExpense = $expense;
                            }
                        }
                    }
                    ?>
                    <?php if ($maxExpense): ?>
                        <p class="text-lg font-bold text-yellow-500">
                            <?= htmlspecialchars($maxExpense['description']); ?> - <?= $maxExpense['amount']; ?> RS
                        </p>
                    <?php else: ?>
                        <p class="text-lg font-bold text-yellow-500">No expenses found.</p>
                    <?php endif; ?>
                </div>

                <!-- Highest Spending Month -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-white">Highest Spending Month</h3>
                    <?php
                    $highestSpendingMonth = null;
                    $highestSpendingAmount = 0;
                    foreach ($months as $month => $data) {
                        if ($data['total'] > $highestSpendingAmount) {
                            $highestSpendingAmount = $data['total'];
                            $highestSpendingMonth = $month;
                        }
                    }
                    ?>
                    <?php if ($highestSpendingMonth): ?>
                        <p class="text-lg font-bold text-yellow-500">
                            <?= htmlspecialchars($highestSpendingMonth); ?> - <?= $highestSpendingAmount; ?> RS
                        </p>
                    <?php else: ?>
                        <p class="text-lg font-bold text-yellow-500">No data available.</p>
                    <?php endif; ?>
                </div>

                <!-- Highest Spending Category -->
                <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-white">Highest Spending Category</h3>
                    <?php
                    $highestSpendingCategory = null;
                    $highestCategoryAmount = 0;
                    foreach ($categories as $category => $data) {
                        if ($data['total'] > $highestCategoryAmount) {
                            $highestCategoryAmount = $data['total'];
                            $highestSpendingCategory = $category;
                        }
                    }
                    ?>
                    <?php if ($highestSpendingCategory): ?>
                        <p class="text-lg font-bold text-yellow-500">
                            <?= htmlspecialchars($highestSpendingCategory); ?> - <?= $highestCategoryAmount; ?> RS
                        </p>
                    <?php else: ?>
                        <p class="text-lg font-bold text-yellow-500">No data available.</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Expenses Grouped by Month -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $grandTotalByMonth = 0; ?>
                <?php foreach ($months as $month => $data): ?>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-white"><?= htmlspecialchars($month); ?></h3>
                        <ul class="space-y-2 mt-2 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600">
                            <?php foreach ($data['expenses'] as $expense): ?>
                                <li class="flex justify-between items-start p-2 bg-gray-700 rounded-lg">
                                    <span class="text-white break-words max-w-[70%]">
                                        <?= htmlspecialchars($expense['description']); ?> - <?= $expense['amount']; ?> RS
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="edit.php?id=<?= $expense['id']; ?>" class="bg-blue-600 text-white px-2 py-1 rounded">Edit</a>
                                        <form method="post" action="/destroy" class="inline">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="mt-2 font-semibold text-green-300">
                            Total: <?= $data['total']; ?> RS
                        </div>
                    </div>
                    <?php $grandTotalByMonth += $data['total']; ?>
                <?php endforeach; ?>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg shadow-md mt-4">
                <h3 class="text-xl font-semibold text-white">Grand Total by Month</h3>
                <p class="text-lg font-bold text-yellow-500"><?= $grandTotalByMonth; ?> RS</p>
            </div>

            <!-- Expenses Grouped by Category -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                <?php $grandTotalByCategory = 0; ?>
                <?php foreach ($categories as $category => $data): ?>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-md">
                        <h3 class="text-xl font-semibold text-white"><?= htmlspecialchars($category); ?></h3>
                        <ul class="space-y-2 mt-2 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600">
                            <?php foreach ($data['expenses'] as $expense): ?>
                                <li class="flex justify-between items-start p-2 bg-gray-700 rounded-lg">
                                    <span class="text-white break-words max-w-[70%]">
                                        <?= htmlspecialchars($expense['description']); ?> - <?= $expense['amount']; ?> RS
                                    </span>
                                    <div class="flex space-x-2">
                                        <a href="edit.php?id=<?= $expense['id']; ?>" class="bg-blue-600 text-white px-2 py-1 rounded">Edit</a>
                                        <form method="post" action="/destroy" class="inline">
                                            <input type="hidden" name="_method" value="delete">
                                            <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                            <button type="submit" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="mt-2 font-semibold text-green-300">
                            Total: <?= $data['total']; ?> RS
                        </div>
                    </div>
                    <?php $grandTotalByCategory += $data['total']; ?>
                <?php endforeach; ?>
            </div>

            <div class="bg-gray-800 p-4 rounded-lg shadow-md mt-4">
                <h3 class="text-xl font-semibold text-white">Grand Total by Category</h3>
                <p class="text-lg font-bold text-yellow-500"><?= $grandTotalByCategory; ?> RS</p>
            </div>
        </div>
        <!-- END Main Content -->

    </div>

    <!-- Add Expense Modal -->
    <div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full" id="add-expense-modal" tabindex="-1" aria-hidden="true">

        <div class="relative w-full max-w-md max-h-full mx-auto mt-20">
            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-white">Add Expense</h2>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-600 hover:text-white rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-toggle="add-expense-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form class="space-y-4" method="post" action="/add-expense">
                    <div>
                        <label for="amount" class="block text-gray-300 font-semibold">Amount (RS)</label>
                        <input type="number" id="amount" name="amount" placeholder="Enter amount" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white" min="0">
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="flex-1">
                            <label for="category" class="block text-gray-300 font-semibold">Category</label>
                            <select id="category" name="category" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white" <?= empty($category) ? 'disabled' : '' ?>>
                                <?php if (!empty($category)): ?>
                                    <?php foreach ($category as $cat): ?>
                                        <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <button id="toggleCategoryInput" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal">New Category</button>
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block text-gray-300 font-semibold">Description</label>
                        <input type="text" id="description" name="description" placeholder="Enter description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white">
                    </div>
                    <div>
                        <label for="date" class="block text-gray-300 font-semibold">Date</label>
                        <input type="date" id="date" name="date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white">
                        <p id="dateError" class="text-red-500 text-sm mt-1 hidden">Date cannot be in the future.</p>
                    </div>
                    <button id="btnSubmit" type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Add Expense
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
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

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


</html>