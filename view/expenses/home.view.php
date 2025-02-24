<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracking App</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
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
            <form id="expenseForm" class="space-y-4" method="post" action="/add-expense">
                <div>
                    <label for="amount" class="block text-gray-700 font-semibold">Amount (RS)</label>
                    <input type="number" id="amount" name="amount" placeholder="Enter amount " class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" min="0" required>
                </div>
                <div>
                    <label for="category" class="block text-gray-700 font-semibold">Category</label>
                    <select id="category" name="category" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" <?= empty($category) ? 'disabled' : '' ?> required>
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
                    <input type="text" id="description" name="description" placeholder="Enter description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div>
                    <label for="date" class="block text-gray-700 font-semibold">Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400" required>
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
    <?php views('expenses/modal/addCategory.modal.php'); ?>
    <!-- Main Modal Section End -->

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
   <?php views('scripts/addExpense.php'); ?>
   <?php views('scripts/addCategory.php'); ?>
   
</body>

</html>
