<script src="js/angular-validation/add-manufacturer.js"></script>
<!-- Page Content -->
        <div id="page-content-wrapper" style="padding-left: 260px;" ng-app="addManufacturer" ng-controller="mfgController">
            <div class="container-fluid">
                <h1>Add Manufacturer</h1>
                
				<form name="ManufacturerForm" id="manufacturerForm">
	                <fieldset>
	                    <div class="m-b-20">
	                       
	                        <label>Manufacturer Name</label>
	                        <input type="text" class="form-control m-b-20" name="manufacturer" ng-model="manufacturerForm.required" validator="required" valid-method="submit-only" message-id="manufacturer"/>
	                        <span id="manufacturer"></span><span class="validation-invalid">{{errorMessage }}</span>
	                                           

	                    </div>
	                    <div class="btn-group" role="group">
	                        <button type="button" class="btn btn-success" ng-click="manufacturerForm.submit(ManufacturerForm)">Submit</button>
	                        <button class="btn btn-danger" ng-click="manufacturerForm.reset(ManufacturerForm)">Reset</button>
	                        
	                    </div>
	                </fieldset>
	            </form>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
       
        