@extends('layouts.admin')
@include('partials/admin.jexactyl.nav', ['activeTab' => 'referrals'])

@section('title')
    推薦系統
@endsection

@section('content-header')
    <h1>推薦系統<small>允許使用者推薦他人加入面板以賺取資源。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li class="active">Jexactyl</li>
    </ol>
@endsection

@section('content')
    @yield('jexactyl::nav')
    <div class="row">
        <div class="col-xs-12">
        <form action="{{ route('admin.jexactyl.referrals') }}" method="POST">
                <div class="box
                    @if($enabled == 'true')
                        box-success
                    @else
                        box-danger
                    @endif
                ">
                    <div class="box-header with-border">
                        <i class="fa fa-user-plus"></i> <h3 class="box-title">推薦 <small>允許使用者推薦他人加入面板。</small></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="control-label">推薦系統</label>
                                <div>
                                    <select name="enabled" class="form-control">
                                        <option @if ($enabled == 'false') selected @endif value="false">已停用</option>
                                        <option @if ($enabled == 'true') selected @endif value="true">已啟用</option>
                                    </select>
                                    <p class="text-muted"><small>決定使用者是否可以推薦他人。</small></p>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">每次推薦獎勵</label>
                                <div>
                                    <div class="input-group">
                                        <input type="text" id="reward" name="reward" class="form-control" value="{{ $reward }}" />
                                        <span class="input-group-addon">點數</span>
                                    </div>
                                    <p class="text-muted"><small>當使用者推薦某人以及某人使用推薦代碼時給予使用者的點數金額。</small></p>
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
