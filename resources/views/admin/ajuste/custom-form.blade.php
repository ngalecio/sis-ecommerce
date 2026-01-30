
@extends('layouts.admin')
@section('content')

    <h1>Mi Formulario Personalizado</h1>





    <form action="{{ route('custom.submit3') }}" method="POST">
        @csrf
        <input type="text" name="test3" value="prueba3">
        <button type="submit">ajustes submit</button>
    </form>

            <form action="{{ route('ajustes.store') }}" method="POST">
                <input type="text" name="test1" value="prueba1">
                @csrf
                <button type="submit">Custom submit</button>
            </form>

    @endsection
