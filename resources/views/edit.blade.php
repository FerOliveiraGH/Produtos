@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cadastrar Produto</div>

                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="/produtos/update" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <input name="id" type="hidden" value="{{ $produto['id'] }}">
                        <table>
                            <tr>
                                <td><label>Nome:</label></td>
                                <td><input name="nome" value="{{ $produto['nome'] }}" required></td>
                            </tr>
                            <tr>
                                <td><label>Descrição:</label></td>
                                <td><input name="descricao" value="{{ $produto['descricao'] }}" required></td>
                            </tr>
                            <tr>
                                <td><label>Preço:</label></td>
                                <td><input name="valor" type="number" value="{{ $produto['valor'] }}" required></td>
                            </tr>
                            <tr>
                                <td><label>Foto:</label></td>
                                <td><input type='file' name="foto" accept="image/*"/></td>
                                <input name="foto_atual" type="hidden" value="{{ $produto['foto_atual'] }}">
                            </tr>
                        </table>
                        <input type="submit" class="btn-default btn" value="Salvar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
