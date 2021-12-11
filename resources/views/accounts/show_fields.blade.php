<!-- Aws Id Field -->
<div class="col-sm-12">
    {!! Form::label('aws_id', 'Aws Id:') !!}
    <p>{{ $account->aws_id }}</p>
</div>

<!-- Arn Field -->
<div class="col-sm-12">
    {!! Form::label('arn', 'Arn:') !!}
    <p>{{ $account->arn }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $account->email }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $account->name }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $account->status }}</p>
</div>

<!-- Joined Method Field -->
<div class="col-sm-12">
    {!! Form::label('joined_method', 'Joined Method:') !!}
    <p>{{ $account->joined_method }}</p>
</div>

<!-- Joined At Field -->
<div class="col-sm-12">
    {!! Form::label('joined_at', 'Joined At:') !!}
    <p>{{ $account->joined_at }}</p>
</div>

<!-- Aws Access Key Id Field -->
<div class="col-sm-12">
    {!! Form::label('aws_access_key_id', 'Aws Access Key Id:') !!}
    <p>{{ $account->aws_access_key_id }}</p>
</div>

<!-- Aws Secret Access Key Field -->
<div class="col-sm-12">
    {!! Form::label('aws_secret_access_key', 'Aws Secret Access Key:') !!}
    <p>{{ $account->aws_secret_access_key }}</p>
</div>

