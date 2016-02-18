(function() {
	var app = angular.module('app', ['ngRoute']);

	var MainController = function($scope, $http) {
		$scope.message = 'Hi, Umaha';
	};



	app.controller('MainController', MainController);
})();