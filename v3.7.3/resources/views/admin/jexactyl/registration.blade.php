@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'registration'])

@section('title')
    Jexactyl 設定
@endsection

@section('content-header')
    <h1>使用者註冊<small>設定 Jexactyl 的使用者註冊選項。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
@yield('jexactyl::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('admin.jexactyl.registration') }}" method="POST">
                <div class="box
                @if($enabled == 'true') box-success @else box-danger @endif">
                    <div class="box-header with-border">
                        <i class="fa fa-at"></i> <h3 class="box-title">透過電子郵件註冊 <small>電子郵件註冊和登入的設定。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">啟用</label>
                                <div>
                                    <select name="registration:enabled" class="form-control">
                                        <option @if ($enabled == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($enabled == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否可以使用電子郵件註冊帳戶。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">電子郵件驗證</label>
                                <div>
                                    <select name="registration:verification" class="form-control">
                                        <option @if ($verification == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($verification == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否需要驗證其電子郵件才能建立伺服器。</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box @if($discord_enabled == 'true') box-success @else box-danger @endif">
                    <div class="box-header with-border">
                        <i class="fa fa-comments-o"></i> <h3 class="box-title">透過 Discord 註冊 <small>Discord 註冊和登入的設定。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">啟用</label>
                                <div>
                                    <select name="discord:enabled" class="form-control">
                                        <option @if ($discord_enabled == 'false') selected @endif value="false">禁用</option>
                                        <option @if ($discord_enabled == 'true') selected @endif value="true">啟用</option>
                                    </select>
                                    @if($discord_enabled != 'true')
                                        <p class="text-danger">如果禁用此選項，使用者將無法使用 Discord 註冊或登入！</p>
                                    @else
                                        <p class="text-muted"><small>決定使用者是否可以使用 Discord 註冊帳戶。</small></p>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Discord 用戶端 ID</label>
                                <div>
                                    <input type="text" class="form-control" name="discord:id" value="{{ $discord_id }}" />
                                    <p class="text-muted"><small>您的 OAuth 應用程式的用戶端 ID。通常為 17-20 位數字。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Discord 用戶端密鑰</label>
                                <div>
                                    <input type="password" class="form-control" name="discord:secret" value="{{ $discord_secret }}" />
                                    <p class="text-muted"><small>您的 OAuth 應用程式的用戶端密鑰。請像密碼一樣對待它。</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <i class="fa fa-microchip"></i> <h3 class="box-title">預設資源 <small>註冊時分配給使用者的預設資源。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">CPU 數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:cpu" value="{{ $cpu }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的 CPU 數量（%）。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">RAM 數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:memory" value="{{ $memory }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的 RAM 數量（MB）。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">儲存空間量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:disk" value="{{ $disk }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的儲存空間量（MB）。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">伺服器槽位數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:slot" value="{{ $slot }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的伺服器槽位數量。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">網路分配數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:port" value="{{ $port }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的伺服器端口數量。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">備份數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:backup" value="{{ $backup }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的伺服器備份數量。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">資料庫數量</label>
                                <div>
                                    <input type="text" class="form-control" name="registration:database" value="{{ $database }}" />
                                    <p class="text-muted"><small>註冊時應給予使用者的伺服器資料庫數量。</small></p>
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
