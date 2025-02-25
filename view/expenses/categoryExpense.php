<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6 ">
    
    <?php $grandTotalByCategory = 0; ?>
    <?php foreach ($categories as $category => $data): ?>
        <div class="bg-gray-800 p-4 rounded-lg shadow-md">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold text-white"><?= htmlspecialchars($category); ?></h3>
                <div class="flex space-x-4"> 
                    <button id="editCategoryBtn" 
                        class="text-yellow-400 text-2xl" 
                            data-modal-target="edit-category-modal" 
                            data-modal-toggle="edit-category-modal"
                            data-old="<?= htmlspecialchars($category); ?>"
                        > 
                        <i class="fas fa-pen"></i>
                    </button>
                   
                    <form method="post" action="/destroyCategory" id="deleteCategory" class="inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($category); ?>">
                                <button type="submit" class="text-red-400 text-2xl">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                    
                </div>
            </div>
            <ul class="space-y-2 mt-2 max-h-64 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-600">
                <?php foreach ($data['expenses'] as $expense): ?>
                    <li class="flex justify-between items-start p-2 bg-gray-700 rounded-lg ">
                        <span class="text-white break-words max-w-[70%]">
                            <?= htmlspecialchars($expense['description']); ?> - <?= $expense['amount']; ?> RS
                        </span>
                        <div class="flex space-x-4"> <!-- Adjusted spacing -->
                            <button id="editBtn" class="text-yellow-400" data-modal-toggle="edit-expense-modal" data-modal-target="edit-expense-modal" data-expense-id="<?= $expense['id']; ?>" data-modal-target="edit-expense-modal"
                                data-id="<?= $expense['id']; ?>"
                                data-amount="<?= $expense['amount']; ?>"
                                data-category="<?= $expense['category']; ?>"
                                data-description="<?= $expense['description']; ?>"
                                data-date="<?= $expense['date']; ?>">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form method="post" action="/destroy" class="inline" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                <input type="hidden" name="_method" value="delete">
                                <input type="hidden" name="id" value="<?= $expense['id']; ?>">
                                <button type="submit" class="text-red-400">
                                    <i class="fas fa-trash"></i>
                                </button>
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

<span class="new-data">

</span>
    
</div>

<div class="bg-gray-800 p-4 rounded-lg shadow-md mt-4">
    <h3 class="text-xl font-semibold text-white">Grand Total</h3>
    <p class="text-lg font-bold text-yellow-500"><?= $grandTotalByCategory; ?> RS</p>
</div>
<!-- Toast Message -->
<?php views('toast.view.php') ?>
 <!--manual toaste -->
 <div id="dashboard-toast" class="fixed bottom-4 right-4  text-white text-sm rounded-lg shadow-lg p-4 flex items-center justify-between space-x-4 hidden"></div>