@extends('layouts.app')

@section('content')

<a href="/{{$logFile}}" target="_blank">Raw content</a>
<div id="messages" style="width: 100%; background-color: black; color: #fff; max-height: 100%; overflow-y: auto; font-size: 13px;"></div>

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
