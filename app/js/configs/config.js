angular.module('app').config(function ($stateProvider) {


    var form = {
        name: 'list',
        url: '/list',
        templateUrl: 'pages/list-items.html'
    }

    var table = {
        name: 'form',
        url: '/form',
        templateUrl: 'pages/form.html'
    }

    $stateProvider.state(form);
    $stateProvider.state(table);
});