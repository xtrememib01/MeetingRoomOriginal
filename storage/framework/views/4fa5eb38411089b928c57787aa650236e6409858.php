<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="page-header text-center mt-4">
            
        </div>
        <div class="container">
            <div class="card text-left">
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body text-center">
                <h2 class="card-title text-success">Time Left for the meeting</h2>
                <h4>
                    <p class="card-text">
                    <div id="timeLeft" class="text-center text-info text-danger" style="bold size">
                        <div id="dateFromTheGroup" hidden = "true"><?php echo e($bookroom->date); ?></div>
                        <div id="startTime"  hidden = "true"><?php echo e($bookroom->startTime); ?></div>
                    </div>   
                    </p>
                </h4>
            </div>

            </div>
        </div>
           
        <?php if(auth()->user()->user_type !== Null): ?>
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
        <?php endif; ?>
        
        
        <div class="container mt-6 ml-0 mr-0 pl-0 pr-0">
            
        
            <h3 class="mt-4 text-center">Booked Rooms</h3>
            <div class="col-12" >
            <table class="table table-bordered table-hover " style="border:0">
                <thead class="thead-dark">
                        
                        <th style="width:35%" class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 mt-2">Locations</th>
                        <th> Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th style="width:15%">Agenda</th>
                        <th>Features</th>
                        <th>Create by</th>
                        
                </thead>
        
                <tbody>
                        <tr>
                        
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
                        
                        <td>
                            <div class="d-inline-flex">
                                <?php if(($bookroom->user_id == auth()->user()->id && $bookroom->status !='Accepted') || 
                                    (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location)||
                                    auth()->user()->user_type=='God'): ?>
                        
                                    <button class="btn btn-success" style="border:none; margin-right:1em; width:5em; height:70%;">
                                        <a class="text-white" href= "/bookroom/<?php echo e($bookroom->id); ?>/edit" style="height:50%;">Edit</a>
                                    </button>
                                    
                                        <form action="/bookroom/<?php echo e($bookroom->id); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" onclick="return confirm('Sure to Delete')" class="btn btn-danger text-white" 
                                            style="border:none; margin-right:1em; width:5em; height:100%; " >Delete
                                            </button>
                                        </form>
                                <?php endif; ?>
                            
                                <?php if(auth()->user()->user_type =='God' ||
                                    $bookroom->user_id == auth()->user()->id && auth()->user()->user_type == 'Normal' && $bookroom->status == '
                                    '): ?>
                                
                                    <form action="/sendSms/<?php echo e($bookroom->id); ?>" method="get">
                                            <button class="btn btn-primary text-white"
                                            style="border:none; margin-right:1em; width:5em; height:100%;">Invite
                                            </button>
                                    </form>
                                <?php endif; ?>     
                            </div>
                        </td>    
                        <td><?php echo e($bookroom->user->name); ?></td>   
                    </tr>                             
                </tbody> 
                <tr>
                </tr>  
            </table>
        
           
    
            </div>
            </div>
        </div>
    
   
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoomOriginal/resources/views/bookroom/show.blade.php ENDPATH**/ ?>