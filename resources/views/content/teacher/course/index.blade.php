@extends('layouts/contentNavbarLayout')

@section('title', 'Courses')

@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
     <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#tblCourse').DataTable();
        });
    </script>
@endsection

@section('page-script')
    <script>
    function setss(course,img)
    {
        $('#editCourse').trigger("reset");
        $('#id').val(course['id']);
        $('#name').val(course['name']);
        $('#description').val(course['description']);
        $('#img_prev').attr('src',img);
        $('#editCourse').find('span.error-text').text('');
        if(course['is_active'] == 1){
                $('#is_active').prop("checked", true);
                $('#name').attr("disabled", false);
                $('#description').attr("disabled", false);
                $('#image_display').attr("disabled", false);
        }else{
                $('#is_active').prop("checked", false);
                $('#name').attr("disabled", true);
                $('#description').attr("disabled", true);
                $('#image_display').attr("disabled", true);
        }
        $origForm = $form.serialize();
    }

    function  toggleActive()  
    {
        
        if($('#is_active').is(":checked")){
            $('#name').attr("disabled", false);
            $('#description').attr("disabled", false);
            $('#image_display').attr("disabled", false);
            
        }else{
            $('#name').attr("disabled", true);
            $('#description').attr("disabled", true);
            $('#image_display').attr("disabled", true);
            
        }
    }
    $(function(){
        $('#editCourse').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.code==0){
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $('#mdclosebutton').click();
                        $(form)[0].reset();
                        success(data.msg);
                        fetchAllCourse();
                    }

                }

            })
        });
        $('#addCourse').on('submit', function(e){
            e.preventDefault();
            var form = this;
            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.code==0){
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    }else{
                        $('#mdaclosebutton').click();
                        $(form)[0].reset();
                        success(data.msg);
                        fetchAllCourse();
                    }

                }

            })
        });
        //Fetch Course
        fetchAllCourse();
        function fetchAllCourse(){
            $.get('{{route("getCourse")}}',{},function(data){
                $('#my_course').html(data.result);
            },'json');
        }
    })
    </script>
@endsection

@section('content')  
<div class="container-xxl flex-grow-1 container-p-y">
        <div class="row mb-10">
            <div class="col col-8"><h5 class="pb-1 mb-6">My Courses</h5></div>
            {{-- <div class="col col-4 text-end mb-10"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCourseModal"><i class='bx bxs-message-square-add'></i>&nbsp; Add</button></div> --}}
        </div>
        <br>
    <div class="row mt-12 mb-12 g-6" id="my_course">
       
        
    </div>
    
</div>
@include('content/admin/course/update')
@include('content/admin/course/add')
@endsection
