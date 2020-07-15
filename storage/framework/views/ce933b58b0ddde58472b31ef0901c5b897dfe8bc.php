<?php $__env->startSection('content'); ?>
<?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">    
    <?php if(auth()->guard()->check()): ?>
    <form action="/bookroom/<?php echo e($bookrooms->id); ?>" method="POST">
        
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="conference_details">Conference details</label>
            <input type="text" class="form-control" id="conference_details" name="conference_details" value=<?php echo e($bookrooms->conference_details); ?>>
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" value=<?php echo e($bookrooms->date); ?>>
            <input type="time" class="form-control col-4" id="startTime" name="startTime" value=<?php echo e($bookrooms->startTime); ?> >
            <input type="time" class="form-control col-4" id="endTime" name="endTime" value=<?php echo e($bookrooms->endTime); ?>>
        </div>
        <div class="form-group">
            <label for="Select Location">Select Location</label>
            <select multiple class="form-control" style="min-height:200px"name="locations[]" id="exampleFormControlSelect1">
                <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                    <option selected><?php echo e($location->location); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>         
            </select>
        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            <input type="textArea" class="form-control" id="agenda" name="agenda" value= <?php echo e($bookrooms->agenda); ?>>
        </div>

        <?php if(auth()->user()->user_type =="Super" || auth()->user()->user_type =='God'): ?>
        <div class="form-group">
            <label for="status">Agenda</label>
            <select id ="status"  type="text" class="form-control" id="status" name="status" value= <?php echo e($bookrooms->status); ?>>
                <option value="Pending" class="success">Pending</option>
                <option value="Accept" class="success">Accept</option>
                <option value="Reject" class="danger" selected >Reject</option>
            </select>
        </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success">Submit</button>
        </form>
        <?php endif; ?>
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoomOriginal/resources/views/bookroom/edit.blade.php ENDPATH**/ ?>