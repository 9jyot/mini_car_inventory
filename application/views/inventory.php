<!-- <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>-->
<script src="js/plugin/angular-datatables.min.js"></script>

<script src="js/plugin/jquery.dataTables.min.js"></script>
<script src="js/inventory.js"></script>

<link rel="stylesheet" href="css/plugin/datatables.bootstrap.css">
<!-- Page Content -->
<div id="page-content-wrapper" style="padding-left: 260px;" ng-app="inventoryApp" ng-controller="inventoryController">

	<div class="container-fluid">
		<h3>Inventory</h3>
		<hr>
		<div class="table-responsive">
			<table datatable="ng" dt-options="vm.dtOptions" class="table table-striped table-bordered" class="table">
				<thead>
					<tr>
						<th>Sr. No.</th>
						<th>Manufacturer Name</th>
						<th>Model Name</th>
						<th>Count</th>

					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="inventory in inventory_list" ng-click="getPopup(inventory)">
						<td>{{ $index + 1 }}</td>
						<td>{{ inventory.manufacturer_name }}</td>
						<td>{{ inventory.model_name }}</td>
						<td>{{ inventory.count }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- /#page-content-wrapper -->