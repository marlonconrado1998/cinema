(function () {
    'use strict';

    angular
        .module('app')
        .controller('CinemaController', CinemaController)

    /** @ngInject */
    CinemaController.$inject = ['CinemaService'];


    function CinemaController(CinemaService) {

        var vm = this;


        // variables 
        vm.cinema = [];
        vm.tab = 'table';
        vm.query = null;

        // methods 
        vm.getCinema = getCinema;
        vm.deleteCinema = deleteCinema;
        vm.getBetters = getBetters;
        vm.getRecents = getRecents;
        vm.findCinema = findCinema;
        vm.addCinema = addCinema;
        vm.setQualification = setQualification;


        vm.getCinema();

        function getCinema() {
            CinemaService.getCinema().then(function ({
                data
            }) {
                if (data) {
                    vm.cinema = data;
                }
            }).catch(function (error) {

            });
        }

        function getBetters() {
            CinemaService.getBetters().then(function ({
                data
            }) {
                if (data) {
                    vm.cinema = data;
                }
            }).catch(function (error) {

            });
        }


        function deleteCinema(idCinema) {
            CinemaService.deleteCinema(idCinema).then(function ({
                data
            }) {
                vm.getCinema();
                alert("Item eliminado correctamente.");
            }).catch(function (error) {

            });
        }

        function getRecents() {
            CinemaService.getRecents().then(function ({
                data
            }) {
                if (data) {
                    vm.cinema = data;
                }
            }).catch(function (error) {

            });
        }

        function findCinema() {

            if (!vm.query) return false;

            CinemaService.findCinema(vm.query).then(function ({
                data
            }) {
                if (data) {
                    vm.cinema = data;
                }
            }).catch(function (error) {
                console.log(error)
            });
        }

        function addCinema() {

            if (!vm.item) return false;

            CinemaService.addCinema(vm.item).then(function ({
                data
            }) {
                if (data) {
                    alert("Item agregado correctamente")
                    vm.getCinema();
                }
            }).catch(function (error) {
                console.log(error)
            });
        }

        function setQualification(idCinema) {

            if (!vm.qualification) return false;
            
            CinemaService.setQualification(idCinema, vm.qualification).then(function (resp) {
                alert("Calificacion asignada correctamente")
                console.log(resp)
                vm.getCinema();
            }).catch(function (error) {
                console.log(error)
            });

        }

    }

}());