(function() {
	var app = angular.module('app', []);

	var MainController = function($scope, $http) {
		$scope.message = 'Hi, Umaha';
	};



	app.controller('MainController', MainController);
}());