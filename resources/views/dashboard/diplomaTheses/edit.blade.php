@extends('dashboard.layout.main')

@section('title', 'Diplomadolgozat módosítása')

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
                <div class="card-header">Diplomadolgozat adatai</div>

                <div class="card-body">
                    <form method="post" action="{{route('dashboard.diplomatheses.update', $diplomathese->id)}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Cím</label>
                                <input name="title" type="text" class="form-control" value="{{$errors->any()?old('title'):$diplomathese->title}}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Leírás</label>
                                <textarea name="abstract" class="form-control">{{$errors->any() ? old('abstract') : $diplomathese->abstract}}</textarea>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12 required">
                                <label>Témakör</label>
                                <select id="topic_id" name="topic_id[]"   class="form-control form-select select2" multiple="multiple">
                                    @foreach($topics as $topic)
                                        <option value="{{ $topic->id }}" {{ $errors->any()?((in_array($topic->id , old('topic_id', []))) ? 'selected' : ''):((in_array($topic->id ,$diplomathese->topics->pluck('id')->toArray()) ? 'selected' : '')) }}>{{ $topic->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="teacher_user_id">Témavezető</label>
                            <input type="text" class="form-control" value="{{ $teacher->user->name }}" readonly>
                            <input type="hidden" name="teacher_id[]" value="{{ $teacher->id }}">
                        </div>

                        <div class="form-group">
                            <button id="diploma-edit-submit" type="submit" class="btn btn-primary mr-2">
                                <i class="fas fa-save"></i> Mentés
                            </button>
                            <a href="{{ route('dashboard.diplomatheses.index') }}" class="btn btn-warning"> <i
                                    class="fas fa-arrow-left"></i> Vissza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#teacher_user_id').select2();
            $('#topic_id').select2();
        })
    </script>
@endsection
