 <!-- Content Header (Page header) -->
 @push('sectionheader')
 <section class="content-header">
    <h1>
    Kelas
    <small>Kelas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelas</li>
    </ol>
</section>
@endpush
@extends('layouts.dashboard')
@section('content')
    <div class="box box-primary" ng-app="kelasapp">
    <div ng-controller="kelasctrl">
        <div class="box-header">
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Data</button>
        </div>
        <div class="box-body">
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Input Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kelas:</label>
                        <input type="text" class="form-control" ng-model="kelas">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" ng-click="simpan()"><i class="fa fa-send"></i> Submit </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
                </div>

            </div>
        </div>
        <div id="myModal1" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ubah Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kelas:</label>
                        <input type="text" class="form-control" ng-model="kelas">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" ng-click="actionedit()"><i class="fa fa-send"></i> Submit </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
                </div>
            </div>
        </div>
            <table class="table bordered-stripped">
                <thead>
                    <th>Kelas</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.kelas}}</td>
                        <td>
                            <button class="btn btn-success" ng-click="edit(item)" data-target="#myModal1" data-toggle="modal"><i class="fa fa-edit"></i>Ubah</button> 
                            <button class="btn btn-danger" ng-click="hapus(item)"><i class="fa fa-trash"></i>Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection
@push('angularscript')
 <script>
    var app = angular.module('kelasapp',['ngFileUpload']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getCompanyList = function() {
    return $http({
            url: "/api/kelas",
            method: 'GET'
            });
    };

    //Insert new Company.
    crudFactory.createdata = function (Company) {
    return $http({
            url: '/api/kelas',
            method: 'POST',
            data : Company
        });
    };

    //Get Company.
    crudFactory.getCompany = function (Company) {
    return  $http({
        url: "http://localhost:8080/SpringMavenRestDemoService/getcompany/" + Company.id,
        method: 'GET',
    });
    };

    //Update Company.
    crudFactory.updateCompany = function (Company,id) {
        return  $http({
            url: '/api/kelas/'+id,
            method: 'PUT',
            data : Company,
        });
        };

    //Delete Company.
    crudFactory.deleteSiswa = function (Company) {
    return  $http({
            url: '/api/kelas/'+ Company.id,
            method: 'DELETE',
        });
    };    

    return crudFactory;
    });
    app.controller('kelasctrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
        var deferred =  $q.defer();
        $scope.getdata = function(){
            crudAPIFactory.getCompanyList().then(function(res){
                deferred.resolve($scope.data = res.data);
            },function(res){
                deferred.reject(res);
            });
            return deferred.promise;
        }
        $scope.getdata();
        $scope.simpan = function(){
            let data = {"kelas":$scope.kelas,"idsekolah":"1"}
            crudAPIFactory.createdata(data).then(function(){
                deferred.resolve($scope.getdata())
            },function(){
                deferred.reject()
            })
        }
        $scope.hapus = function(item){
            //console.log(item);
            crudAPIFactory.deleteSiswa(item).then(function(){
                deferred.resolve($scope.getdata())
            },function(err){
                deferred.reject(err);
            })
            return deferred.promise;
        }
        $scope.edit = function(item){
            $scope.kelas = item.kelas;
            $scope.id = item.id;
        }
        $scope.actionedit = function(){
            var id = $scope.id;
            let data = {"kelas":$scope.kelas,"idsekolah":"1"}
            crudAPIFactory.updateCompany(data,id).then(function(res){
                deferred.resolve($scope.getdata())
            },function(res){
                deferred.reject(res);
            })
            return deferred.promise;
        }
    });
    
 </script>
@endpush
