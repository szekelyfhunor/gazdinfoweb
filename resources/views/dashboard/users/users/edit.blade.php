@extends('dashboard.layout.main')

@section('title', 'Felhasználó módosítása')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card card-primary card-outline">
                <div class="card-header">Felhasználó adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.users.update', $user->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Név</label>
                                <input name="name" type="text" class="form-control" value="{{$errors->any()?old('name'):$user->name}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control" value="{{$errors->any()?old('email'):$user->email}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Telefon</label>
                                <input name="phone" type="text" class="form-control" value="{{$errors->any()?old('phone'):$user->phone}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roles">Szerepek</label>
                            <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-row depend-on-role">

                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Kép</label>
                                <input name="image" type="file" value="{{$errors->any()?old('image'):$user->image}}" class="form-control">
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="image_cb" type="checkbox" value="" id="image_cb">
                            <label class="form-check-label" for="image_cb">
                                Törölje a meglévő képet (ha újat ad meg nem szükséges bejelölni)
                            </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.users.index') }}" class="btn btn-warning"> <i class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#roles').select2();
            $( "#roles" ).trigger( "select2:opening" );
            $( "#roles" ).trigger( "select2:closing" );
        });

        $('#roles').on('select2:opening', function (e) {
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();
            var teacherExists = $.inArray( "Tanár", select_val )
            var studentExists = $.inArray( "Hallgató", select_val )
            console.log(teacherExists);
            var possibleOptions = [];
            $.each(this.options, function (i, item) {
                possibleOptions.push(item.text);
            });
            // console.log("Lehetseges valasztasok"  + possibleOptions);
            var possibleExistsOfTeacher = $.inArray( "Tanár", possibleOptions )
            var possibleExistsOfStudent = $.inArray( "Hallgató", possibleOptions )
            console.log(possibleExistsOfTeacher)
            console.log(possibleExistsOfStudent)
            $.each(this.options, function (i, item) {
                if(teacherExists > -1 /*&&  item.text === 'Tanár'*/){
                    if(possibleExistsOfTeacher > -1 && possibleExistsOfStudent > -1){
                        if(item.text === 'Hallgató'){
                            $(item).prop("disabled", true);
                        }
                    }
                    else if(item.text === 'Tanár'){
                        $(item).attr("locked", 'locked');
                        $(item).attr("select2-selection__choice__remove", ' display: none!important');
                    }

                }
                if(studentExists > -1 /*&&  item.text === 'Hallgató'*/){
                    if(possibleExistsOfTeacher > -1 && possibleExistsOfStudent > -1){
                        if(item.text === 'Tanár'){
                            $(item).prop("disabled", true);
                        }
                    }
                    else if ( item.text === 'Hallgató') {
                        $(item).attr("locked", 'locked');
                        $(item).attr("class", 'noX');
                    }
                }
                if(possibleExistsOfTeacher > -1 && possibleExistsOfStudent > -1){
                    if(teacherExists === -1 && studentExists === -1 && ( item.text === 'Hallgató' || item.text === 'Tanár')){
                        $(item).prop("disabled", false);
                    }
                }
                console.log(this.length);
            });
        });
        $('#roles').on('select2:unselecting', function (e) {
            if ($(e.params.args.data.element).attr('locked')) {
                e.preventDefault();
            }
        });

        let teacherIsVisible = false;
        let studentIsVisible = false;
        $('#roles').on('select2:closing', function (e) {
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();
            var teacherExists = $.inArray( "Tanár", select_val )
            var studentExists = $.inArray( "Hallgató", select_val )
            if(teacherExists > -1 || studentExists > -1){
                if(teacherExists > -1 && !teacherIsVisible){
                    $('.depend-on-role').append(
                        `
                            <div class="form-group col-md-6 required">
                                <label>Fokozat</label>
                                <input name="degree" type="text" class="form-control" value="{{$errors->any()?old('degree'):($user->teacher->degree ?? '')}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Beosztás</label>
                                <input name="post" type="text" class="form-control" value="{{$errors->any()?old('post'):($user->teacher->post ?? '')}}">
                            </div>
                        `
                    );
                    teacherIsVisible = true;
                    studentIsVisible = false;
                }
                if(studentExists > -1 && !studentIsVisible){
                    $('.depend-on-role').append(
                        `
                            <div class="form-group col-md-6 required">
                                <label>Évfolyam</label>
                                <select id="classes_id" name="classes_id"  class="form-control">
                                    @foreach($classes as $classe)
                                        <option value="{{$classe->id}}" {{ $errors->any()?(old('classes_id') == $classe->id ? 'selected' : ''):(($user->student->classes_id ?? -1) == $classe->id ? 'selected' : '') }}>{{$classe->year}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Munkahely</label>
                                <input name="workplace" type="text" class="form-control" value="{{$errors->any()?old('workplace'):($user->student->workplace??'')}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Végzés éve</label>
                                <input name="year_of_finish" type="number" class="form-control" value="{{$errors->any()?old('year_of_finish'):($user->student->year_of_finish??'')}}">
                            </div>
                            <div class="form-group col-md-6 required">
                            <label>Státusz</label>
                            <select name="status" class="form-control">
                                <option {{$errors->any()?(old('status')=="1" ? 'selected':''):(isset($user->student->status)?($user->student->status=="1"? 'selected':''):'')}} value="1">Aktív</option>
                                <option {{$errors->any()?(old('status')=="0" ? 'selected':''):(isset($user->student->status)?($user->student->status=="0"? 'selected':''):'')}} value="0">Inaktív</option>
                            </select>
                        </div>
                      `
                    );
                    teacherIsVisible = false;
                    studentIsVisible = true;
                }
            }else{
                $('.depend-on-role').empty();
                teacherIsVisible = false;
                studentIsVisible = false;
            }

        });
    </script>
    <style>
        .locked-tag .select2-selection__choice__remove{
            display: none!important;
        }

        .select2-results__option[aria-selected="true"]{
            display: none;
        }

        .select2{
            width: 100% !important;
        }
    </style>
@endsection
