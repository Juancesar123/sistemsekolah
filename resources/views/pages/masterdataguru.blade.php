 <!-- Content Header (Page header) -->
 @push('sectionheader')
 <section class="content-header">
    <h1>
    Guru
    <small>Guru</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Guru</li>
    </ol>
</section>
@endpush
@extends('layouts.dashboard')
@section('content')
    <div class="box box-primary" ng-app="guruapp">
    <div ng-controller="guructrl">
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
                    <h4 class="modal-title">Input Data Guru</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama:</label>
                        <input type="text" class="form-control" ng-model="nama">
                    </div>
                    <div class="form-group">
                        <label>Nomor Telpon:</label>
                        <input type="text" class="form-control" ng-model="nomortelpon">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <select class="form-control" ng-model="jeniskelamin">
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir:</label>
                        <input type="text" class="form-control" ng-model="tempatlahir">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir:</label>
                        <input type="date" class="form-control" ng-model="tanggallahir">
                    </div>
                    <div class="form-group">
                        <label>Alamat:</label>
                        <textarea class="form-control" ng-model="alamat"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto:</label>
                        <input type="file" ngf-select ng-model="picFile" name="file"    
                                accept="image/*" ngf-max-size="2MB" required
                                ngf-model-invalid="errorFile">
                        <i ng-show="myForm.file.$error.required">*required</i><br>
                        <i ng-show="myForm.file.$error.maxSize">File too large 
                            @{{errorFile.size / 1000000|number:1}}MB: max 2M</i>
                        <img ng-show="myForm.file.$valid" ngf-thumbnail="picFile" class="thumb" style="width:100px;height:100px">
                        <button class="btn btn-danger" ng-click="picFile = null" ng-show="picFile"><i class="fa fa-trash"></i> Remove</button>
                        <span class="progress" ng-show="picFile.progress >= 0">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:@{{picFile.progress}}%"  ng-bind="picFile.progress + '%'">
                        </div>
                        </span>
                        <span class="err" ng-show="errorMsg">@{{errorMsg}}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" ng-click="simpan(picFile)"><i class="fa fa-send"></i> Submit </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
                </div>

            </div>
        </div>
            <table class="table bordered-stripped">
                <thead>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Nomor Telpon</th>
                    <th>Foto</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <tr ng-repeat="item in data">
                        <td>@{{item.namaguru}}</td>
                        <td>@{{item.alamat}}</td>
                        <td>@{{item.jeniskelamin}}</td>
                        <td>@{{item.tempatlahir}}</td>
                        <td>@{{item.tanggallahir}}</td>
                        <td>@{{item.nomortelpon}}</td>
                        <td><img src="{{env('API_URL')}}/@{{item.foto}}" style="width:100px;height:100px"></td>
                        <td>
                            <button class="btn btn-success"><i class="fa fa-edit"></i>Ubah</button> 
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
    var app = angular.module('guruapp',['ngFileUpload']);
    app.factory('crudAPIFactory', function($http) {
    var crudFactory = {};

    //Get Company List
    crudFactory.getCompanyList = function() {
    return $http({
            url: "/api/guru",
            method: 'GET'
            });
    };

    //Insert new Company.
    crudFactory.createdata = function (Company) {
    return $http({
            url: '/api/guru',
            method: 'POST',
            data : Company
        });
    };

    //Get Company.
    crudFactory.getCompany = function (Company) {
    return  $http({
        url: "http://localhost:8080/SpringMavenRestDemoService/getcompany/" + Company.companyId,
        method: 'GET',
    });
    };

    //Update Company.
    crudFactory.updateCompany = function (Company) {
        return  $http({
            url: 'http://localhost:8080/SpringMavenRestDemoService/updatecompany/',
            method: 'POST',
            data : Company,
        });
        };

    //Delete Company.
    crudFactory.deleteSiswa = function (Company) {
    return  $http({
            url: '/api/guru/'+ Company.id,
            method: 'DELETE',
        });
    };    

    return crudFactory;
    });
    app.controller('guructrl',function($scope,$http,crudAPIFactory,$q,$timeout,Upload){
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
        $scope.simpan = function(file){
            console.log(file)
            file.upload = Upload.upload({
                url: '/api/guru',
                data: {
                        nama: $scope.nama, 
                        nomortelpon:$scope.nomortelpon,
                        tempatlahir:$scope.tempatlahir,
                        alamat:$scope.alamat,
                        tanggallahir:$scope.tanggallahir,
                        jeniskelamin:$scope.jeniskelamin,
                        file: file
                    },
            });
            file.upload.then(function (response) {
            $timeout(function () {
                file.result = response.data;
                swal("Good job!", "You clicked the button!", "success");
                file.progress = 0;
            });
                $scope.getdata();
            }, function (response) {
            if (response.status > 0)
                $scope.errorMsg = response.status + ': ' + response.data;
            }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
               
            });
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
     
    });
    
 </script>
@endpush
