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
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj pokój
                        <a href="/admin/rooms/" class="btn btn-success float-right">Wroc na poprzednia strone</a></h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" action="/admin/room/{{$data->id}}">
                            @csrf
                            @method('put')
                            <table class="table table-bordered">
                                <tr>
                                    <th>tytul</th>
                                    <td><input value="{{$data->title}}" type="text" name="title" class="form-control"/></td>
                                </tr>
                                <th>Typ pokoju</th>
                                <td>
                                    <select name="room_type_id" class="form-control">
                                        <option value="0">{{$data->roomtype->title}}</option>
                                        @foreach($roomtypes as $roomtype)
                                            <option value="{{$roomtype->id}}">{{$roomtype->title}}</option>
                                        @endforeach
                                    </select>
                                </td>
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

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/datatables-demo.js"></script>
@endsection
