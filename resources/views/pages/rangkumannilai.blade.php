
@extends('layouts.dashboard')
<!-- Content Header (Page header) -->
@push('sectionheader')
<section class="content-header">
   <h1>
   Rangkuman Nilai
   <small>Rangkuman Nilai</small>
   </h1>
   <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       <li class="active">Rangkuman Nilai</li>
   </ol>
</section>
@endpush
@section('content')
    <div class="box box-primary" ng-app="rangkumannilaiapp">
    <div ng-controller="rangkumannilaictrl">
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
                    <h4 class="modal-title">Input Data Nilai</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama:</label>
                        <angucomplete-alt id="ex1"
                        ng-model="testing"
                        input-name="testing"
                        placeholder="Cari Nama Siswa"
                        pause="100"
                        selected-object="id"
                        image-field="foto"
                        local-data="datakelas"
                        search-fields="nama"
                        title-field="nama"
                        minlength="1"
                        input-class="form-control form-control-small"
                        matchclass="highlight"/>
                    </div>
                    <div class="form-group">
                        <label>Nilai rata-rata Tugas:</label>
                        <input type="text" class="form-control" ng-model="tugas">
                    </div>
                    <div class="form-group">
                        <label>Nilai rata-rata ulangan harian:</label>
                        <input type="text" class="form-control" ng-model="harian">
                    </div>
                    <div class="form-group">
                        <label>Nilai UTS:</label>
                        <input type="text" class="form-control" ng-model="uts">
                    </div>
                    <div class="form-group">
                        <label>Nilai UKK:</label>
                        <input type="text" class="form-control" ng-model="ukk" ng-blur="sumIs()">
                    </div>
                    <div class="form-group">
                        <label>Total Nilai:</label>
                        <input type="text" class="form-control" ng-model="totalnilai" value="ukk"disabled>
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
                    <h4 class="modal-title">Ubah Data Nilai</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" ng-model="nama">
                    </div>
                    <div class="form-group">
                        <label>Nilai rata-rata Tugas:</label>
                        <input type="text" class="form-control" ng-model="tugas">
                    </div>
                    <div class="form-group">
                        <label>Nilai rata-rata ulangan harian:</label>
                        <input type="text" class="form-control" ng-model="harian">
                    </div>
                    <div class="form-group">
                        <label>Nilai UTS:</label>
                        <input type="text" class="form-control" ng-model="uts">
                    </div>
                    <div class="form-group">
                        <label>Nilai UKK:</label>
                        <input type="text" class="form-control" ng-model="ukk">
                    </div>
                    <div class="form-group">
                        <label>Total Nilai:</label>
                        <input type="text" class="form-control" ng-model="total" value="@{{ukk}}"disabled>
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
                    <th>Kelas</th>
                    <th>Total Nilai</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.nama}}</td>
                        <td>@{{item.kelas}}</td>
                        <td>@{{item.totalnilai}}</td>
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
    var app = angular.module('rangkumannilaiapp',['ngFileUpload','angucomplete-alt']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getdatarangkuman = function() {
    return $http({
            url: "/api/rangkumannilai",
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
    crudFactory.createdata = function (Company) {
    return $http({
            url: '/api/rangkumannilai',
            method: 'POST',
            data : Company
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
    app.controller('rangkumannilaictrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
        var deferred =  $q.defer();
        $scope.getdatakelas = function(){
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
            crudAPIFactory.getdatarangkuman().then(function(res){
                deferred.resolve($scope.data = res.data);
            },function(err){
                deferred.reject(err);
            })
        }
        $scope.getdata();
        $scope.getdatakelas();
        $scope.sumIs = function(){
            $scope.totalnilai = parseInt($scope.uts) + parseInt($scope.ukk) + parseInt($scope.harian) + parseInt($scope.tugas)/4;
            console.log();
        }
        $scope.simpan = function(){
            let data = {"idsiswa":$scope.id.originalObject.id,"tugas":$scope.tugas,"harian":$Scope.harian,"uts":$scope.uts,"ukk":$scope.ukk}
            crudAPIFactory.createdata(data).then(function(){
                deferred.resolve($scope.getdatarangkuman())
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