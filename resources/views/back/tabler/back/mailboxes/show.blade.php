@extends(back_view_path('layouts.base'))


@section('title', Lang::get('administrable-mailbox::translations.view.reading'))


@section('content')

<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route(config('administrable.guard') .'.dashboard') }}">{{ Lang::get('administrable-mailbox::translations.default.dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ back_route('extensions.mailbox.mailbox.index') }}">{{ Lang::get('administrable-mailbox::translations.label') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="#">{{ $mailbox->name }}</a></li>
            </ol>

            <div class="btn-group">
                <a href="{{ back_route('extensions.mailbox.mailbox.destroy', $mailbox) }}" class="btn btn-danger" data-method="delete"
                    data-confirm="{{ Lang::get('administrable-mailbox::translations.view.destroy') }}">
                    <i class="fas fa-trash"></i>&nbsp; {{ Lang::get('administrable-mailbox::translations.default.delete') }}</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">

        <div class="row">
            <div class="col-md-12">
                <h3>
                    {{ Lang::get('administrable-mailbox::translations.view.from') }}: {{ $mailbox->name }}
                </h3>
                <div class="card-body p-0">
                    <div class="mailbox-read-info mb-4">
                        <h4>{{ $mailbox->email }} | {{ $mailbox->phone_number }}
                            <span class="mailbox-read-time float-right">{{ $mailbox->created_at->format('d/m/Y h:i') }}</span></h4>
                    </div>
                    <!-- /.mailbox-read-info -->
                    {{-- add fields here --}}
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                        <p>
                            {!! $mailbox->content !!}
                        </p>
                    </div>
                    <!-- /.mailbox-read-message -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ml-4">
                        <h3 class="card-title font-weight-bold"><i class="fa fa-comments"></i> {{ Lang::get('administrable-mailbox::translations.view.notes') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mailbox-messages ml-4">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    @foreach($mailbox->notes->reverse() as $note)
                                    <tr>
                                        <td class="mailbox-subject">
                                            <blockquote
                                                style="border-left: 12px solid {{ $note->guest_name }}; padding-left: 5px;">
                                                {!! $note->comment !!}
                                            </blockquote>
                                            <hr>
                                            <small> <i class="fa fa-user"></i> {{ $note->author->name }}
                                                &nbsp;&nbsp;|&nbsp;&nbsp;
                                                <i class="fa fa-clock"></i> {{ $note->created_at->diffForHumans() }}
                                                &nbsp;&nbsp;| &nbsp;&nbsp;
                                                <i class="fa fa-envelope"></i> {{ $note->author->email }}</small>
                                            <div class="float-right">
                                                <a href="#" class="text-secondary" data-toggle="modal"
                                                    data-target="#note{{ $note->id }}" title="Editer"><i
                                                        class="fa fa-edit"></i></a>
                                                <a href="{{ back_route('extensions.mailbox.mailbox.note.destroy', [$mailbox, $note]) }}"
                                                    data-confirm="{{ Lang::get('administrable-mailbox::translations.view.destroy') }}"
                                                    data-method="delete" class="text-danger" data-toggle="tooltip"
                                                    data-placement="top" title="{{ Lang::get('administrable-mailbox::translations.default.delete') }}"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="note{{ $note->id }}" tabindex="-1"
                                        aria-labelledby="note{{ $note->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="note{{ $note->id }}Label">
                                                        {{ Lang::get('administrable-mailbox::translations.view.edit_note') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post"
                                                        action="{{ back_route('extensions.mailbox.mailbox.note.update', [$mailbox, $note]) }}"
                                                        id="note-form-{{ $note->id }}">
                                                        @csrf
                                                        @method('put')


                                                        <div class="form-group">
                                                            <label for="color{{ $note->getKey() }}">{{ Lang::get('administrable-mailbox::translations.view.note_color') }}</label>
                                                            <input type="color" name="color"
                                                                id="color{{ $note->getKey() }}"
                                                                value="{{ $note->guest_name }}"
                                                                class="form-control">
                                                        </div>

                                                        <div class="form-group">
                                                            <label
                                                                for="comment{{ $note->getKey() }}">{{ Lang::get('administrable-mailbox::translations.view.note_content') }}</label>
                                                            <textarea name="comment"
                                                                id="comment{{ $note->getKey() }}" cols="30" rows="5"
                                                                class="form-control">{{ $note->comment }}</textarea>
                                                        </div>

                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ Lang::get('administrable-mailbox::translations.default.cancel') }}</button>
                                                    <button type="submit" form="note-form-{{ $note->getKey() }}"
                                                        class="btn btn-success">{{ Lang::get('administrable-mailbox::translations.default.save') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>

                        <hr class="mt-2 pt-2 ">
                        <form action="{{ back_route('extensions.mailbox.mailbox.note.store', $mailbox) }}" method="post"
                            name="mailbox-note-form">
                            @csrf
                            <div class="form-group">

                                <textarea name="comment" id="comment" cols="30" rows="5"
                                    class="form-control">{{ old('comment') }}</textarea>

                                @if ($errors->any())
                                <div class="alert alert-danger mt-4">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="">
                                <button class="btn btn-outline-success btn-sm" type="submit"><i
                                        class="fa fa-plus"></i> {{ Lang::get('administrable-mailbox::translations.default.add') }}</button>
                                <input type="text" class="choose-color" readonly value="Note couleur"
                                    style="cursor: pointer; max-width: 108px; display: inline-block;">
                                <input type="text" class="choose-color display-color" readonly
                                    style="cursor: pointer;background-color: #007bff;width: 100px; padding: 4px; border: none;">
                                <input type="hidden" class="color-value" name="color" value="#007bff">
                                <input type="color" id="color" style="display: none;">
                                <select name="save" id="save">
                                    <option value="1" {{ old('save') === '1'  ? 'selected' : '' }}>{{ Lang::get('administrable-mailbox::translations.default.save') }}
                                    </option>
                                    <option value="0" {{ old('save') === '0' ? 'selected' : '' }}>{{ Lang::get('administrable-mailbox::translations.view.send_email') }}
                                    </option>
                                </select>
                                <input data-email
                                    class="{{ old('save') === '1' || old('save') === null ? 'd-none' : '' }}"
                                    type="email" name="email" value="{{ $mailbox->email }}"
                                    placeholder="example@domain.com">
                                <input data-email
                                    class="{{ old('save') === '1' || old('save') === null ? 'd-none' : '' }}"
                                    type="text" name='subject' placeholder="Sujet">
                            </div>
                        </form>
                    </div>
            </div>

        </div>
    </div>
</div>


@endsection



@push('js')
<script>
    (function(){
      const inputColor = document.querySelector('#color')
      Array.from(document.querySelectorAll('.choose-color')).forEach(element => {
          element.addEventListener('click', function(){
              inputColor.focus()
              inputColor.value = "#007bff"
              inputColor.click()
          })
      });

      inputColor.addEventListener('input', function(event){
          const displayColor = document.querySelector('.display-color')
          displayColor.style.backgroundColor = event.target.value
          document.querySelector('.color-value').value = event.target.value
      });


      const form = document.querySelector('form[name=mailbox-note-form]')
      form.querySelector('select[name=save]').addEventListener('change', function(event){
          const value = event.target.value

          const inputs = Array.from(form.querySelectorAll('input[data-email]'));

          if (value == 1){
                inputs.forEach(input => input.classList.add('d-none'))
            }else {
              inputs.forEach(input => input.classList.remove('d-none'))
            }
          });
    })()
</script>
@endpush













