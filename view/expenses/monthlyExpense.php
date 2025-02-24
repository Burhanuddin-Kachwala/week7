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
                                        
                                        <button id= "editBtn"class="bg-blue-600 text-white px-2 py-1 rounded" data-modal-toggle="edit-expense-modal" data-modal-target="edit-expense-modal" data-expense-id="<?= $expense['id']; ?>" data-modal-target="edit-expense-modal"
                                            data-id="<?= $expense['id']; ?>"
                                            data-amount="<?= $expense['amount']; ?>"
                                            data-category="<?= $expense['category']; ?>"
                                            data-description="<?= $expense['description']; ?>"
                                            data-date="<?= $expense['date']; ?>">Edit</button>
                                        <form method="post" action="/destroy" class="inline" onsubmit="return confirm('Are you sure you want to delete this expense?');">
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
                <h3 class="text-xl font-semibold text-white">Grand Total</h3>
                <p class="text-lg font-bold text-yellow-500"><?= $grandTotalByMonth; ?> RS</p>
            </div>