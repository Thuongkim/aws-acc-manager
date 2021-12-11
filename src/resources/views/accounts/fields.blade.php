<!-- Aws Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aws_id', 'Aws Id:') !!}
    {!! Form::text('aws_id', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Arn Field -->
<div class="form-group col-sm-6">
    {!! Form::label('arn', 'Arn:') !!}
    {!! Form::text('arn', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Joined Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('joined_method', 'Joined Method:') !!}
    {!! Form::text('joined_method', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Joined At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('joined_at', 'Joined At:') !!}
    {!! Form::text('joined_at', null, ['class' => 'form-control','id'=>'joined_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#joined_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Aws Access Key Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aws_access_key_id', 'Aws Access Key Id:') !!}
    {!! Form::text('aws_access_key_id', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<!-- Aws Secret Access Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('aws_secret_access_key', 'Aws Secret Access Key:') !!}
    {!! Form::text('aws_secret_access_key', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
