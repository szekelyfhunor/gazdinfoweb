@extends('dashboard.layout.main')

@section('title', 'Felhasználó létehozása')

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
                    <form method="post" action="{{route('dashboard.users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Név</label>
                                <input name="name" type="text" class="form-control" value="{{old('name')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 required">
                                <label>Email</label>
                                <input name="email" type="text" class="form-control" value="{{old('email')}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Telefon</label>
                                <input name="phone" type="text" class="form-control" value="{{old('phone')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="roles">Szerepek</label>
                            <select name="roles[]" id="roles" class="form-control select2" multiple="multiple" required>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->role->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row depend-on-role">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Kép</label>
                                <input name="image" type="file" value="" class="form-control">
                            </div>
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
            $('#roles').select2().trigger('closing');
            $( "#roles" ).trigger( "select2:opening" );
            $( "#roles" ).trigger( "select2:closing" );
        });
        $('#roles').on('select2:opening', function (e) {
            var selected_element = $(e.currentTarget);
            var select_val = selected_element.val();
            var teacherExists = $.inArray( "Tanár", select_val )
            var studentExists = $.inArray( "Hallgató", select_val )
            console.log(teacherExists);
            $.each(this.options, function (i, item) {
                if(teacherExists > -1 &&  item.text === 'Hallgató'){
                    $(item).prop("disabled", true);
                }
                if(studentExists > -1 &&  item.text === 'Tanár'){
                    $(item).prop("disabled", true);
                }
                if(teacherExists === -1 && studentExists === -1 && ( item.text === 'Hallgató' || item.text === 'Tanár')){
                    $(item).prop("disabled", false);
                }
            });
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
                                <input name="degree" type="text" class="form-control" value="{{old('degree')}}">
                            </div>
                            <div class="form-group col-md-6 required">
                                <label>Beosztás</label>
                                <input name="post" type="text" class="form-control" value="{{old('post')}}">
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
                                    <option value="{{$classe->id}}" {{ old('classes_id') == $classe->id ? 'selected' : '' }}>{{$classe->year}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Munkahely</label>
                            <input name="workplace" type="text" class="form-control" value="{{old('workplace')}}">
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Végzés éve</label>
                            <input name="year_of_finish" type="number"  class="form-control" value="{{old('year_of_finish')}}">
                        </div>
                        <div class="form-group col-md-6 required">
                            <label>Státusz</label>
                            <select name="status" class="form-control">
                                <option {{old('status')=="1"? 'selected':''}} value="1">Aktív</option>
                                <option {{old('status')=="0"? 'selected':''}} value="0">Inaktív</option>
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
@endsection
