 <!-- Content Header (Page header) -->
 @push('sectionheader')
 <section class="content-header">
    <h1>
    Users Guru
    <small>Users Guru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users Guru</li>
    </ol>
</section>
@endpush
@extends('layouts.dashboard')
@section('content')
    <div class="box box-primary" ng-app="userapp">
    <div ng-controller="userctrl">
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
                    <h4 class="modal-title">Input Data Users</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" ng-model="email">
                    </div>
                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" ng-model="password">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telpon:</label>
                        <input type="text" class="form-control" ng-model="nomortelpon">
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" ng-model="fullname">
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
                    <h4 class="modal-title">Ubah Data User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                    <label>Email:</label>
                        <input type="text" class="form-control" ng-model="email">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telpon:</label>
                        <input type="text" class="form-control" ng-model="nomortelpon">
                    </div>
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" ng-model="fullname">
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
                    <th>Email</th>
                    <th>Nomor Telpon</th>
                    <th>Nama</th>
                    <th>Nama Sekolah</th>
                    <th>Level </th>
                    <th>Status </th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.email}}</td>
                        <td>@{{item.nomortelpon}}</td>
                        <td>@{{item.name}}</td>
                        <td>@{{item.namasekolah}}</td>
                        <td>@{{item.status}}</td>
                        <td><span class="label label-success"  ng-show="item.statusactive == 'active'">@{{item.statusactive}}</span><span class="label label-danger"  ng-show="item.statusactive == 'blocked'">@{{item.statusactive}}</span><span class="label label-warning"  ng-show="item.statusactive == 'new'">pending</span></td>
                        <td>
                            <button class="btn btn-success" ng-click="activate(item)" ng-disabled="item.statusactive =='active' || item.statusactive =='blocked'"><i class="fa fa-check"></i>Activate</button> 
                            <button class="btn btn-danger" ng-click="hapus(item)" ng-disabled="item.statusactive =='blocked'"><i class="fa fa-user-times"></i> Blocked</button>
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
    var app = angular.module('userapp',['ngFileUpload']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getCompanyList = function() {
    return $http({
            url: "/api/users",
            method: 'GET'
            });
    };

    //Insert new Company.
    crudFactory.createdata = function (Company) {
    return $http({
            url: '/api/users',
            method: 'POST',
            data : Company
        });
    };

    //Get Company.
    crudFactory.changestatus = function (Company) {
    return  $http({
        url: "/api/users/changestatus",
        method: 'POST',
        data:Company
    });
    };

    //Update Company.
    crudFactory.updateCompany = function (Company,id) {
        return  $http({
            url: '/api/users/'+id,
            method: 'PUT',
            data : Company,
        });
        };

    //Delete Company.
    crudFactory.deleteSiswa = function (Company) {
    return  $http({
            url: '/api/users/'+ Company.id,
            method: 'DELETE',
        });
    };    

    return crudFactory;
    });
    app.controller('userctrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
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
            let data = {"nama":$scope.fullname,"kode_sekolah":"1", "email":$scope.email,"password":$scope.password,"nomortelpon":$scope.nomortelpon}
            crudAPIFactory.createdata(data).then(function(){
                deferred.resolve($scope.getdata())
            },function(){
                deferred.reject()
            })
        }
        $scope.hapus = function(item){
            //console.log(item);
            swal({
                    title: "Apakah anda yakin block user ini?",
                    text: "sekali anda block, anda tidak dapat mengaktivasi lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        let data = {"statusactive":"blocked","id":item.id}
                        crudAPIFactory.changestatus(data).then(function(){
                            swal("User sukses di block!", {
                                icon: "success",
                            });
                            deferred.resolve($scope.getdata())
                        },function(err){
                            deferred.reject(err);
                        })
                        return deferred.promise;
                    } else {
                       return false;
                    }
                });
        }
        $scope.activate = function(item){
            let data = {"statusactive":"active","id":item.id}
            crudAPIFactory.changestatus(data).then(function(){
                deferred.resolve($scope.getdata())
            },function(err){
                deferred.reject(err);
            })
            return deferred.promise;
        }
        $scope.edit = function(item){
            $scope.fullname = item.name;
            $scope.email = item.email;
            $scope.nomortelpon = item.nomortelpon;
            $scope.id = item.id;
        }
        $scope.actionedit = function(){
            var id = $scope.id;
            let data = {"nama":$scope.fullname,"email":$scope.email,"nomortelpon":$scope.nomortelpon}
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
