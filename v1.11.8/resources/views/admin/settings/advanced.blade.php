@extends('layouts.admin')
@include('partials/admin.settings.nav', ['activeTab' => 'advanced'])

@section('title')
    進階設定
@endsection

@section('content-header')
    <h1>進階設定<small>設定 Pterodactyl 的進階選項。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">設定</li>
    </ol>
@endsection

@section('content')
    @yield('settings::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="" method="POST">
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
                                        <option value="true">啟用</option>
                                        <option value="false" @if(old('recaptcha:enabled', config('recaptcha.enabled')) == '0') selected @endif>停用</option>
                                    </select>
                                    <p class="text-muted small">如果啟用，登入表單和密碼重設表單將會進行無訊息的驗證碼檢查，並在需要時顯示可見的驗證碼。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">網站金鑰</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:website_key" value="{{ old('recaptcha:website_key', config('recaptcha.website_key')) }}">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">私密金鑰</label>
                                <div>
                                    <input type="text" required class="form-control" name="recaptcha:secret_key" value="{{ old('recaptcha:secret_key', config('recaptcha.secret_key')) }}">
                                    <p class="text-muted small">用於您的網站與 Google 之間的通訊。請務必保密。</p>
                                </div>
                            </div>
                        </div>
                        @if($showRecaptchaWarning)
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="alert alert-warning no-margin">
                                        您目前使用的是此面板隨附的 reCAPTCHA 金鑰。為提高安全性，建議您<a href="https://www.google.com/recaptcha/admin">產生新的隱形 reCAPTCHA 金鑰</a>，並將其與您的網站專門綁定。
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
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:connect_timeout" value="{{ old('pterodactyl:guzzle:connect_timeout', config('pterodactyl.guzzle.connect_timeout')) }}">
                                    <p class="text-muted small">在擲出錯誤之前等待連線開啟的時間（以秒為單位）。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">請求逾時</label>
                                <div>
                                    <input type="number" required class="form-control" name="pterodactyl:guzzle:timeout" value="{{ old('pterodactyl:guzzle:timeout', config('pterodactyl.guzzle.timeout')) }}">
                                    <p class="text-muted small">在擲出錯誤之前等待請求完成的時間（以秒為單位）。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">自動分配建立</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">狀態</label>
                                <div>
                                    <select class="form-control" name="pterodactyl:client_features:allocations:enabled">
                                        <option value="false">停用</option>
                                        <option value="true" @if(old('pterodactyl:client_features:allocations:enabled', config('pterodactyl.client_features.allocations.enabled'))) selected @endif>啟用</option>
                                    </select>
                                    <p class="text-muted small">如果啟用，使用者將可以選擇透過前端為其伺服器自動建立新的分配。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">起始連接埠</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_start" value="{{ old('pterodactyl:client_features:allocations:range_start', config('pterodactyl.client_features.allocations.range_start')) }}">
                                    <p class="text-muted small">可自動分配範圍中的起始連接埠。</p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">結束連接埠</label>
                                <div>
                                    <input type="number" class="form-control" name="pterodactyl:client_features:allocations:range_end" value="{{ old('pterodactyl:client_features:allocations:range_end', config('pterodactyl.client_features.allocations.range_end')) }}">
                                    <p class="text-muted small">可自動分配範圍中的結束連接埠。</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="submit" name="_method" value="PATCH" class="btn btn-sm btn-primary pull-right">儲存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
