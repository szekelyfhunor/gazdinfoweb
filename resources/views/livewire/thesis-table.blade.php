<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-3" style="width: 25%">
                        <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Keresés" aria-label="Keresés" aria-describedby="basic-addon2">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover my-table">
                            <thead class="my-table-header">
                                <tr>
                                    <th class="text-center align-middle" wire:click="setSortBy('title')" style="cursor: pointer;">Cím <i class="bi bi-arrow-down-up"></i></th>
                                    <th class="text-center align-middle">Leírás</th>
                                    <th class="text-center align-middle">Témakörök</th>
                                    <th class="text-center align-middle">Témavezetők</i></th>
                                    <th class="text-center align-middle">Jelentkezés</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($diplomaTheses as $thesis)
                                <tr wire:key="{{ $thesis->id }}">
                                    <td class="text-center align-middle">{{ $thesis->title }}</td>
                                    <td>{{ $thesis->abstract }}</td>
                                    <td class="text-center align-middle">
                                        @foreach ($thesis->topics as $topic)
                                        {{ $topic->name }}
                                            @if (!$loop->last)
                                            {{ ',' }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="text-center align-middle">
                                        @php
                                        $teacherNames = [];
                                        foreach($users as $user) {
                                            if (in_array($user->id, $thesis->teacher->pluck('user_id')->toArray())) {
                                                $teacherNames[] = $user->name;
                                            }
                                        }
                                        echo implode(', ', $teacherNames);
                                        @endphp
                                    </td>
                                    <td class="text-center align-middle">
                                        <livewire:application-button :thesisId="$thesis->id" :key="$thesis->id" />
                                    </td>                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group mb-3" style="width: 5%">
                        <label for="pageSizeSelect">Oldalméret:</label>
                        <select wire:model.live='perPage' class="form-control" id="pageSizeSelect">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    {{ $diplomaTheses->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
