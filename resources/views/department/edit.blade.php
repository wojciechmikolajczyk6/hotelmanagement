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
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj nowy dział
                        <a href="/admin/department/" class="btn btn-success float-right">Wroc na poprzednia strone</a></h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" action="/admin/department/{{$data->id}}">
                            @csrf
                            @method('put')

                            <table class="table table-bordered">
                                <tr>
                                    <th>tytul</th>
                                    <td><input type="text" value="{{$data->title}}" name="title" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>szczegoly dzialu</th>
                                    <td>
                                        <textarea name="details" class="form-control"> {{$data->details}}</textarea>
                                    </td>
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
