@extends('layouts.pages.dashboard')

@section('title', 'Inicio')

@section('content-page')
<main class="container mt-5">
    <div class="d-flex">
        <h2>SEUS EVENTOS: </h2>
        <button type="button" class="btn btn-primary btn-sm ms-auto p-2" data-bs-toggle="modal" data-bs-target="#createeventModal">Adicionar Evento <i class="fa-solid fa-plus"></i></button>
    </div>

    <div class="shadow-lg p-3 my-3 rounded">
        @if(count($events) == 0)
        <p>Não há eventos disponíveis no momento...</p>
        @else
        <table class="table table-sm table-borderless text-center mt-3">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de criação</th>
                    <th scope="col">Local</th>
                    <th scope="col">Participantes</th>
                    <th scope="col">Data de realização</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($events as $event)
                <tr>
                    <th scope="row">{{ $event->title }}</th>
                    <th scope="row">{{ date( 'd/m/Y' , strtotime($event->created_at)) }}</th>
                    <th scope="row">{{ $event->city }}</th>
                    <th scope="row">0</th>
                    <th scope="row">{{ date( 'd/m/Y' , strtotime($event->date)) }}</th>
                    <th>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#vieweventModal" onclick="viewEvents('{{ $event }}')" title="Exibir informações"><i class="fa-solid fa-eye"></i></button>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editeventModal" onclick="editEvents('{{ $event }}')" title="Editar evento"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#removeeventModal" onclick="deleteEvents('{{ $event->id }}')" title="Excluir evento"><i class="fa-solid fa-trash"></i></button>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="modal fade" id="editeventModal" tabindex="-1" aria-labelledby="editeventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editeventModaltitle">Editar Evento:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="container">
                        <form method="POST" enctype="multipart/form-data" id="form_editevent">
                            @method('PUT')
                            @csrf
                            <div class="row mb-3">
                                <label for="title_editevent" class="col-md-4 col-form-label">Nome</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="title_editevent" name="title" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="city_editevent" class="col-md-4 col-form-label">Cidade</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="city_editevent" name="city" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="date_editevent" class="col-md-4 col-form-label">Data do evento:</label>
                                <div class="col-md-8">
                                    <input type="datetime-local" class="form-control" id="date_editevent" name="date" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label">Imagem</label>
                                <div class="col-md-8">
                                    <input type="file" class="form-control form-control-sm" name="image" accept="image/*" required>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <img id="image_editevent" class="img-fluid rounded top-50 start-50 w-50">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="meta_participants_editevent" class="col-md-4 col-form-label">Meta de participantes</label>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" id="meta_participants_editevent" name="meta_participants" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description_editevent" class="col-md-4 col-form-label">Descrição</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" id="description_editevent" name="description" rows="8" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label">Conteúdos do evento:</label>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <button id="createCheckbox" class="btn btn-outline-secondary" type="button" id="button-add-items">Adicionar</button>
                                        <input type="text" class="form-control" id="itemsInput_editevent" placeholder="Digite aqui" aria-label="itemsInput_editevent" aria-describedby="button-add-items">
                                    </div>
                                    <div id="checkboxContainer"></div>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-md-4 pt-0">Privado</legend>
                                <div class="col-md-8">
                                    <div class="form-check form-switch pt-1">
                                        <input type="checkbox" class="form-check-input" role="switch" id="private" name="private">
                                    </div>
                                </div>
                            </fieldset>
                            <button type="submit" class="btn btn-dark">Criar evento</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="vieweventModal" tabindex="-1" aria-labelledby="vieweventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="event_title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="event_body"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="removeeventModal" tabindex="-1" aria-labelledby="removeeventModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titulo">Você deseja excluir realmente esse evento?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteEvents" method="post">
                        @method('DELETE')
                        @csrf
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="modal fade" id="createeventModal" tabindex="-1" aria-labelledby="createeventModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createeventModaltitle">Adicionar Evento:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <form method="POST" action="{{ route('store_events') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label">Nome</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label">Cidade</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label">Data do evento:</label>
                            <div class="col-md-8">
                                <input type="datetime-local" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label">Imagem</label>
                            <div class="col-md-8">
                                <input type="file" class="form-control form-control-sm" id="image" name="image" accept="image/*" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="meta_participants" class="col-md-4 col-form-label">Meta de participantes</label>
                            <div class="col-md-8">
                                <input type="number" class="form-control" id="meta_participants" name="meta_participants" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label">Descrição</label>
                            <div class="col-md-8">
                                <textarea class="form-control" id="description" name="description" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label">Conteúdos do evento:</label>
                            <div class="col-md-8">
                                <div class="input-group mb-3">
                                    <button id="createCheckbox" class="btn btn-outline-secondary" type="button" id="button-add-items">Adicionar</button>
                                    <input type="text" class="form-control" id="itemsInput" placeholder="Digite aqui" aria-label="itemsInput" aria-describedby="button-add-items">
                                </div>
                                <div id="checkboxContainer"></div>
                            </div>
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-md-4 pt-0">Privado</legend>
                            <div class="col-md-8">
                                <div class="form-check form-switch pt-1">
                                    <input type="checkbox" class="form-check-input" role="switch" id="private" name="private">
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-dark">Criar evento</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
function viewEvents(event) {
    const register = JSON.parse(event);
    $('#event_title').html(register.title);
    $('#event_body').html('<ul class="list-group list-group-flush"><li class="list-group-item"><h6>Descrição do evento:</h6>' + register.description + '</li><li class="list-group-item"><h6>Local:</h6>' + register.city + '</li><li class="list-group-item"><h6>Meta de participantes:</h6><div class="progress" role="progressbar" aria-label="Meta participants" aria-valuenow="0" aria-valuemin="0" aria-valuemax="' + register.meta_participants + '"><div class="progress-bar"></div></div><div class="d-flex justify-content-between mb-4"><span>0</span><span>' + register.meta_participants + '</span></div></li></ul>');
    $(".progress-bar").css("width", "0%");
}

function editEvents(event) {
    const register = JSON.parse(event);
    $('#form_editevent').attr('action', "{{ route('update_events', ['id' => ':id'])}}".replace(':id', register.id));
    $('#title_editevent').val(register.title);
    $('#city_editevent').val(register.city);
    $('#date_editevent').val(register.date);
    $('#meta_participants_editevent').val(register.meta_participants);
    $('#description_editevent').html(register.description);
    $('#image_editevent').attr('src', "{{ asset('assets/img/events') }}" + '/' + register.image);
    console.log(register);
}

function deleteEvents(id) {
    var form = document.getElementById('deleteEvents');
    form.action = "{{ route('destroy_events', ['id' => ':id'])}}".replace(':id', id);
}

$(document).ready(function() {
  $('#createCheckbox').click(function() {
    const inputValue = $('#itemsInput').val().trim();
    if (inputValue !== '') {
      const checkbox = $('<input>', {
        class: 'form-check-input ms-3 me-1',
        type: 'checkbox',
        value: inputValue,
        name: 'items[]',
        id: 'checkbox-' + inputValue,
        checked: true,
      });

      const label = $('<label>', {
        for: 'checkbox-' + inputValue,
        text: inputValue
      });

      $('#checkboxContainer').append(checkbox, label);
      $('#itemsInput').val('');
    }
  });
});
</script>
@endpush