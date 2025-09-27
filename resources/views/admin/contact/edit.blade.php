@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Información de Contacto</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.contact.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Horario</label>
            <input type="text" name="schedule" value="{{ $contact->schedule }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="phone" value="{{ $contact->phone }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="email" value="{{ $contact->email }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="address" value="{{ $contact->address }}" class="form-control">
        </div>

        <h5>Redes sociales</h5>
        <div class="mb-3">
            <label>Facebook</label>
            <input type="url" name="facebook" value="{{ $contact->facebook }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Instagram</label>
            <input type="url" name="instagram" value="{{ $contact->instagram }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>TikTok</label>
            <input type="url" name="tiktok" value="{{ $contact->tiktok }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>LinkedIn</label>
            <input type="url" name="linkedin" value="{{ $contact->linkedin }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
@endsection
