@extends('layout')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->


        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Dodaj nowego pracownika
                        <a href="/admin/employee/" class="btn btn-success float-right">Wróć na poprzednią strone</a></h6>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <p class="text-primary text-center">{{session('success')}}</p>
                    @endif
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data" action="/admin/employee">
                        @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>Imie i nazwwisko:</th>
                                <td><input type="text" name="full_name" class="form-control"/></td>
                            </tr>
                            <tr>
                                <th>Nazwa uzytkownika:</th>
                                <td><input type="text" name="username" class="form-control"/></td>
                            </tr>
                            <tr>
                                <th>Zdjęcie pracownika:</th>
                                <td><input type="file" name="photo"/></td>
                            </tr>
                            <tr>
                                <th>Haslo <span>*</span></th>
                                <td><input type="password" name="password" class="form-control"/></td>
                            </tr>
                            <tr>
                                <th>Pensja:</th>
                                <td><input type="number" name="salary" class="form-control"/></td>
                            </tr>

                            <tr>
                                <th>Wybierz dział pracownika</th>
                                <td>
                                    <select name="department_id" class="form-control">
                                        <option value="0">---- Wybierz ----</option>
                                        @foreach($departements as $departement)
                                            <option value="{{$departement->id}}">{{$departement->title}}</option>
                                        @endforeach
                                    </select>
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
