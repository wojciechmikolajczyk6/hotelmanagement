@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj typ pokoju
                        <a href="/admin/rooms/" class="btn btn-success float-right">Wroc na poprzednia strone</a></h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data" action="/admin/rooms/{{$data->id}}">
                            @csrf
                            @method('put')
                            <table class="table table-bordered">
                                <tr>
                                    <th>tytul</th>
                                    <td><input value="{{$data->title}}" type="text" name="title" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>detale pokoju</th>
                                    <td><textarea  class="form-control" name="details">{{$data->details}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>Galeria</td>
                                    <td>
                                        <table class="mt-4"table table-bordered mt-4">
                                            <tr>
                                                <input type="file" multiple name="images[]" />
                                                @foreach($data->roomimgs as $img)
                                                    <td class="imgcol{{$img->id}}"><img width="120px" height="120px" src="{{ asset('storage/'.$img->image_path)}}"/>
    <p class="mt-2">
    <button type="button" onclick="return confirm('Jesteś pewny, że chcesz usunąć zdjęcie?')" class="mt-2 btn btn-danger delete-image" data-image-id="{{$img->id}}">Usuń zdjęcie</button>
     </p>
                                                    </td>
                                                    @endforeach
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <th>cena za dobe</th>
                                    <td><input value="{{$data->price}}" type="number" name="price" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <input name='submit' type="submit" class="btn btn-primary"/>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->





    </div>
    <!-- /.container-fluid -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $(".delete-image").on('click', function(){
            var _img_id=$(this).attr('data-image-id');
            var _vm=$(this);
            $.ajax({
                url:'{{url('/admin/roomimage/delete')}}/' +_img_id,
                dataType: 'json',
                beforeSend:function(){
                    _vm.addClass('disabled');

                },
                success:function(res){
                    console.log(res);
                    if (res.bool==true){
                        $(".imgcol"+_img_id).remove();
                        _vm.removeClass('disabled');
                    }

                }

            });

        });
    });

</script>




{{--    <!-- Bootstrap core JavaScript-->--}}
{{--    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>--}}

{{--    <!-- Core plugin JavaScript-->--}}
{{--    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>--}}

{{--    <!-- Custom scripts for all pages-->--}}
{{--    <script src="/js/sb-admin-2.min.js"></script>--}}

{{--    <!-- Page level plugins -->--}}
{{--    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>--}}
{{--    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>--}}

{{--    <!-- Page level custom scripts -->--}}
{{--    <script src="/js/demo/datatables-demo.js"></script>--}}
@endsection
