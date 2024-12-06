<script>
    $(document).ready( function () {
            $('#tblPost').DataTable();
        });
</script>

<div class="card-header">
   
</div>
<div class="card-body pt-0">
    <table class="table table-hover" id="tblPost" >
        <thead>
            <tr>
                <th style="text-align:center;">Post ID</th>
                <th style="text-align:center;">Content</th>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Date Posted</th>
                {{-- <th style="text-align:center;">Action</th> --}}
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach($posts as $post)
                    <tr style="text-align:center;">
                        <td>{{$post->id}}</td>
                        <td>{{$post->content}}</td>
                        <td>
                            @if($post->pic =="")
                                <---No uploaded Picture-->
                            @else
                                 <img class="card-img-top" src={{asset('storage/post_pic/' .$post->pic) }}  class="d-block w-px-50 h-px-50 rounded" alt="{{$post->pic}}">
                            @endif
                        </td>
                        <td>
                            {{date('F d, Y', strtotime($post->created_at))}}
                        </td>
                        {{-- <td><a onclick="" href="#"><i class='bx bx-check-circle' ></i></a> | <a href='#'><i class='bx bxs-x-circle'></i></a></td> --}}
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>