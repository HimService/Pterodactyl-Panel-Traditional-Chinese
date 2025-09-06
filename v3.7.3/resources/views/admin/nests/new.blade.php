@extends('layouts.admin')

@section('title')
    新巢
@endsection

@section('content-header')
    <h1>新巢<small>設定要部署到所有節點的新巢。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.nests') }}">巢</a></li>
        <li class="active">新增</li>
    </ol>
@endsection

@section('content')
<form action="{{ route('admin.nests.new') }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">新巢</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">名稱</label>
                        <div>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
                            <p class="text-muted"><small>這應該是一個描述性的類別名稱，其中包含巢中的所有環境。</small></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">說明</label>
                        <div>
                            <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">巢可見性</label>
                        <div>
                            <select name="private" class="form-control">
                                <option selected value="0">公開</option>
                                <option value="1">私人</option>
                            </select>
                            <p class="text-muted"><small>確定使用者是否可以部署到此巢。</small></p>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary pull-right">儲存</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
