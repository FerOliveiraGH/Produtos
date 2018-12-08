@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="col-md-6 text-center">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Controle de produtos</h4>
                            </div>
                            <div class="col-md-12">
                                <a href="produtos"><button class="btn-default btn" >Lista</button></a>
                                <a href="produtos/create"><button class="btn-default btn" >Cadastrar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
