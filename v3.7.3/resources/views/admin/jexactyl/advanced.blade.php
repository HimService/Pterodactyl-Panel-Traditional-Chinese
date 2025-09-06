@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'advanced'])

@section('title')
    進階
@endsection

@section('content-header')
    <h1>進階<small>為面板設定進階設定。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
        <form action="{{ route('admin.jexactyl.advanced') }}" method="POST">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">安全性設定</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">需要兩步驟驗證</label>
                                    <div>
                                        <div class="btn-group" data-toggle="buttons">
                                            @php
                                                $level = old('jexactyl:auth:2fa_required', config('jexactyl.auth.2fa_required'));
                                            @endphp
                                            <label class="btn btn-primary @if ($level == 0) active @endif">
                                                <input type="radio" name="jexactyl:auth:2fa_required" autocomplete="off" value="0" @if ($level == 0) checked @endif> 不需要
                                            </label>
                                            <label class="btn btn-primary @if ($level == 1) active @endif">
                                                <input type="radio" name="jexactyl:auth:2fa_required" autocomplete="off" value="1" @if ($level == 1) checked @endif> 僅限管理員
                                            </label>
                                            <label class="btn btn-primary @if ($level == 2) active @endif">
                                                <input type="radio" name="jexactyl:auth:2fa_required" autocomplete="off" value="2" @if ($level == 2) checked @endif> 所有使用者
                                            </label>
                                        </div>
                                        <p class="text-muted"><small>如果啟用，任何屬於所選群組的帳戶都必須啟用兩步驟驗證才能使用面板。</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">reCAPTCHA</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">狀態</label>
                                    <div>
                                        <select class="form-control" name="recaptcha:enabled">
                                            <option value="true">已啟用</option>
                                            <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>已停用</option>
                                        </select>
                                        <p class="text-muted small">如果啟用，登入表單和密碼重設表單將執行無訊息驗證碼檢查，並在需要時顯示可見的驗證碼。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">網站金鑰</label>
                                    <div>
                                        <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">密鑰</label>
                                    <div>
                                        <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                        <p class="text-muted small">用於您的網站與 Google 之間的通訊。請務必保密。</p>
                                    </div>
                                </div>
                            </div>
                            @if($warning)
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="alert alert-warning no-margin">
                                            您目前正在使用此面板隨附的 reCAPTCHA 金鑰。為了提高安全性，建議<a href="https://www.google.com/recaptcha/admin">產生專門與您的網站綁定的新隱形 reCAPTCHA 金鑰</a>。
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">HTTP 連線</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="control-label">連線逾時</label>
                                    <div>
                                        <input type="number" required class="form-control" name="jexactyl:guzzle:connect_timeout" value="{{ old('jexactyl:guzzle:connect_timeout', config('jexactyl.guzzle.connect_timeout')) }}">
                                        <p class="text-muted small">在擲回錯誤之前等待開啟連線的秒數。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">請求逾時</label>
                                    <div>
                                        <input type="number" required class="form-control" name="jexactyl:guzzle:timeout" value="{{ old('jexactyl:guzzle:timeout', config('jexactyl.guzzle.timeout')) }}">
                                        <p class="text-muted small">在擲回錯誤之前等待請求完成的秒數。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">自動建立分配</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label">狀態</label>
                                    <div>
                                        <select class="form-control" name="jexactyl:client_features:allocations:enabled">
                                            <option value="false">已停用</option>
                                            <option value="true" @if(old('jexactyl:client_features:allocations:enabled', config('jexactyl.client_features.allocations.enabled'))) selected @endif>已啟用</option>
                                        </select>
                                        <p class="text-muted small">如果啟用，使用者將可以選擇透過前端為其伺服器自動建立新的分配。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">起始連接埠</label>
                                    <div>
                                        <input type="number" class="form-control" name="jexactyl:client_features:allocations:range_start" value="{{ old('jexactyl:client_features:allocations:range_start', config('jexactyl.client_features.allocations.range_start')) }}">
                                        <p class="text-muted small">可自動分配範圍中的起始連接埠。</p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label">結束連接埠</label>
                                    <div>
                                        <input type="number" class="form-control" name="jexactyl:client_features:allocations:range_end" value="{{ old('jexactyl:client_features:allocations:range_end', config('jexactyl.client_features.allocations.range_end')) }}">
                                        <p class="text-muted small">可自動分配範圍中的結束連接埠。</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <button type="submit" name="_method" value="PATCH" class="btn btn-default pull-right">儲存設定</button>
                </div>
            </div>
        </form>
@endsection
