<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="page-header text-center mt-4">
            <h1>Calendar view</h1>
        </div>
        

        
        
        <div class="container">
            <div class="card">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body ">
                    <a href="/bookroom/create">
                        <div class="row">
                            <i class="fa fa-address-book fa-3x col-1 mr-0 pr-0"></i>
                            <h4 class="card-title col-11  mt-2 ml-0 pl-0 ">Book  a conference room</h4>
                        </div>
                        <p class="card-text ml-5">Click on the above icon to book a conference room</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-4 ml-3 mr-3">
            <div id='calendar'></div>
        </div>
        <div id='timer.js'></div>

        
    
  
    <div class="container mt-6 ml-0 mr-0 pl-0 pr-0">
            
        
            <h3 class="mt-4 ml-4 text-center">Booked Rooms</h3>
            <div class="col-12" >
            <table class="table table-bordered table-hover table-dark" style="border:0">
                <thead>
                <tr>
                    <th class="col">Conference Details</th>
                    <th class="col">Locations</th>
                    <th class="col">Date</th>
                    <th class="col">From</th>
                    <th class="col">To</th>
                    <th class="col">Agenda</th>
                    <th class="col"> Status</th>
                    <th class="col">Edit</th>
                    <th class="col"> Delete</th>
                </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $bookrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(($bookroom->user_id == auth()->user()->id && $bookroom->status !='Accept') || 
                    (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location)): ?>
             
                      <tr>
                        <td><?php echo e($bookroom->conference_details); ?></td>
                        <td>
                            <?php $__currentLoopData = $bookroom->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                <?php echo e($location); ?>

                                <br>
                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                        </td>
                        <td><?php echo e($bookroom->date); ?></td>
                        <td><?php echo e($bookroom->startTime); ?></td>
                        <td><?php echo e($bookroom->endTime); ?></td>
                        <td><?php echo e($bookroom->agenda); ?></td>
                        <td><?php echo e($bookroom->status); ?></td>

                        

        
            
        


                         <?php if(($bookroom->user_id == auth()->user()->id && $bookroom->status !='Accept') || 
                            (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location)): ?>
                            <td><a href= "/bookroom/<?php echo e($bookroom->id); ?>/edit" class="btn btn-success no-hover">Edit</a></td>
                            <td>
                                <form action="/bookroom/<?php echo e($bookroom->id); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" onclick="return confirm('Sure to Delete')" class="btn btn-danger btn-round">Delete</button>
                                </form>
                            </td>
                        <?php endif; ?>
                          
                    </tr>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                    
                </tbody>
                
            </table>
            </div>
        
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoomOriginal/resources/views/bookroom/index.blade.php ENDPATH**/ ?>