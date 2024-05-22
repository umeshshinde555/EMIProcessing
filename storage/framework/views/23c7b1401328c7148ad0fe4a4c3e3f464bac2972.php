
<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Records')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <?php if($loanDetails->isEmpty()): ?>
                        <p>No records found.</p>
                    <?php else: ?>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-2 py-2">Client ID</th>
                                    <th class="px-2 py-2">No of payment</th>
                                    <th class="px-2 py-2">First payment date</th>
                                    <th class="px-2 py-2">Last payment date</th>
                                    <th class="px-2 py-2">Loan Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $loanDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="border px-2 py-2"><?php echo e($record->clientid); ?></td>
                                        <td class="border px-2 py-2"><?php echo e($record->num_of_payment); ?></td>
                                        <td class="border px-2 py-2"><?php echo e($record->first_payment_date); ?></td>
                                        <td class="border px-2 py-2"><?php echo e($record->last_payment_date); ?></td>
                                        <td class="border px-2 py-2"><?php echo e($record->loan_amount); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                    <a href="<?php echo e(route('process-data.index')); ?>" class="text-blue-500 hover:underline">Process Data Page</a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\EMIProcessing\resources\views/loan-details/index.blade.php ENDPATH**/ ?>