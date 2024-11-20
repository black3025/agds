@extends('layouts/contentNavbarLayout')

@section('title', 'Admin')


@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
        $('#tblUser').DataTable();
        });
    </script>
    
  <script>
      
  </script>
@endsection

@section('content')
 <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">

          <div class="col-md-12">
            <div class="card mb-10">
                <div class="card-body pt-0">
                <br><br>
                  <table class="table table-hover" id="tblUser" >
                        <thead>
                            <tr>
                                <th>Full name</th>
                                <th>Email Address</th>
                                <th>Username</th>
                                <th>Account Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->fname}} {{$user->mname}} {{$user->lname}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td>@if($user->is_active == 1) <span class="text-success">Active</span>@else <span class="text-danger">Inactive</span>@endif</td>
                                    <td>
                                        <a onclick="setUserId({{$user->id}})" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            <i class='bx bx-edit-alt'></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>    
      </div>
    </div>
  </div>
@endsection
