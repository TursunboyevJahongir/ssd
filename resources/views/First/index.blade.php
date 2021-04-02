@extends('layouts.app')
@section('title')
    {{$title}}
@endsection

@section('content')

    <ul class="nav nav-tabs nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="{{route('incomes')}}">Incomes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('costs')}}">Costs</a>
        </li>
    </ul>
    <h1>{{$title}}</h1>
    <div class="container">
        <div class="card">

            <div class="card-header">
                <div class="row">
                    <div class="col-11">
                        <h4>Time interval:</h4>
                        <form class="card-group" method="get" accept="{{url()->current()}}">
                            <div class="row">
                                <div class="col-md-4"><input class="form-control" type="datetime-local"
                                                             name="start_date" value="{{$start_date}}"
                                                             id="example-datetime-local-input">
                                </div>
                                <div class="col-md-4">
                                    <input class="form-control" type="datetime-local" name="end_date"
                                           value="{{$end_date}}"></div>
                                <div class="col-md-1">
                                    <button class="btn btn-outline-danger pro-button w-100">Go</button>
                                </div>

                                <div class="col-md-2 btn-group">

                                    <button type="button"
                                            class="btn btn{{$date == 'today' ?"":"-outline"}}-danger pro-button"
                                            onclick="today()">today
                                    </button>

                                    <button type="button"
                                            class="btn btn{{$date == 'month' ?"":"-outline"}}-danger pro-button"
                                            onclick="month()">Month
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button"
                                            class="btn btn{{$date == 'pension' ?"":"-outline"}}-warning pro-button"
                                            onclick="pension()">Pension
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div><!-- /.col-lg-6 -->

                    <div class="col-1">
                        <a href="13513" type="button"
                           class="btn btn-outline-success float-left btn-lg"
                           data-toggle="tooltip" title="новый"> <i class="fa fa-plus"></i>
                        </a>
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">{{$errors->first()}}</div>
                @endif
                @if(session()->get('message'))
                    <div class="alert alert-success">{{session()->get('message')}}</div>
                @endif
                <table id="example1" class="table  table-hover">
                    <thead>
                    <tr class="table-active">
                        <th width="10%">№</th>
                        <th>Name</th>
                        <th width="20%">Price</th>
                        <th class="text-center" width="20%">Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="table-danger">
                        <td colspan="2" class="text-center"><b>The total</b></td>
                        <td colspan="2">{{$sum}}</td>
                    </tr>
                    </tbody>
                    <tfoot>

                    @foreach($incomes as $num => $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>
                                {{$item->name}}
                            </td>
                            <td>{{$item->price}}</td>
                            <td class="text-center">{{$item->created_at}}</td>

                        </tr>
                    @endforeach
                    </tfoot>


                </table>
                <div class="d-flex justify-content-center" id="myformid">
                    {!! $incomes->appends($_GET)->links() !!}
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>




@endsection
@section('js')
    <script>
        function pension() {
            if ({{$date == 'pension' ? 1:0}})
                window.location.assign("{{route('incomes')}}")
            else {
                window.location.assign("{{route('incomes',['date'=>'pension'])}}")
            }
        }

        function today() {
            if ({{$date == 'today' ? 1:0}})
                window.location.assign("{{route('incomes')}}")
            else {
                window.location.assign("{{route('incomes',['date'=>'today'])}}")
            }
        }

        function month() {
            if ({{$date == 'month' ? 1:0}})
                window.location.assign("{{route('incomes')}}")
            else {
                window.location.assign("{{route('incomes',['date'=>'month'])}}")
            }
        }
    </script>
@endsection
