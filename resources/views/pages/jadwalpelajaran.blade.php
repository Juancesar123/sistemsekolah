 <!-- Content Header (Page header) -->
 @push('sectionheader')
 <section class="content-header">
    <h1>
    Jadwal Pelajaran
    <small>Jadwal Pelajaran</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Kelas</li>
    </ol>
</section>
@endpush
@extends('layouts.dashboard')
@section('content')
    <div class="box box-primary" ng-app="jadwalpelajaranapp">
    <div ng-controller="jadwalpelajaranctrl">
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
                    <h4 class="modal-title">Input Data jadwal pelajaran</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Matapelajaran:</label>
                        <input type="text" class="form-control" ng-model="matapelajaran">
                    </div>
                    <div class="form-group">
                        <label>Hari:</label>
                        <input type="text" class="form-control" ng-model="hari">
                    </div>
                    <div class="form-group">
                        <label>Jam Masuk:</label>
                        <input type="text" class="form-control" ng-model="jammasuk">
                    </div>
                    <div class="form-group">
                        <label>Jam Keluar:</label>
                        <input type="text" class="form-control" ng-model="jamkeluar">
                    </div>
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
                    <h4 class="modal-title">Ubah Data Jadwal Pelajaran</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Matapelajaran:</label>
                        <input type="text" class="form-control" ng-model="matapelajaran">
                    </div>
                    <div class="form-group">
                        <label>Hari:</label>
                        <input type="text" class="form-control" ng-model="hari">
                    </div>
                    <div class="form-group">
                        <label>Jam Masuk:</label>
                        <input type="text" class="form-control" ng-model="jammasuk">
                    </div>
                    <div class="form-group">
                        <label>Jam Keluar:</label>
                        <input type="text" class="form-control" ng-model="jamkeluar">
                    </div>
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
                    <th>Mata Pelajaran</th>
                    <th>Hari</th>
                    <th>Jam Mulai</th>
                    <th>Jam Selesai</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.matapelajaran}}</td>
                        <td>@{{item.hari}}</td>
                        <td>@{{item.jammulai}}</td>
                        <td>@{{item.jamselesai}}</td>
                        <td>@{{item.idkelas}}</td>
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
    var app = angular.module('jadwalpelajaranapp',['ngFileUpload']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getMatapelajaran = function() {
    return $http({
            url: "/api/matapelajaran",
            method: 'GET'
            });
    };

    //Insert new Company.
    crudFactory.createMatapelajaran = function (Company) {
    return $http({
            url: '/api/matapelajaran',
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
    crudFactory.updateMatapelajaran = function (Company,id) {
        return  $http({
            url: '/api/matapelajaran/'+id,
            method: 'PUT',
            data : Company,
        });
        };

    //Delete Company.
    crudFactory.deleteMatapelajaran = function (Company) {
    return  $http({
            url: '/api/matapelajaran/'+ Company.id,
            method: 'DELETE',
        });
    };    

    return crudFactory;
    });
    app.controller('jadwalpelajaranctrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
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
