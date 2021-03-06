@php
use Carbon\Carbon;
@endphp

@extends('adminlte::page')

@section('title', Session::has('brand_sistema') ? Session::get('brand_sistema') : config('adminlte.title'))

@section('content_header')
<span style="font-size:20px">
    <i class="fas fa-fw fa-users"></i> Cadastro de Usuários
</span>

{{ Breadcrumbs::render('users_show') }}
@stop

@section('content')
<div class="card card-primary card-outline">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th style="width:18%">ID</th>
                    <td>{{ $user->id }}</td>
                </tr>

                <tr>
                    <th>Nome do Usuário</th>
                    <td>{{ $user->name }}</td>
                </tr>

                <tr>
                    <th>E-mail</th>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <th>Usuário Ativo?</th>
                    <td>
                        @if($user->active)
                        <span class="badge badge-success">Sim</span>
                        @else
                        <span class="badge badge-danger">Não</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Foto</th>
                    <td>
                        @if($user->getAvatar($user->id))
                        <img src="{{ $user->getAvatar($user->id) }}" id="img-avatar" name="img-avatar" width="50px" class="img-circle elevation-2" alt="Foto do perfil" title="Foto do perfil">
                        @else
                        @if (Gravatar::exists(Auth::user()->email))
                        <img src="{{ Gravatar::get(Auth::user()->email) }}" id="img-avatar" name="img-avatar" width="50px" class="img-circle" alt="Foto do perfil" title="Foto do perfil">
                        @else
                        <img src="{{ asset('img/avatares/Others/no-photo.png') }}" id="img-avatar" name="img-avatar" width="50px" class="img-circle" alt="Foto do perfil" title="Foto do perfil">
                        @endif
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Papéis</th>
                    <td>
                        @foreach($user->roles as $key => $role)
                        <span class="badge badge-primary">{{ $role->title }}</span>
                        @endforeach
                    </td>
                </tr>

                @if(! $user->password)
                <tr>
                    <th>Senha de Acesso</th>
                    <td>
                        <span class="text-red text-bold">Atenção: Este usuário não possui senha definida</span>
                    </td>
                </tr>
                @endif

                <tr>
                    <th>Dias sem acesso</th>
                    <td>
                        <span class="badge badge-danger">
                            @if(null == $user->last_login)
                            {{ (new Carbon($user->created_at))->diffInDays(Carbon::now()) }}
                            @else
                            {{ (new Carbon($user->last_login))->diffInDays(Carbon::now()) }}
                            @endif
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Criado em</th>
                    <td>
                        @if($user->created_at)
                        {{ $user->created_at->format('d/m/Y h:i') }}
                        @else
                        <span class="text-red">Informação não disponível</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Atualizado em</th>
                    <td>
                        @if($user->updated_at)
                        {{ $user->updated_at->format('d/m/Y h:i') }}
                        @else
                        <span class="text-red">Informação não disponível</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        <a href="{{ Session::get('return_path') }}" class="btn btn-default"><i class="fas fa-fw fa-reply"></i> Voltar</a>
    </div>
</div>
@stop

@section('footer')
@include('vendor.adminlte.footer')
@stop

@section('css')
@stop

@section('js')
@stop
