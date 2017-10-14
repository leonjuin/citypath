(function () {
    'use strict';

    /**
     * PasswordChangeController
     */
    angular
            .module('app')
            .controller('PasswordChangeController', PasswordChangeController);

    PasswordChangeController.$inject = [
        '$timeout', '$scope', '$window', 'APP_CONFIG','$location', 
        '$routeParams', 'userService'
    ];

    function PasswordChangeController($timeout, $scope, $window, APP_CONFIG, $location, $routeParams, userService) {
        var vm = this,
            breadcrumbs = [{'name': 'Home'}, {'name': 'Change Password'}];
        vm.APP_CONFIG = APP_CONFIG;
        vm.change = change;

        vm.passwords = {
            old: '',
            new: '',
            newConfirm: ''
        };

        vm.model = {};

        activate();
   
        function activate(){
            $('body').removeClass("friends customers books sports setting");
            PIONEER_STORE.func.breadcrumb(breadcrumbs);
        }

        function change(passwords){
            PIONEER_STORE.func.alerror();
            if(!valid(passwords)){ return; }

            userService.changePassword(passwords.old, passwords.new).then(function (response) {
                alert('Successfully changed password');
                vm.passwords = {
                    old: '',
                    new: '',
                    newConfirm: ''
                };          
            }, function (error) {
                PIONEER_STORE.func.alerror(error);
            });            
        } 

       function valid(passwords){
            if(passwords.old == '' || passwords.new == '' || passwords.newConfirm == ''){ 
                return PIONEER_STORE.func.alerror('require-password');
            }
            if(passwords.old.length < 6 || passwords.new.length < 6 || passwords.newConfirm.length < 6){ 
                return PIONEER_STORE.func.alerror('invalid-password');
            }            
            if(passwords.new != passwords.newConfirm){ 
                return PIONEER_STORE.func.alerror('password-not-confirm');
            }

            PIONEER_STORE.func.alerror(false);
            return true;
        }  
    }
})();