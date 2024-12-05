
@extends('layouts/contentNavbarLayout')

@section('title', 'Admin - Reviews')

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
        <script>
            $(document).ready( function () {
                $('#tblReview').DataTable();
                });
        </script>
@endsection
@section('content')
 <div class="col-12 col-lg-12 order-2 order-md-12 order-lg-12 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
          <div class="col-md-12">
            <div class="card-header">
                    <div class="row mb-12">
                        <div class="text-end mb-12">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeacher">
                                <i class='bx bxs-message-square-add'></i> &nbsp; Add
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table table-hover" id="tblReview" >
                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Category</th>
                                <th>Teacher</th>
                                <th>Review</th>
                                <th>Ratings</th>
                                <th>Date Posted</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{$review->ClassSchedule->course->name}}</td>
                                    <td>{{$review->ClassSchedule->category->name}}</td>
                                    <td>{{$review->ClassSchedule->user->fname}} {{$review->ClassSchedule->user->lname}} </td>
                                    <td>{{$review->comments}}</td>
                                    <td>
                                        @for($i = 1; $i<=$review->star_rating; $i++)
                                            ★ 
                                        @endfor
                                    </td>
                                    <td>{{date('F d, Y', strtotime($review->created_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
           </div>
      </div>
    </div>
</div>
@endsection
