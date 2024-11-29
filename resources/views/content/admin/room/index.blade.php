@extends('layouts/contentNavbarLayout')

@section('title', 'Admin')

@section('page-script')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    <script>
    function setsUroom(room)
    {
        $('#editRoom').trigger("reset");
        $('#editRoom').find('span.error-text').text('');
        $('#e_id').val(room['id']);
        $('#e_name').val(room['name']);
        $('#e_capacity').val(room['capacity']);
    }
    $(function(){
      $('#addRoomForm').on('submit', function(e){
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
                            fetchAllRooms();
                        }

                    }

                })
        });

        $('#editRoom').on('submit', function(e){
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
                            fetchAllRooms();
                        }

                    }

                })
        });
        fetchAllRooms();
        function fetchAllRooms(){
            $.get('{{route("getRoom")}}',{},function(data){
                $('#all_room').html(data.result);
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
                <div class="card mb-10" id="all_room">
        
                </div>
           </div>
      </div>
    </div>
</div>
@include('content/admin/room/update')
@include('content/admin/room/add')
@endsection
