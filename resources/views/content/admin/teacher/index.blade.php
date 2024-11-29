@extends('layouts/contentNavbarLayout')

@section('title', 'Admin')

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>

    function setsUTeacher(teacher)
    {
        $('#editTeacherForm').trigger("reset");
        $('#editTeacherForm').find('span.error-text').text('');
        $('#edit_uid').val(teacher['user']['id']);
        $('#edit_tid').val(teacher['id']);
        $('#edit_fname').val(teacher['user']['fname']);
        $('#edit_mname').val(teacher['user']['mname']);
        $('#edit_lname').val(teacher['user']['lname']);
        $('#edit_bday').val(teacher['user']['birthday']);
        $('#edit_email').val(teacher['user']['email']);
        
        myArray = teacher['mastery'].split("|");
    

        myArray.forEach(function(item){
            id = '#edit_' + item;
            $(id).prop("checked",true);
        })
    
    }

    $(function(){
    $('#editTeacherForm').on('submit', function(e){
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
                            $('#mdaclosebutton2').click();
                            $(form)[0].reset();
                            success(data.msg);
                            fetchAllTeachers();
                        }

                    }

                })
        });
      $('#addTeacherForm').on('submit', function(e){
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
                            fetchAllTeachers();
                        }

                    }

                })
        });
        fetchAllTeachers();
        function fetchAllTeachers(){
            $.get('{{route("getTeacher")}}',{},function(data){
                $('#all_teacher').html(data.result);
            },'json');
        }

          

    })
   
    </script>
@endsection

@section('content')
<div class="col-12 col-lg-12 order-2 order-md-12 order-lg-12 mb-4">
    <div class="card">
      <div class="row row-bordered g-0">
          <div class="col-md-12">
                <div class="card mb-10" id="all_teacher">
        
                </div>
           </div>
      </div>
    </div>
</div>
@include('content/admin/teacher/update')
@include('content/admin/teacher/add')

@endsection
