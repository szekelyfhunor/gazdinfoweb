<div>
    <div class="card">
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div>
                <a href="{{ route('dashboard.users.create') }}" class="btn btn-success btn-sm"><i
                        class="fas fa-plus"></i> Új felhasználó</a>
            </div>
            <br>
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4 required">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group col-md-4 required">
                        <button class="btn btn-success"><i class="fas fa-file-excel"></i> Import</button>
                    </div>
                </div>

                <input type="text" class="form-control mb-3" placeholder="Keresés név alapján..." wire:model.live.debounce.300ms="search">
            </form>

            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover my-table">
                    <thead class="my-table-header">
                    <tr>
                        <th class="text-center align-middle">Név</th>
                        <th class="text-center align-middle">Email</th>
                        <th class="text-center align-middle">Telefon</th>
                        <th class="text-center align-middle">Kép</th>
                        <th class="text-center align-middle">Szerepek</th>
                        <th class="text-center align-middle">Bővebben</th>
                        <th colspan="2" class="text-center align-middle">Műveletek</th>
                    </tr>
                    </thead>
                    <tbody class="my-table-body">
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-center">{{$user->name}}</td>
                            <td class="text-center">{{$user->email}}</td>
                            <td class="text-center">{{$user->phone}}</td>
                            <td class="text-center" ><img data-toggle="modal" data-target="#imagemodal" onclick='showImg("{{$user->name}}","{{asset($user->getFirstMediaUrl('images'))}}")'  src="{{asset($user->getFirstMediaUrl('images'))}}" onerror="this.style.display = 'none'" {{--alt="Nincs elérhető fotó" --}}class="my-wh-little"></td>
                            <td>
                                @foreach($user->roles()->pluck('name') as $role)
                                    <span class="badge badge-success">{{ $role }}</span>
                                @endforeach
                            </td>
                            <td>
                                <span class="badge badge-info">{{ isset($user->student->classes_id)?"Évfolyam: ".$user->student->classes->year:'' }}</span>
                                <span class="badge badge-info">{{ isset($user->student->workplace)?"Munka: ".$user->student->workplace:'' }}</span>
                                <span class="badge badge-info">{{ isset($user->student->year_of_finish)?"Végzés éve: ".$user->student->year_of_finish:'' }}</span>
                                <span class="badge badge-info">{{ isset($user->student->status)?($user->student->status == 1?"Státusz: Aktív":"Statusz: Inaktív"):'' }}</span>
                                <span class="badge badge-warning">{{ isset($user->teacher->degree)?"Fokozat: ".$user->teacher->degree:'' }}</span>
                                <span class="badge badge-warning">{{ isset($user->teacher->post)?"Beosztás: ".$user->teacher->post:'' }}</span>
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('dashboard.users.edit', $user->id) }}"
                                   class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Szerkeszt</a>

                            </td>
                            <td class="text-center text-nowrap">
                                <button id="delete-users"  data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-danger btn-sm" type="submit" onclick="Remove({{$user->id}}, this)"><i class="fas fa-trash" ></i> Töröl
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </div>
</div>
