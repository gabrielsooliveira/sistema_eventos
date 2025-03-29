@extends('layouts.pages.site')

@section('title', 'Criar evento')

@section('content-page')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="my-3">Criar evento:</h4>
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
                                    <input type="text" class="form-control"  id="itemsInput" placeholder="Digite aqui" aria-label="itemsInput" aria-describedby="button-add-items">
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
        <div class="col-md-5">
            
        </div>
    </div>  
</div>   
@endsection

@push('scripts')
<script>
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