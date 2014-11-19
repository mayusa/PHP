<!DOCTYPE html>
<html ng-app="mayApp">
<head>
	<meta charset="utf-8">
	<!-- viewport: 控制在设备上缩放页面 -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0,  maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>May's Shopping List</title>
	<link rel="stylesheet" media="screen" href="css/font-awesome-4.2.0/css/font-awesome.min.css">
	<link rel="stylesheet" media="screen" href="css/normalize.css">
	<link rel="stylesheet" media="screen" href="css/foundation.css">
	<link rel="stylesheet" media="screen" href="css/app-screen.css">
	<link rel="stylesheet" media="print" href="css/app-print.css">
	<script src="js/lib/storedb.js"></script>
	<script src="js/lib/angular.js"></script>
	<script src="js/shopping-list-local.js"></script>
</head>
<body ng-controller="ShoppingListController">

	<div class="panel text-center">
			<h1>My Shopping List</h1> 
			(GitHub: mayusa)
	</div>

	<div class="row">
		<div class="column">	

			<form id="addForm" ng-submit="insert()">
				<!-- /warning label -->
				<div class="row">
					<div class="column">
						<span class="spanLabel" ng-show="!minCharsMet()">You need at least {{ howManyMoreCharsNeeded() }} characters</span>
						<span class="spanLabel" ng-show="isNumOfCharsWithinRange()">Remaining characters: {{ howManyCharsRemaining() }}</span>
						<span class="spanLabel warning" ng-show="anyCharsOver()">{{ howManyCharsOver() }} characters too many</span>
					</div>
				</div>
				<!-- warning label/ -->

				<div class="row">
					<div class="large-8 columns">
						<input type="text" name="itemtitle" placeholder="Item Name" ng-model="itemtitle" ng-trim="false">
					</div>
					<div class="large-2 columns">
						<input type="text" name="qty" placeholder="Qty/Weight" ng-model="qty" ng-trim="false">
					</div>
					<div class="large-2 columns">
						<select name="type" ng-model="type">
							<option ng-repeat="type in types" value="{{ type.id }}"> {{type.name}} </option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="column">
						<!-- for tablet or pc -->
						<div class="show-for-medium-up">

							<div class="flr">
								<button type="button" class="small button primary" ng-click="print()"><i class="fa fa-print"></i> Pring List</button>

								<button type="button" class="small button alert" confirmed-click="remove()" 
    ng-confirm-click="Are you sure to clear completed?"><i class="fa fa-times"></i> Clear Completed</button>

							</div>
							<button type="submit" class="small button" ng-disabled="!goodToGo()"><i class="fa fa-plus"></i> Add</button>

							<button type="submit" class="small button secondary" confirmed-click="clear()" 
    ng-confirm-click="Are you sure to clear input?"><i class="fa fa-ban"></i> Clear Entry</button>

						</div>
						<!-- for mobile device screen -->
						<div class="show-for-small-only">
							<ul class="button-group even-4">					
								<li><button type="submit" class="small button" ng-disabled="!goodToGo()"><i class="fa fa-plus"></i></button></li>
								<li><button type="submit" class="small button secondary" confirmed-click="clear()" 
    ng-confirm-click="Are you sure to clear input?"><i class="fa fa-ban"></i></button></li>
								<li><button type="button" class="small button primary" ng-click="print()"><i class="fa fa-print"></i></button></li>
								<li><button type="button" class="small button alert" confirmed-click="remove()" 
    ng-confirm-click="Are you sure to clear completed?"><i class="fa fa-times"></i></button></li>

							</ul>
						</div>

					</div>
				</div>

			</form>

			<form id="items">
				<div class="row" ng-repeat="item in items" ng-class="{ 'done' : item.done == 1 }">
					<div class="small-8 columns itemName">
						<label for="item-{{ item.id }}">
							<input type="checkbox" name="item-{{ item.id }}" id="item-{{ item.id }}" 
							ng-model="item.done" 
							ng-true-value="1" 
							ng-false-value="0" 
							ng-change="update(item)"> 	{{ item.itemtitle}} - {{ item.date | date: "yyyy-MMM-dd" }}
						</label>
					</div>
					<div class="small-2 columns itemQty">
						{{ item.qty}}
					</div>
					<div class="small-2 columns itemType">
							{{ item.type_name}}
					</div>
				</div>
			</form>
		</div>
	<br>
	<br>
	</div>
	<br> <br>

</body>
</html>