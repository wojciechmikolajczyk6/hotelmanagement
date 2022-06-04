@extends('layout')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>
    @if(Session::has('success'))
        <p class="text-primary text-center">{{session('success')}}</p>
@endif


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Usługi:
                    <a href="/admin/services/create" class="btn btn-success float-right">Dodaj nową usługę: </a></h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nazwa usługi</th>
                            <th>Opis</th>
                            <th>zdjęcie</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nazwa usługi</th>
                            <th>Opis</th>
                            <th>zdjęcie</th>
                            <th></th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if($data)
                            @foreach ($data as $service)
                        <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->title}}</td>
                            <td>{{$service->desc}}</td>
                            <td><img src="{{ asset('storage/'.$service->photo)}}" width="120px" hight="120px" alt=""></td>
                            <td>
                                <a href="{{'/admin/services/'.$service->id}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{'/admin/services/'.$service->id.'/edit'}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('jestes pewny, ze chcesz usunac usługę?')" href="{{'/admin/services/'.$service->id.'/delete'}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                            @endforeach
                            @endif
                        </tbody>
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
