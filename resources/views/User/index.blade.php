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
            <a class="nav-link active" href="#">Users</a>
        </li>
    </ul>

    <h1>{{$title}}</h1>

    <div>
        <div class="card">

            <div class="card-header">
                <div class="form-row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <form class="card-group" method="get" accept="{{url()->current()}}">

                            <label for="region">
                                Click to select Region
                            </label>
                            <select class="js-example-basic-single js-states form-control" id="region"
                                    name="region" data-tags="true" data-placeholder="Select a Region"
                                    data-allow-clear="true">
                                <option disabled>select Region</option>
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </form>

                    </div><!-- /.col-lg-6 -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <form class="card-group" method="get" accept="{{url()->current()}}">
                            <label for="district">
                                Click to select District
                            </label>
                            <select class="js-example-basic-single js-states form-control" id="district"
                                    name="District" data-tags="true" data-placeholder="Select a District"
                                    data-allow-clear="true">
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}">{{$district->name}}</option>
                                @endforeach
                            </select>

                        </form>

                    </div><!-- /.col-lg-6 -->
                    <div class="col-12 col-lg-6">
                        <form class="form-inline float-right" method="get" accept="{{url()->current()}}">
                            <div class="input-group">
                                <input type="text" class="form-control" name="address" value="{{$address}}"
                                       id="inputAddress" placeholder="Home Street Neighborhood">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </div><!-- /input-group -->

                        </form>
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
                <table id="table" class="table dynatable">
                    <thead>
                    <tr class="table-active">
                        <th class="text-center">№</th>
                        <th>Full name</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Region</th>
                        <th>District</th>
                        <th>Address</th>
                        <th class="text-center">Birth date</th>
                    </tr>
                    </thead>

                    <tbody id="users_tr">
                    @foreach($users as $num => $item)
                        <tr>
                            <td class="text-center">{{$item->user->id}}</td>
                            <td>
                                {{$item->user->full_name}}
                            </td>
                            <td>{{$item->user->gender}}</td>
                            <td>{{$item->user->Age}}</td>
                            <td>{{$item->region->name}}</td>
                            <td>{{$item->district->name}}</td>
                            <td>{{$item->address}}</td>
                            <td class="text-center">{{$item->user->date_birth->format('Y-m-d')}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        if ({{$regionId!==null?:0}})
            $('#region option[value="{{$regionId}}"]').prop('selected', true);
        else
            $('#region').val(null).trigger("change");
        if ({{$districtId!==null?:0}})
            $('#district option[value="{{$districtId}}"]').prop('selected', true);
        else
            $('#district').val(null).trigger("change");

        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable();
        });
        $(document).ready(function () {
            $("#region").change(function () {

                var regionId = $(this).children("option:selected").val();

                if (regionId === undefined) {
                    location.href = '/users';
                } else {
                    location.href = '/users/' + regionId;
                }


                // fetch('/user/' + regionId)
                //     .then(response => response.json())
                //     .then(res => {
                //         let {data} = res;
                //         let html = '';
                //         data.forEach(el => {
                //             html += `<tr><td>${el.user.id}</td>`
                //             html += `<td>${el.user.full_name}</td>`
                //             html += `<td>${el.user.gender}</td>`
                //             html += `<td>${el.user.Age}</td>`
                //             html += `<td>${el.user.date_birth}</td></tr>`
                //         });
                //         $('#users_tr').html(html);
                //     });
            })

            $("#district").change(function () {

                var id = $(this).children("option:selected").val();

                if (id === undefined) {
                    location.href = window.location.pathname;
                } else {
                    location.href = window.location.pathname + '?districtId=' + id;
                }
            })

        });
    </script>
@endsection
