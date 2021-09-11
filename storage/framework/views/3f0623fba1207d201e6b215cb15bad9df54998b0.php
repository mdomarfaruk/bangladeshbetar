
<?php $__env->startSection('title_area'); ?>
    :: Leave Application  ::

<?php $__env->stopSection(); ?>
<?php $__env->startSection('show_message'); ?>
    <?php if(Session::has('message')): ?>
        <div class="alert alert-success alert-dismissible" id="alert_hide_after" role="alert"
             style="margin-bottom:10px; ">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(Session::get('message')); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main_content_area'); ?>
    <article class="col-sm-12 col-md-12 col-lg-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false">
            <header>
                <span class="widget-icon"> <i class="fa fa-check txt-color-green"></i> </span>
                <h2>Manual Attendance Application </h2>

                <button type="button" data-toggle="modal" onclick="AddManualApplication()" data-target="#exampleModal"
                        class="btn btn-primary btn-xs" style="float:right;margin-top:5px;margin-right:5px;"><i
                            class="glyphicon glyphicon-list"></i>
                    Add New
                </button>

            </header>

            <!-- widget div-->
            <div>
                <div class="widget-body no-padding">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="margin-top:10px;"></div>

                        <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                            <thead>
                            <tr>
                                <th style="width:5%;">SL</th>
                                <th> Employee Id</th>
                                <th> Name</th>
                                <th> Date</th>
                                <th> In Time</th>
                                <th> Out Time</th>
                                <th> Reason</th>
                                <th> Status</th>
                                <th style="width: 80px"> #</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            $i = 1;
                            ?>
                            <?php if(!empty($data_list)): ?>
                                <?php $__currentLoopData = $data_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>  <?php echo e($i++); ?></td>
                                        <td>  <?php echo e($singleData->title); ?></td>
                                        <td>  <?php echo e($singleData->unit_title); ?></td>
                                        <td>  <?php echo e(($singleData->is_show==1)?"Show Sales":"Not Show"); ?></td>
                                        <td>  <?php echo e($singleData->sorting); ?></td>
                                        <td>  <?php echo e(($singleData->is_active==1)?"Active":"Inactive"); ?></td>
                                        <td>
                                            <button type="button" data-toggle="modal" data-target="#exampleModal"
                                                    onclick="updateData('<?php echo e($singleData->id); ?>','<?php echo e($singleData->title); ?>','<?php echo e($singleData->product_unit); ?>','<?php echo e($singleData->is_show); ?>','<?php echo e($singleData->is_active); ?>','<?php echo e($singleData->sorting); ?>')"
                                                    class="btn btn-primary btn-xs">
                                                <i class="glyphicon glyphicon-pencil"></i>
                                            </button>
                                            <buttton onclick="deleteConfirm('<?php echo e($singleData->id); ?>')"
                                                     class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i>
                                            </buttton>
                                        </td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </article>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6">
                        <h5 class="modal-title" id="exampleModalLabel"><span id="heading-title"></span> </h5>
                    </div>
                    <div class="col-sm-6">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="clearfix"></div>

                </div>
                <?php echo Form::open(['url' => '/save_product_info', 'method' => 'post','id' => 'addManualApp','class'=>'form-horizontal']); ?>

                <div class="modal-body">
                    <div class="col-sm-12" style="margin-top:10px;">

                        <div class="form-group">
                            <label class="col-md-2 control-label">Employee ID</label>
                            <div class="col-md-4">
                                <input type="text" id="employee_id" class="form-control" placeholder="Search Employee Id" required
                                       value="" name="name"/>

                            </div>
                            <label class="col-md-2 control-label">Attendance Date </label>
                            <div class="col-md-4">
                                <input type="text" name="attendance_date" placeholder="Attendance Date" class="form-control datepickerinfo" id="attendance_date_apps">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">In-Time</label>
                            <div class="col-md-4">
                                <input type="text" value="09:00 am" name="attendance_in_time" placeholder="From Date" class="form-control timepicker" id="attendance_in_time">
                            </div>
                            <label class="col-md-2 control-label">Out-Time</label>
                            <div class="col-md-4">
                                <input type="text"  value="05:00 pm" name="attendance_out_time" placeholder="To Date" class="form-control timepicker" id="attendance_out_time">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Reason of Manual Apps.</label>
                            <div class="col-md-10">
                                <textarea name="leave_reason" placeholder="Reason of Leave" class="form-control " id="leave_reason"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Comments</label>
                            <div class="col-md-8">
                                <textarea name="leave_comments" placeholder="Comments" class="form-control " id="leave_comments"></textarea>
                            </div>
                            <label class="col-md-2"><button type="button" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign"></i> Comments</button> </label>
                        </div>




                        <div class="clearfix"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="saveBtn" class="btn btn-success"><i class="glyphicon glyphicon-save"></i>
                            Save
                        </button>
                        <button type="submit" id="updateBtn" class="btn btn-success"><i
                                    class="glyphicon glyphicon-save"></i> Update
                        </button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                    class="glyphicon glyphicon-remove"></i> Close
                        </button>
                        <input type="hidden" name="setting_id" id="setting_id">
                    </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("master_hr", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>