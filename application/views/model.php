<script src="js/angular-validation/add-model.js"></script>
<link href="css/plugin/fileup.css" rel="stylesheet" type="text/css">
<link href="css/plugin/jquery.growl.css" rel="stylesheet" type="text/css">
<!-- Page Content -->
	<div id="page-content-wrapper" style="padding-left: 260px;" ng-app="addModel" ng-controller="mdlController">
       
            <div class="container-fluid">
                <h3>Model</h3>
                <hr>
               	<form name="ModelForm" id="modelForm">
	                <fieldset>
	                    <div class="m-b-20">
	                        <div class="form-group form-inline">
	                        	<div class="row">	                        		
			                        <label class="control-label col-sm-2">Model Name</label>
			                        <div class="col-sm-4">
				                        <input type="text" class="form-control m-b-20" name="name" ng-model="modelForm.name" validator="required,minlength" minlength = "3"  message-id="model" />
				                        <span id="model"></span><span class="validation-invalid">{{errorMessage.modlnm }}</span>
			                        </div>
			                        <label class="control-label col-sm-2">Manufacturer Name</label>
			                        <div class="col-sm-4">
				                        <select class="form-control m-b-20" name="manufacturer" ng-model="modelForm.manufacturerName" validator="required" message-id="manufacturer">
			                            <option value="">Select Manufacturer Name</option>
			                            
		                                <?php foreach($manufacturer_data as $row){ ?>
		                                    <option value="<?php echo $row['manufacturer_id']; ?>"><?php echo strtoupper($row['name']); ?></option>
		                                <?php } ?>
			                        </select>
			                        <span id="manufacturer"></span>
			                        </div>
                           		</div>
	                        </div>
                           	<div class="form-group form-inline">
                           		<div class="row">
			                        <label class="control-label col-sm-2">Color</label>
			                        <div class="col-sm-10">
				                        <input type="text" class="form-control m-b-20" name="color" ng-model="modelForm.color" validator="required"  message-id="color"/>
				                        <span id="color"></span><span class="validation-invalid">{{errorMessage }}</span>
			                        </div>
		                        </div>
                           	</div>
                           	<div class="form-group form-inline">
                           		<div class="row">
			                        <label class="control-label col-sm-2">Manufacturing Year</label>
			                        <div class="col-sm-10">
									<datepicker ng-model="modelForm.year" name="year" min-mode="year" datepicker-mode="'year'"></datepicker>
			                        </div>
		                        </div>
                           	</div>
                           	<div class="form-group form-inline">
                           		<div class="row">
			                        <label class="control-label col-sm-2">Registration Number</label>
			                        <div class="col-sm-10">
				                        <input type="text" class="form-control m-b-20" name="registrationNo" ng-model="modelForm.registrationNo" min="10" max="10" validator="required" valid-method="submit-only" message-id="registrationNo"/>
				                        <span id="registrationNo"></span><span class="validation-invalid">{{errorMessage }}</span>
			                        </div>
		                        </div>
		                        
                           	</div>  
                           	<div class="form-group form-inline">
                           		<div class="row">
			                        <label class="control-label col-sm-2">Note</label>
			                        <div class="col-sm-10">
				                        <textarea style="overflow:auto;resize:none" rows="3" cols="20" name="note" ng-model="modelForm.note"  valid-method="submit-only"></textarea>
				                        
			                        </div>
		                        </div>
		                        
                           	</div>
                           	<div class="form-group form-inline">
                           		<div class="row">
			                        <label class="control-label col-sm-2">Image</label>
			                        <div class="col-sm-10">
				                        <button type="button" class="btn btn-success fileup-btn">
									        Select files
									        <input ng-model="modelForm.modelImage" type="file" name="image" id="upload-2" multiple accept="image/*"  message-id="image" >
									    </button>
									       <!--  <span id="image"></span><span class="validation-invalid">{{errorMessage }}</span>
	 -->
									    <a class="control-button btn btn-link" style="display: none"
									       href="javascript:$.fileup('upload-2', 'upload', '*')">Upload all</a>
									    <a class="control-button btn btn-link" style="display: none"
									       href="javascript:$.fileup('upload-2', 'remove', '*')">Remove all</a>
									     <input type="hidden" id="img-name" name="img-name" ng-model="modelForm.image" >

									    <div id="upload-2-queue" class="queue"></div>
				                        
			                        </div>
		                        </div>
		                        
                           	</div>                      

	                    </div>
	                    <div class="btn-group" role="group">
	                        <button type="button" class="btn btn-success " ng-click="modelForm.submit(ModelForm)">Submit</button>
	                        <button class="btn btn-danger" ng-click="modelForm.reset(ModelForm)">Reset</button>
	                        
	                    </div>

						<!-- <pre>{{ modelForm |json }}</pre> -->
	                </fieldset>
	            </form> 
            </div>
        
    </div>
        <!-- /#page-content-wrapper -->
         <script src="js/angular-validation/add-model.js"></script>
        <script src="js/plugin/fileup.js"></script> 
        <script src="js/plugin/jquery.growl.js"></script> 

		
		
    
    	
        
<script>
       
		$.fileup({
            url: '/car_inventory_r/model/model/do_upload',
            inputID: 'upload-2',
            dropzoneID: 'upload-2-dropzone',
            queueID: 'upload-2-queue',
            onSelect: function(file) {
                $('#modelForm .control-button').show();
            },
            onRemove: function(file, total) {
                console.log(total);
                if (file === '*' || total === 1) {
                    $('#modelForm .control-button').hide();
                }
            },
            onSuccess: function(response, file_number, file) {
            	//.log(jQuery.parseJSON(response));
            	var obj = $.parseJSON(response);
            	console.log(obj);
            	
            	
            	if(obj.hasOwnProperty('upload_data')){
            		$('#img-name').val(function(i,val) { 
				     return val + (!val ? '' : ', ') + obj.upload_data.file_name ;
					});
            		$.growl.notice({ title: "Upload success!", message: obj.upload_data.client_name });
            	}else{
        		 	$.growl.error({ title: "Upload error!", message: obj.error });
            	}
                //console.log($.growl.notice);
                
            },
            onError: function(event, file, file_number) {
                $.growl.error({ message: "Upload error!" });
            }
        });
		
		 

    </script>
       