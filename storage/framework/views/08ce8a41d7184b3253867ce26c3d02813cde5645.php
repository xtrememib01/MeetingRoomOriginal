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
            <input type="text" class="form-control" id="conference_details" name="conference_details" value=<?php echo e(old('conference_details')); ?>>
        </div>
        <div class="form-row ">
            <label for="date" class="col-4">Date</label>
            <label for="startTime" class="col-4">Start Time</label>
            <label for="endTime" class="col-4">End Time</label>
        </div>   
        <div class="form-row mr-3" style="mr-3">
            <input type="date" class="form-control col-4" style="width:10em" id="date" name="date" value=<?php echo e(old('date')); ?>>
            <input type="time" class="form-control col-4" id="startTime" name="startTime" value=<?php echo e(old('startTime')); ?>>
            <input type="time" class="form-control col-4" id="endTime" name="endTime" value=<?php echo e(old('endTime')); ?>>
        </div>

        <br>
        <label for="Select Location">Select Location</label>
        <br>
        <div class="overflow-auto form-group" style="height:20em">
            <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                <input id ="<?php echo e($location->location); ?>" type="checkbox" name ="locations[]" value="<?php echo e($location->location); ?>">
                <label for="<?php echo e($location->location); ?>" ><?php echo e($location->location); ?></label><br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="form-group">
            <label for="agenda">Agenda</label>
            
        <textarea class="form-control" id="agenda" name="agenda" rows="5"><?php echo e(old('agenda')); ?></textarea>

        </div>

        <br>
        <label for="platform">Platform</label>
        <div>
            <select id="platform" type="text" class="form-control <?php $__errorArgs = ['platform'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="platform" value="<?php echo e(old('platform')); ?>" autofocus>
                <option value="none">None</option>
                <option value="Corporate VC" selected>Corporate VC</option>
                <option value="Lifesize">Lifesize</option>
                <option value="MSTeams">MSTeams</option>
                <option value="Webex">Webex</option>
              </select>
            <?php $__errorArgs = ['user_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($message); ?></strong>
                </span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <br/>
        <br/>

        
        <div class="form-group">
            <label for="url">Meeting Link</label>
            
        <textarea class="form-control" id="url" name="url" rows="5"><?php echo e(old('url')); ?></textarea>
        </div>
        

        <br/>
        <br/>
        <button type="submit" class="btn btn-success width:100%">Submit</button>
        </form>
        <?php endif; ?>
        
</div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoomOriginal/resources/views/bookroom/create.blade.php ENDPATH**/ ?>