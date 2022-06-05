@extends('layout')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if(Session::has('success'))
        <p class="text-primary text-center">{{session('success')}}</p>
@endif


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Dostępne rodzaje pokojów w bazie danych:
                    <a href="/admin/rooms/create" class="btn btn-success float-right">Dodaj nowy pokoj</a></h6>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nazwa</th>
                            <th>Cena</th>
                            <th>Galeria</th>
                            <th>Akcja</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nazwa</th>
                            <th>Cena</th>
                            <th>Galeria</th>
                            <th>Akcja</th>

                        </tr>
                        </tfoot>
                        <tbody>
                        @if($data)
                            @foreach ($data as $room)
                        <tr>
                            <td>{{$room->id}}</td>
                            <td>{{$room->title}}</td>
                            <td>{{$room->price}}</td>
                            <td>{{count($room->roomimgs)}}</td>
                            <td>
                                <a href="{{'/admin/rooms/'.$room->id}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{'/admin/rooms/'.$room->id.'/edit'}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('jesteś pewny, że chcesz usunąć pokój z systemu?')" href="{{'/admin/rooms/'.$room->id.'/delete'}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
