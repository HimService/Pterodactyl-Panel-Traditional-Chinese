@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'appearance'])

@section('title')
    主題設定
@endsection

@section('content-header')
    <h1>Jexactyl 外觀<small>設定 Jexactyl 的主題。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
    <div class="row">
        <div class="col-xs-12">
            <form action="{{ route('admin.jexactyl.appearance') }}" method="POST">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">一般設定 <small>設定一般外觀設定。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">面板名稱</label>
                                <div>
                                    <input type="text" class="form-control" name="app:name" value="{{ old('app:name', config('app.name')) }}" />
                                    <p class="text-muted"><small>這是整個面板和傳送給用戶端的電子郵件中使用的名稱。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Panel Logo</label>
                                <div>
                                    <input type="text" class="form-control" name="app:logo" value="{{ $logo }}" />
                                    <p class="text-muted"><small>The logo which is used for the Panel&apos;s frontend.</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">主題設定 <small>Jexactyl 主題的選擇。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">管理主題</label>
                                <div>
                                    <select name="theme:admin" class="form-control">
                                        <option @if ($admin == 'jexactyl') selected @endif value="jexactyl">預設主題</option>
                                        <option @if ($admin == 'dark') selected @endif value="dark">深色主題</option>
                                        <option @if ($admin == 'light') selected @endif value="light">淺色主題</option>
                                        <option @if ($admin == 'blue') selected @endif value="blue">藍色主題</option>
                                        <option @if ($admin == 'minecraft') selected @endif value="minecraft">Minecraft&#8482; 主題</option>
                                    </select>
                                    <p class="text-muted"><small>決定 Jexactyl 管理介面的主題。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">用戶端背景</label>
                                <div>
                                    <input type="text" class="form-control" name="theme:user:background" value="{{ old('theme:user:background', config('theme.user.background')) }}" />
                                    <p class="text-muted"><small>如果您在此處輸入 URL，用戶端頁面將以您的圖片作為頁面背景。</small></p>
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
