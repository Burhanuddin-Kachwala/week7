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
            <form id="expenseForm" class="space-y-4" method="post" action="/add-expense" >
                <div>
                    <label for="amount" class="block text-gray-300 font-semibold">Amount (RS)</label>
                    <input type="number" id="amount" name="amount" placeholder="Enter amount" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white" min="0">
                    <?php if (isset($errors['amount'])): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['amount']; ?></p>
                    <?php endif; ?>
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
                        <?php if (isset($errors['category'])): ?>
                            <p class="text-red-500 text-sm mt-1"><?= $errors['category']; ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- <div>
                        <button id="toggleCategoryInput" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300" data-modal-target="add-category-modal" data-modal-toggle="add-category-modal">New Category</button>
                    </div> -->
                </div>
                <div>
                    <label for="description" class="block text-gray-300 font-semibold">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter description" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white">
                    <?php if (isset($errors['description'])): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['description']; ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="date" class="block text-gray-300 font-semibold">Date</label>
                    <input type="date" id="date" name="date" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-400 bg-gray-700 text-white">
                    <?php if (isset($errors['date'])): ?>
                        <p class="text-red-500 text-sm mt-1"><?= $errors['date']; ?></p>
                    <?php endif; ?>
                    <p id="dateError" class="text-red-500 text-sm mt-1 hidden">Date cannot be in the future.</p>
                </div>
                <button id="btnSubmit" type="submit" class="w-full bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Add Expense
                </button>

                <!-- Toast Message -->
            <?php views('toast.view.php')?>
             <!--manual toaste -->
<div id="expense-toast" class="fixed bottom-4 right-4  text-white text-sm rounded-lg shadow-lg p-4 flex items-center justify-between space-x-4 hidden"></div>
            </form>
            


        </div>
    </div>
</div>
<?php views('scripts/addExpense.php'); ?>