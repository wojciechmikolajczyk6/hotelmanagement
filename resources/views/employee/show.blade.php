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
                    <h6 class="m-0 font-weight-bold text-primary"> {{$data->full_name}}
                        <a href="/admin/employee/" class="btn btn-success float-right">Wroc na poprzednia strone</a></h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                            <table class="table table-bordered">
                                <tr>
                                    <th>Imie i nazwisko</th>
                                    <td>{{$data->full_name}}</td>
                                </tr>
                                <tr>
                                    <th>zdjecie</th>
                                    <td><img src="{{ asset('storage/'.$data->photo)}}" width="120px" hight="120px" alt=""></td>
                                </tr>
                                <tr>
                                    <th>dział</th>
                                    <td>{{$data->department->title}}</td>
                                </tr>
                                <tr>
                                    <th>bio</th>
                                    <td>{{$data->bio}}</td>
                                </tr>
                                <tr>
                                    <th>Pensja</th>
                                    <td>{{$data->salary}}</td>
                                </tr>
                            </table>

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
