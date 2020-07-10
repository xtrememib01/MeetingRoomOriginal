<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">    
    <?php if(auth()->guard()->check()): ?>
    
        <div class="page-header text-center mt-4">
            <h1>Book conference room</h1>
        </div>
        <form action="/bookroom" method="post">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="conference_details">Conference details</label>
            <input type="text" class="form-control" id="conference_details" name="conference_details" >
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" >
            <input type="time" class="form-control col-4" id="startTime" name="startTime" >
            <input type="time" class="form-control col-4" id="endTime" name="endTime" >
            
        </div>
        <div class="form-group">
            <label for="Select Location">Select Location</label>
            <select multiple class="form-control" style="min-height:200px" name="locations[]" id="exampleFormControlSelect1">
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option><?php echo e($location->location); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            <input type="textArea" class="form-control" id="agenda" name="agenda">
        </div>
        <button type="submit" class="btn btn-success width:100%">Submit</button>
        </form>
        <?php endif; ?>
        
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoom/resources/views/bookroom/create.blade.php ENDPATH**/ ?>