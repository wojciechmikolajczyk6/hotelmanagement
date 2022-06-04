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
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj serwis
                        <a href="/admin/services/" class="btn btn-success float-right">Wroc na poprzednia strone</a></h6>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-primary text-danger">{{$error}}</p>
                        @endforeach
                    @endif
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data" action="/admin/services">
                            @csrf
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nazwa serwisu<span>*</span></th>
                                    <td><input type="text" name="title" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Streszczenie opisu <span>*</span></th>
                                    <td><input type="text" name="desc" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Pelen opis <span>*</span></th>
                                    <td><input type="text" name="full_desc" class="form-control"/></td>
                                </tr>
                                <tr>
                                    <th>Zdjecie</th>
                                    <td><input type="file" name="photo"/></td>
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
