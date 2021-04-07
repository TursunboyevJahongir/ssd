@extends('layouts.app')
@section('title')
    {{$title}}
@endsection

@section('content')

    <div class="modal fade bd-example-modal-lg" id="eye" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Prisoner</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container" id="see_prisoner">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="#">Prisoners</a>
        </li>
    </ul>

    <h1>{{$title}}</h1>

    <div>
        <div class="card">

            <div class="card-header">
                <div class="form-row">
                    <div class="col-12 col-lg-6">
                        <form class="card-group" method="get" accept="{{url()->current()}}">

                            <label for="law">
                                Select a Crime
                            </label>
                            <select class="js-example-basic-single js-states form-control" id="law"
                                    name="law" data-tags="true" data-placeholder="Select a Crime"
                                    data-allow-clear="true">
                                <option disabled>select Crime</option>
                                @foreach($laws as $law)
                                    <option value="{{$law->id}}">{{$law->title}}</option>
                                @endforeach
                            </select>
                        </form>

                    </div><!-- /.col-lg-6 -->
                    <div class="col-12 col-lg-6">
                        <form class="card-group" method="get" accept="{{url()->current()}}">
                            <label for="district">
                                Select a Imprisonment regime
                            </label>
                            <select class="js-example-basic-single js-states form-control" id="imprisonment_regime"
                                    name="imprisonment_regime" data-tags="true"
                                    data-placeholder="Select a Imprisonment regime"
                                    data-allow-clear="true">
                                @foreach($prisoners as $prisoner)
                                    <option
                                        value="{{substr($prisoner->imprisonment_regime,0, 20)}}">{{$prisoner->imprisonment_regime}}</option>
                                @endforeach
                            </select>

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
                <table id="table" class="table table-bordered dynatable">
                    <thead>
                    <tr class="table-active">
                        <th width="5%" class="text-center">№</th>
                        <th>Full name</th>
                        <th width="7%">
                            Gender
                            <select name="gender" id="selectGender">
                                <option value="all" {{$gender=='all'?'selected':""}}>all</option>
                                <option value="male" {{$gender=='male'?'selected':""}}>Male</option>
                                <option value="female" {{$gender=='female'?'selected':""}}>Female</option>
                            </select>
                        </th>
                        <th width="5%" class="text-center">Age</th>
                        <th width="10%" class="text-center">Birth date</th>
                        <th width="8%">term</th>
                        <th width="10%" class="text-center">Start of term</th>
                        <th width="10%" class="text-center">End of term</th>
                        <th width="5%" class="text-center">#</th>
                    </tr>
                    </thead>

                    <tbody id="users_tr">
                    @foreach($prisoners as $num => $item)
                        <tr>
                            <td class="text-center">{{$item->user->id}}</td>
                            <td>
                                {{$item->user->full_name}}
                            </td>
                            <td>{{$item->user->gender}}</td>
                            <td class="text-center">{{$item->user->Age}}</td>
                            <td class="text-center">{{$item->user->date_birth->format('Y-m-d')}}</td>
                            <td>{{$item->term}}</td>
                            <td class="text-center">{{$item->start_of_term->format('Y-m-d')}}</td>
                            <td class="text-center">{{$item->end_of_term->format('Y-m-d')}}</td>
                            <td data-item="{{$item->id}}" class="text-center">
                                <button type="button"
                                        class="btn btn-success btn-sm eye" data-toggle="tooltip"
                                        title="See"><i class="fas fa-eye"></i>
                                </button>
                            </td>
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
        if ({{$lawId!==null?:0}})
            $('#law option[value="{{$lawId}}"]').prop('selected', true);
        else
            $('#law').val(null).trigger("change");
        if ({{$imprisonment_regime!==null?:0}})
            $('#imprisonment_regime option[value="{{$imprisonment_regime}}"]').prop('selected', true);
        else
            $('#imprisonment_regime').val(null).trigger("change");

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
            $("#selectGender").change(function () {

                var gender = $(this).children("option:selected").val();

                if (gender === undefined) {
                    location.href = window.location.pathname;
                    // location.href = window.location.href;
                } else {
                    location.href = window.location.pathname + '?gender=' + gender;
                }
            })

            $("#law").change(function () {

                var lawId = $(this).children("option:selected").val();

                if (lawId === undefined) {
                    location.href = '/prisoners';
                } else {
                    location.href = '/prisoners/' + lawId;
                }
            })

            $("#imprisonment_regime").change(function () {

                var word = $(this).children("option:selected").val();

                if (word === undefined) {
                    location.href = window.location.pathname;
                } else {
                    location.href = window.location.pathname + '?imprisonment_regime=' + word;
                }
            })

        });
    </script>

    <script>
        $('.eye').click(function () {
            let id = $(this).closest('td').data('item');
            fetch('/prisoner/' + id)
                .then(res => res.json())
                .then(data => {
                    // console.log(data.data.crimes)
                    let crimes = data.data.crimes;
                    let prisoner = data.data;
                    let user = data.data.user;
                    let html = '';
                    html += `<p><b style="font-size: 20px">${user.full_name}</b>    (${user.gender}) ${user.date_birth} <i>${user.age} age</i></p>`;
                    html += `<b class="text-center">Imprisonment Regime</b>`;
                    html += `<p>${prisoner.imprisonment_regime}</p> `;
                    console.log(crimes);
                    html += `<div class="alert alert-danger"> <strong>Crimes</strong><br>`;

                    crimes.forEach(el => {
                        html += `--${el.title}<br>`;
                    });
                    html += `</div>`;

                    html += `<p><b>${prisoner.term}</b> (${prisoner.start_of_term}-${prisoner.end_of_term})</p>`;

                    $('#see_prisoner').html(html);
                    $('#eye').modal('show');
                });
        });
    </script>

@endsection
