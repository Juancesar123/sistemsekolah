
@extends('layouts.dashboard')
<!-- Content Header (Page header) -->
@push('sectionheader')
<section class="content-header">
   <h1>
   Rekap Absen
   <small>Rekap Absen</small>
   </h1>
   <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Rekap Absen</li>
   </ol>
</section>
@endpush
@section('content')
    <div class="box box-primary" ng-app="rekapabsenapp">
    <div ng-controller="rekapabsensctrl">
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
                    <h4 class="modal-title">Rekap Absen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama:</label>
                        <angucomplete-alt id="ex1"
                        ng-model="testing"
                        input-name="testing"
                        placeholder="Cari Nama Siswa"
                        pause="100"
                        selected-object="nama"
                        image-field="foto"
                        local-data="datakelas"
                        search-fields="nama"
                        title-field="nama"
                        minlength="1"
                        input-class="form-control form-control-small"
                        matchclass="highlight"/>
                    </div>
                    <div class="form-group">
                        <label>Ijin:</label>
                        <input type="text" class="form-control" ng-model="ijin">
                    </div>
                    <div class="form-group">
                        <label>Sakit:</label>
                        <input type="text" class="form-control" ng-model="sakit">
                    </div>
                    <div class="form-group">
                        <label>Alfa:</label>
                        <input type="text" class="form-control" ng-model="alfa">
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
                    <h4 class="modal-title">Ubah Data Absensi</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama:</label>
                        <angucomplete-alt id="ex1"
                        ng-model="testing"
                        input-name="testing"
                        placeholder="Cari Nama Siswa"
                        pause="100"
                        selected-object="nama"
                        image-field="foto"
                        local-data="datakelas"
                        search-fields="nama"
                        title-field="nama"
                        minlength="1"
                        input-class="form-control form-control-small"
                        matchclass="highlight"/>
                    </div>
                    <div class="form-group">
                        <label>Ijin:</label>
                        <input type="text" class="form-control" ng-model="ijin">
                    </div>
                    <div class="form-group">
                        <label>Sakit:</label>
                        <input type="text" class="form-control" ng-model="sakit">
                    </div>
                    <div class="form-group">
                        <label>Alfa:</label>
                        <input type="text" class="form-control" ng-model="alfa">
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
                    <th>Nama</th>
                    <th>Alfa</th>
                    <th>Ijin</th>
                    <th>Sakit</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.idsiswa}}</td>
                        <td>@{{item.alfa}}</td>
                        <td>@{{item.ijin}}</td>
                        <td>@{{item.sakit}}</td>
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
    var app = angular.module('rekapabsenapp',['ngFileUpload','angucomplete-alt']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getdataRekapabsen = function() {
    return $http({
            url: "/api/rekapabsen",
            method: 'GET'
            });
    };
    crudFactory.getDataSiswa = function() {
    return $http({
            url: "/api/siswa",
            method: 'GET'
            });
    };

    //Insert new Company.
    crudFactory.createRekapabsen = function (data) {
    return $http({
            url: '/api/rekapabsen',
            method: 'POST',
            data : data
        });
    };

    //Update Company.
    crudFactory.updateRekapabsen = function (data,id) {
        return  $http({
            url: '/api/rekapabsen/'+id,
            method: 'PUT',
            data : data,
        });
        };

    //Delete Company.
    crudFactory.deleteRekapabsen = function (Company) {
    return  $http({
            url: '/api/rekapabsen/'+ Company.id,
            method: 'DELETE',
        });
    };    

    return crudFactory;
    });
    app.controller('rekapabsensctrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
        var deferred =  $q.defer();
        $scope.getdatasiswa = function(){
            $scope.datakelas = []
            crudAPIFactory.getDataSiswa().then(function(res){
                res.data.forEach(element => {
                    $scope.datakelas.push({"nama":element.nama,"foto":"{{env('API_URL')}}/" + element.foto,"id":element.id})
                });
                //console.log($scope.datakelas);
            },function(res){
                deferred.reject(res);
            });
            return deferred.promise;
        }
        $scope.getdata = function(){
            crudAPIFactory.getdataRekapabsen().then(function(res){
                deferred.resolve($scope.data = res.data);
            },function(err){
                deferred.reject(err);
            })
        }
        $scope.getdata();
        $scope.getdatasiswa();
        $scope.simpan = function(){
            let data = {"idsiswa":$scope.nama.originalObject.id,"ijin":$scope.ijin,"sakit":$scope.sakit,"alfa":$scope.alfa}
            crudAPIFactory.createRekapabsen(data).then(function(){
                deferred.resolve($scope.getdata())
            },function(){
                deferred.reject()
            })
        }
        $scope.hapus = function(item){
            //console.log(item);
            crudAPIFactory.deleteRekapabsen(item).then(function(){
                deferred.resolve($scope.getdata())
            },function(err){
                deferred.reject(err);
            })
            return deferred.promise;
        }
        $scope.edit = function(item){
            $scope.nama = item.idsiswa;
            $scope.ijin = item.ijin;
            $scope.sakit = item.sakit;
            $scope.alfa = item.alfa;
            $scope.id = item.id;
        }
        $scope.actionedit = function(){
            var id = $scope.id;
            let data = {"idsiswa":$scope.nama.originalObject.id,"ijin":$scope.ijin,"sakit":$scope.sakit,"alfa":$scope.alfa}
            crudAPIFactory.updateRekapabsen(data,id).then(function(res){
                deferred.resolve($scope.getdata())
            },function(res){
                deferred.reject(res);
            })
            return deferred.promise;
        }
    });
    
 </script>
@endpush