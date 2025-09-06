@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'server'])

@section('title')
    Jexactyl 伺服器
@endsection

@section('content-header')
    <h1>伺服器設定<small>設定 Jexactyl 的伺服器選項。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('admin.jexactyl.server') }}" method="POST">
                <div class="box
                    @if($enabled == 'true')
                        box-success
                    @else
                        box-danger
                    @endif
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-clock-o"></i> <h3 class="box-title">伺服器續約 <small>設定伺服器續約選項。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">續約系統</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option @if ($enabled == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($enabled == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否必須續約他們的伺服器。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">預設續約計時器</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="default" name="default" class="form-control" value="{{ $default }}" />
                                        <span class="input-group-addon">天</span>
                                    </div>
                                    <p class="text-muted"><small>決定伺服器在首次續約到期前有多少天。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">續約費用</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="cost" name="cost" class="form-control" value="{{ $cost }}" />
                                        <span class="input-group-addon">點數</span>
                                    </div>
                                    <p class="text-muted"><small>決定續約需要花費多少點數。</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box
                    @if($editing == 'true')
                        box-success
                    @else
                        box-danger
                    @endif
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-server"></i> <h3 class="box-title">伺服器設定 <small>設定伺服器選項。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">伺服器資源編輯</label>
                                <div>
                                    <select name="editing" class="form-control">
                                        <option @if ($editing == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($editing == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否可以編輯分配給他們伺服器的資源數量。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">允許刪除伺服器</label>
                                <div>
                                    <select name="deletion" class="form-control">
                                        <option @if ($deletion == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($deletion == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否能夠刪除自己的伺服器。(預設: true)</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! csrf_field() !!}
                <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">儲存變更</button>
            </form>
        </div>
    </div>
@endsection
