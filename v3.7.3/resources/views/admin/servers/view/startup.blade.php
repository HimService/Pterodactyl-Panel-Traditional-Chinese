@extends('layouts.admin')

@section('title')
    伺服器 — {{ $server->name }}: 啟動
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>控制啟動指令以及變數。</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">管理</a></li>
        <li><a href="{{ route('admin.servers') }}">伺服器</a></li>
        <li><a href="{{ route('admin.servers.view', $server->id) }}">{{ $server->name }}</a></li>
        <li class="active">啟動</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<form action="{{ route('admin.servers.view.startup', $server->id) }}" method="POST">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">啟動指令修改</h3>
                </div>
                <div class="box-body">
                    <label for="pStartup" class="form-label">啟動指令</label>
                    <input id="pStartup" name="startup" class="form-control" type="text" value="{{ old('startup', $server->startup) }}" />
                    <p class="small text-muted">在此編輯您伺服器的啟動指令。預設情況下，可以使用以下變數：<code>@{{SERVER_MEMORY}}</code>、<code>@{{SERVER_IP}}</code> 和 <code>@{{SERVER_PORT}}</code>。</p>
                </div>
                <div class="box-body">
                    <label for="pDefaultStartupCommand" class="form-label">預設服務啟動指令</label>
                    <input id="pDefaultStartupCommand" class="form-control" type="text" readonly />
                </div>
                <div class="box-footer">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary btn-sm pull-right">儲存修改</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">服務組態</h3>
                </div>
                <div class="box-body row">
                    <div class="col-xs-12">
                        <p class="small text-danger">
                            變更以下任何值都將導致伺服器處理重新安裝指令。伺服器將被停止然後繼續。
                            如果您不希望執行服務腳本，請確保選中底部的方塊。
                        </p>
                        <p class="small text-danger">
                            <strong>在許多情況下，這是一個破壞性操作。為了繼續此操作，此伺服器將立即停止。</strong>
                        </p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="pNestId">巢</label>
                        <select name="nest_id" id="pNestId" class="form-control">
                            @foreach($nests as $nest)
                                <option value="{{ $nest->id }}"
                                    @if($nest->id === $server->nest_id)
                                        selected
                                    @endif
                                >{{ $nest->name }}</option>
                            @endforeach
                        </select>
                        <p class="small text-muted no-margin">選擇此伺服器將歸入的巢。</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <label for="pEggId">環境</label>
                        <select name="egg_id" id="pEggId" class="form-control"></select>
                        <p class="small text-muted no-margin">選擇將為此伺服器提供處理資料的環境。</p>
                    </div>
                    <div class="form-group col-xs-12">
                        <div class="checkbox checkbox-primary no-margin-bottom">
                            <input id="pSkipScripting" name="skip_scripts" type="checkbox" value="1" @if($server->skip_scripts) checked @endif />
                            <label for="pSkipScripting" class="strong">跳過環境安裝腳本</label>
                        </div>
                        <p class="small text-muted no-margin">如果選定的環境附加了安裝腳本，則該腳本將在安裝過程中執行。如果您想跳過此步驟，請勾選此方塊。</p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Docker 映像組態</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label for="pDockerImage">映像</label>
                        <select id="pDockerImage" name="docker_image" class="form-control"></select>
                        <input id="pDockerImageCustom" name="custom_docker_image" value="{{ old('custom_docker_image') }}" class="form-control" placeholder="或輸入自訂映像..." style="margin-top:1rem"/>
                        <p class="small text-muted no-margin">這是將用於執行此伺服器的 Docker 映像。從下拉式選單中選擇一個映像，或在上面的文字欄位中輸入自訂映像。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row" id="appendVariablesTo"></div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('vendor/lodash/lodash.js') !!}
    <script>
    $(document).ready(function () {
        $('#pEggId').select2({placeholder: '選擇一個巢環境'}).on('change', function () {
            var selectedEgg = _.isNull($(this).val()) ? $(this).find('option').first().val() : $(this).val();
            var parentChain = _.get(Jexactyl.nests, $("#pNestId").val());
            var objectChain = _.get(parentChain, 'eggs.' + selectedEgg);

            const images = _.get(objectChain, 'docker_images', [])
            $('#pDockerImage').html('');
            const keys = Object.keys(images);
            for (let i = 0; i < keys.length; i++) {
                let opt = document.createElement('option');
                opt.value = images[keys[i]];
                opt.innerHTML = keys[i] + " (" + images[keys[i]] + ")";
                if (objectChain.id === parseInt(Jexactyl.server.egg_id) && Jexactyl.server.image == opt.value) {
                    opt.selected = true
                }
                $('#pDockerImage').append(opt);
            }
            $('#pDockerImage').on('change', function () {
                $('#pDockerImageCustom').val('');
            })

            if (objectChain.id === parseInt(Jexactyl.server.egg_id)) {
                if ($('#pDockerImage').val() != Jexactyl.server.image) {
                    $('#pDockerImageCustom').val(Jexactyl.server.image);
                }
            }

            if (!_.get(objectChain, 'startup', false)) {
                $('#pDefaultStartupCommand').val(_.get(parentChain, 'startup', 'ERROR: Startup Not Defined!'));
            } else {
                $('#pDefaultStartupCommand').val(_.get(objectChain, 'startup'));
            }

            $('#appendVariablesTo').html('');
            $.each(_.get(objectChain, 'variables', []), function (i, item) {
                var setValue = _.get(Jexactyl.server_variables, item.env_variable, item.default_value);
                var isRequired = (item.required === 1) ? '<span class="label label-danger">必填</span> ' : '';
                var dataAppend = ' \
                    <div class="col-xs-12"> \
                        <div class="box"> \
                            <div class="box-header with-border"> \
                                <h3 class="box-title">' + isRequired + item.name + '</h3> \
                            </div> \
                            <div class="box-body"> \
                                <input name="environment[' + item.env_variable + ']" class="form-control" type="text" id="egg_variable_' + item.env_variable + '" /> \
                                <p class="no-margin small text-muted">' + item.description + '</p> \
                            </div> \
                            <div class="box-footer"> \
                                <p class="no-margin text-muted small"><strong>啟動指令變數：</strong> <code>' + item.env_variable + '</code></p> \
                                <p class="no-margin text-muted small"><strong>輸入規則：</strong> <code>' + item.rules + '</code></p> \
                            </div> \
                        </div> \
                    </div>';
                $('#appendVariablesTo').append(dataAppend).find('#egg_variable_' + item.env_variable).val(setValue);
            });
        });

        $('#pNestId').select2({placeholder: '選擇一個巢'}).on('change', function () {
            $('#pEggId').html('').select2({
                data: $.map(_.get(Jexactyl.nests, $(this).val() + '.eggs', []), function (item) {
                    return {
                        id: item.id,
                        text: item.name,
                    };
                }),
            });

            if (_.isObject(_.get(Jexactyl.nests, $(this).val() + '.eggs.' + Jexactyl.server.egg_id))) {
                $('#pEggId').val(Jexactyl.server.egg_id);
            }

            $('#pEggId').change();
        }).change();
    });
    </script>
@endsection
