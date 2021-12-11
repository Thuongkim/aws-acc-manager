@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1>Destroy AWS resource: {{$account->aws_id . ' - ' . $account->email}}</h1>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    <div class="clearfix"></div>

    <div class="card">
        <div class="card-body p-0">
            <a href="/{{$logFile}}" target="_blank" style="padding: 10px;">Raw content</a>
            <div id="messages" style="width: 100%; background-color: black; color: #fff; max-height: 100%; overflow-y: auto; font-size: 13px; padding: 10px;"></div>

            <div class="card-footer clearfix">
                <div class="float-right">

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    let url = "{{route('accounts.removeAWSResourceStream', ['id' => $id])}}";
    let stream = new EventSource(url, { withCredentials: true });
    list = document.querySelector('#messages');

    stream.onmessage = function (e) {
        log = JSON.parse(e.data);
        list.innerHTML = log.join('<br/>');
    };
</script>
@endsection
