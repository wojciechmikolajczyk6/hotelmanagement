
@extends('frontlayout')
@section('content')

    @if(!Session('data'))
        <script type="text/javascript">

            window.location.href = '/login';
        </script>
    @endif
    @if(Session('data')[0]->active == '1')
        <script type="text/javascript">
            window.location.href = '/';
        </script>
    @endif


    <p>Musisz wpisac kod aktywacyjny w celu potwierdzenie założenia konta {{Session('data')[0]->activation_code}}</p>
    <div class="table-responsive">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-primary text-danger">{{$error}}</p>
            @endforeach
        @endif
        @if(Session::has('failed'))
            <p class="text-danger text-center">{{session('failed')}}</p>
        @endif
        @if(Session::has('success'))
            <p class="text-primary text-center">{{session('success')}}</p>
        @endif
        <form method="post" action="/accountValidation">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>Prosze wpisac otrzymany kod:</th>
                    <td><input type="number" name="activation_code" class="form-control"/></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input name='submit' type="submit" class="btn btn-primary"/>
                    </td>
                </tr>
            </table>
        </form>
    </div>

@endsection
