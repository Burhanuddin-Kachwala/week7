<!DOCTYPE html>
<html lang="en">

<?php require base_path('partials/head.php'); ?>
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

<?php views('expenses/modal/editExpense.modal.php', ['category' => $category]); ?>
<?php views('expenses/modal/addExpense.modal.php', ['category' => $category]); ?>
<?php views('expenses/modal/addCategory.modal.php'); ?>

<body class="font-sans bg-gray-100">
    <?php
    // Default view is by category
    $display = isset($_GET['view']) ? $_GET['view'] : 'month';
    ?>

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
                    <li class="mt-4"><a id="toggleView" class="block py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center">
                            <?= $display === 'category' ? 'View by Month' : 'View by Category'; ?>
                        </a></li>
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

            <!-- Conditional Display of Expenses -->
            <?php if ($display === 'category'): ?>

                <?php views('expenses/categoryExpense.php', ['categories' => groupExpensesByCategory($results)]); ?>
            <?php else: ?>
                <?php views('expenses/monthlyExpense.php', ['months' => groupExpensesByMonth($results)]); ?>
            <?php endif; ?>


        </div>
        <!-- END Main Content -->



             

    </div>


   

   

</body>
<script>
    $('#toggleView').on('click', function() {
        var url = new URL(window.location.href);
        var currentView = url.searchParams.get('view');
        var newView = currentView === 'category' ? 'month' : 'category';

        // Toggle the view
        url.searchParams.set('view', newView);
        window.location.href = url.toString();

        // Change button text accordingly
        $(this).text(newView === 'category' ? 'View by Month' : 'View by Category');
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.0/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<?php views('scripts/addCategory.php'); ?>
<?php views('scripts/addExpense.php'); ?>
<?php views('scripts/editExpense.php'); ?>
<?php views('scripts/deleteExpense.php'); ?>
<?php views('scripts/toastMessage.php') ?>




</html>