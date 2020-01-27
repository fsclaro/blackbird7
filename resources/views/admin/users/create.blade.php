@extends('adminlte::page')

@section('title', Session::has('brand_sistema') ? Session::get('brand_sistema') : config('adminlte.title'))

@section('content_header')
<span style="font-size:20px"> <i class="fas fa-fw fa-users"></i> Cadastro de Usuários</span>
{{ Breadcrumbs::render('users_create') }}
@stop

@section('content')

<form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="card">
        <div class="card-header">
            <i class="fas fa-user-plus"></i> Cadastramento de novo usuário
        </div>

        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <!-- lado esquerdo -->
                    <div class="col-md-3">
                        <div class="image text-center">
                            <label for="foto">Foto do Usuário</label>
                            <br />

                            <img src="{{ asset('img/avatares/no-photo.png') }}" id="img-avatar" name="img-avatar" width="120px" class="img-circle" alt="Foto do perfil" title="Foto do perfil">

                            <div class="row">&nbsp;</div>

                            <div class="btn-group-sm center-block" role="group">
                                <div class="btn btn-success btn-flat div-avatar">
                                    <input type="file" id="avatar" name="avatar" class="input-avatar" onchange="changeAvatar(event);">
                                    <span><i class="fas fa-fw fa-camera"></i> Nova Foto</span>
                                </div>
                            </div>
                        </div>
                    </div> <!-- col-sm-3 -->

                    <!-- lado direito -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} col-md-8">
                                <label for="name">Nome do Usuário
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', '') }}">

                                @if($errors->has('name'))
                                <small class="form-text text-red text-bold">
                                    {{ $errors->first('name') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }} col-md-5">
                                <label for="title">Email
                                    <span class="text-red">*</span>
                                </label>
                                <input type="text" id="email" name="email" class="form-control" value="{{ old('email', '') }}">

                                @if($errors->has('email'))
                                <small class="form-text text-red text-bold">
                                    {{ $errors->first('email') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }} col-md-5">
                                <label for="active">Ativar o usuário?
                                    <span class="text-red">*</span>
                                </label>

                                <select id="active" name="active" class="form-control">
                                    <option>Selecione uma das opções...</option>
                                    <option value=0>Não - O usuário não poderá acessar o sistema</option>
                                    <option value=1>Sim - O usuário poderá acessar o sistema</option>
                                </select>

                                @if($errors->has('active'))
                                <small class="form-text text-red text-bold">
                                    {{ $errors->first('active') }}
                                </small>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} col-md-6">
                                <label for="title">Senha</label>
                                <input type="password" id="password" name="password" class="form-control" value="" placeholder="A senha deve ter pelo menos 8 caracteres">

                                @if($errors->has('password'))
                                <small class="form-text text-red text-bold">
                                    @endif
                                    {{ $errors->first('password') }}
                                </small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }} col-md-4">
                                <label for="roles">Papel
                                    <span class="text-red">*</span>
                                </label>

                                <select name="roles[]" id="roles" class="select2 form-control">
                                    @foreach($roles as $id => $roles)
                                    @if($roles == "SuperAdmin")
                                        @continue
                                    @endif
                                    <option value="{{ $id }}">{{ $roles }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('roles'))
                                <small class="form-text text-red text-bold">
                                    {{ $errors->first('roles') }}
                                </small>
                                @endif
                            </div>
                        </div>
                    </div> <!-- col-sm-9 -->
                </div>
            </div>
        </div> <!-- panel-body -->

        <div class="card-footer">
            <a href="{{ route('admin.users.index') }}" class="btn btn-flat btn-default"><i class="fas fa-fw fa-reply"></i> Voltar</a>
            <button type="submit" class="btn btn-flat btn-success"><i class="fas fa-fw fa-save"></i> Salvar</button>
        </div> <!-- panel-footer -->
    </div> <!-- panel panel-default -->
</form>
@stop

@section('footer')
@include('vendor.adminlte.footer')
@stop

@section('css')
<style>
    .div-avatar {
        position: relative;
        overflow: hidden;
    }

    .input-avatar {
        position: absolute;
        font-size: 20px;
        opacity: 0;
        right: 0;
        top: 0;
    }
</style>
@stop

@section('js')
<script>
    $(function() {
        $("#roles").select2({
            placeholder: "Selecione o papel deste usuário",
            allowClear: true,
        });
    });

    function changeAvatar(e) {
        var selectedFile = e.target.files[0];
        var reader = new FileReader();
        var imgTag = document.getElementById("img-avatar");

        imgTag.title = selectedFile.name;

        reader.onload = function(e) {
            imgTag.src = e.target.result;
        }
        reader.readAsDataURL(selectedFile);
    }
</script>
@stop
