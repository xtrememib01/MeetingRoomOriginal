<script>
    function meetingEntry(no){
        document.getElementById('MeetingEntry'+no).style.display="block";
    }
</script>
<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('inc.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="container">
        <div class="page-header text-center mt-4">
            <h1>Calendar view</h1>
        </div>
        
        
        
        <?php if(auth()->user()->user_type !== null && auth()->user()->user_type !== "Webex" && auth()->user()->user_type !== "MSTeams" && auth()->user()->user_type !== "Lifesize"): ?>
            <div class="container">
                <div class="card">
                    
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

        <div class="mt-4 ml-3 mr-3">
            <div id='calendar'></div>
        </div>
        <div id='timer.js'></div>

        
    
  
  <?php if(auth()->user()->user_type !== null): ?>
    <div class="container mt-6 ml-0 mr-0 pl-0 pr-0">
        <h3 class="mt-4 ml-4 text-center"><?php echo e(auth()->user()->name); ?>'s Dash Board</h3>
            <div class="col-12" >
            <table class="table table-bordered table-hover " style="border:0">
                <thead class="thead-dark">
                <tr>
                    
                    <th class="col" style="width:24%">Locations</th>
                    <th class="col" style="width:12%">Date</th>
                    <th class="col" style="width:4%">From</th>
                    
                    
                    <th class="col" style="width:28%">Agenda</th>
                    <th class="col" style="width:3%"> Status</th>
                    <th class="col" style="width:10%">Features</th>
                    <th class="col" style="width:10%">Created by</th>
                    
                </tr>
                </thead>
                <tbody>

                    <?php $__currentLoopData = $bookrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        
                        <?php if(($bookroom->user_id == auth()->user()->id) || 
                        (auth()->user()->user_type =="Super" && auth()->user()->location==$bookroom->user->location)): ?>
                            <tr>
                                <td>
                                    <?php $__currentLoopData = $bookroom->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                        <?php echo e($location); ?><br><br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </td>
                                <td><?php echo e($bookroom->date); ?></td>
                                <td><?php echo e($bookroom->startTime); ?></td>
                                <td><?php echo e($bookroom->agenda); ?></td>
                                <td><?php echo e($bookroom->status); ?></td>

                             <td>
                                    <div class="d-inline-flex">
                                        <?php if(($bookroom->user_id == auth()->user()->id && $bookroom->status !=='Accepted') || 
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
                                            $bookroom->user_id == auth()->user()->id && auth()->user()->user_type == 'Normal' && $bookroom->status == 'Accepted'): ?>
                                        
                                            <form action="/sendSms/<?php echo e($bookroom->id); ?>" method="get">
                                                    <button class="btn btn-primary text-white"
                                                    style="border:none; margin-right:1em; width:5em; height:100%;">Invite
                                                    </button>
                                            </form>
                                        <?php endif; ?>     
                                    </div>
                                </td> 
                                <td><?php echo e($bookroom->user->name); ?>

                                </td>                         
                            </tr>
                        <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
         
        
    </div>




        <?php if(auth()->user()->user_type == "Webex"): ?>
            <?php $__currentLoopData = $bookrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($bookroom->platform == "Webex"): ?>
                <tr>
                    <td><?php $__currentLoopData = $bookroom->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($location); ?><br><br><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                    <td><?php echo e($bookroom->date); ?></td>
                    <td><?php echo e($bookroom->startTime); ?></td>
                    <td><?php echo e($bookroom->agenda); ?></td>
                    <td><?php echo e($bookroom->status); ?></td>
                    <td></td>
                    <td><?php echo e($bookroom->user->name); ?>

                        
                     <?php if(auth()->user()->user_type== "Webex" && $bookroom->status=="Accepted"): ?>
                     <button onclick="meetingEntry(<?php echo e($bookroom->id); ?>)" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
                     <?php endif; ?>

                        <br>
                        <div id="MeetingEntry<?php echo e($bookroom->id); ?>" style="display:none">
                            <form action="/MeetingEntry/<?php echo e($bookroom->id); ?>" method="GET">
                                <?php echo csrf_field(); ?>
                                 <textarea name="url"><?php echo e($bookroom->url); ?></textarea>
                                    <button type="submit" class="btn btn-primary btn-sm text-white">Submit the link</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>     

        
        <?php if(auth()->user()->user_type == "Lifesize"): ?>
        <?php $__currentLoopData = $bookrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($bookroom->platform == "Lifesize"): ?>
            <tr>
                <td><?php $__currentLoopData = $bookroom->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($location); ?><br><br><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                <td><?php echo e($bookroom->date); ?></td>
                <td><?php echo e($bookroom->startTime); ?></td>
                <td><?php echo e($bookroom->agenda); ?></td>
                <td><?php echo e($bookroom->status); ?></td>
                <td></td>
                <td><?php echo e($bookroom->user->name); ?>

                    <br>
                    
                 <?php if(auth()->user()->user_type== "Lifesize" && $bookroom->status=="Accepted"): ?>
                 <button onclick="meetingEntry(<?php echo e($bookroom->id); ?>)" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
                 <br>
                 <?php endif; ?>
              
                    <div id="MeetingEntry<?php echo e($bookroom->id); ?>" style="display:none">
                        <form action="/MeetingEntry/<?php echo e($bookroom->id); ?>" method="GET">
                            <?php echo csrf_field(); ?>
                             <textarea name="url"><?php echo e($bookroom->url); ?></textarea>
                                <button type="submit" class="btn btn-primary btn-sm text-white">Submit the link</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>     

    

    <?php if(auth()->user()->user_type == "MSTeams"): ?>
    <?php $__currentLoopData = $bookrooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookroom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($bookroom->platform == "MSTeams"): ?>
        <tr>
            <td><?php $__currentLoopData = $bookroom->shifts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($location); ?><br><br><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
            <td><?php echo e($bookroom->date); ?></td>
            <td><?php echo e($bookroom->startTime); ?></td>
            <td><?php echo e($bookroom->agenda); ?></td>
            <td><?php echo e($bookroom->status); ?></td>
            <td></td>
            <td><?php echo e($bookroom->user->name); ?>

                
             <?php if(auth()->user()->user_type== "MSTeams" && $bookroom->status=="Accepted"): ?>
             <button onclick="meetingEntry(<?php echo e($bookroom->id); ?>)" class="btn btn-primary btn-sm text-white">Enter Meeting Room</button>
             <?php endif; ?>
    
                <div id="MeetingEntry<?php echo e($bookroom->id); ?>" style="display:none">
                    <form action="/MeetingEntry/<?php echo e($bookroom->id); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                         <textarea name="url"><?php echo e($bookroom->url); ?></textarea>
                            <button type="submit" class="btn btn-primary btn-sm text-white">Submit</button>
                    </form>
                </div>
            </td>
        </tr>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>     
    </tbody>
                
</table>
</div>
    <?php endif; ?>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/durgesh/Documents/Laravel/Projects/MeetingRoomOriginal/resources/views/bookroom/index.blade.php ENDPATH**/ ?>