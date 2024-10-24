@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Student')

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
    $(function(){
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
  @include('content/admin/teacher/add')
@endsection
