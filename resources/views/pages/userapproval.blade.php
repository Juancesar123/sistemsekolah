 <!-- Content Header (Page header) -->
 @push('sectionheader')
 <section class="content-header">
    <h1>
    Users Siswa
    <small>Users</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users Siswa</li>
    </ol>
</section>
@endpush
@extends('layouts.dashboard')
@section('content')
    <div class="box box-primary" ng-app="userapp">
    <div ng-controller="userctrl">
        <div class="box-header">
        </div>
        <div class="box-body">
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
                        <td>
                            <span class="label label-success"  ng-show="item.statusactive == 'active'">@{{item.statusactive}}</span>
                            <span class="label label-danger"  ng-show="item.statusactive == 'disapprove'">@{{item.statusactive}}</span>
                            <span class="label label-primary"  ng-show="item.statusactive == 'new'">@{{item.statusactive}}</span></td>
                        <td>
                            <button class="btn btn-success" ng-click="approve(item)" ng-disabled="item.statusactive == 'active'|| item.statusactive =='disapprove'"><i class="fa fa-check"></i>Approve</button> 
                            <button class="btn btn-danger" ng-click="disapprove(item)" ng-disabled="item.statusactive =='disapprove'"><i class="fa fa-times"></i> Dissapprove</button>
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
            url: "/users/statussiswa",
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
        url: "api/users/changestatus",
        method: 'POST',
        data : Company
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
    crudFactory.deleteSiswa = function (data,Company) {
    return  $http({
            url: '/api/users/'+ Company.id,
            method: 'DELETE',
            data:data
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
        $scope.approve = function(item){
            //console.log(item);
            let data = {"statusactive":'active',"id":item.id}
            crudAPIFactory.changestatus(data).then(function(){
                deferred.resolve($scope.getdata())
            },function(err){
                deferred.reject(err);
            })
            return deferred.promise;
        }
        $scope.disapprove = function(item){
            //console.log(item);
            swal({
                    title: "Apakah kamu yakin tidak menyetujui ini?",
                    text: "Sekali anda tidak menyetujui, anda tidak akan bisa menyetujui lagi!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {            
                        let data = {"statusactive":'disapprove',"id":item.id}
                        crudAPIFactory.changestatus(data).then(function(){
                            swal("Status Sukses di Ubah", {
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
