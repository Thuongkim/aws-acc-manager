<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
        <tr>
            <th>Aws Id</th>
        <th>Arn</th>
        <th>Email</th>
        <th>Name</th>
        <th>Status</th>
        <th>Joined Method</th>
        <th>Joined At</th>
        <th>Aws Access Key Id</th>
        <th>Aws Secret Access Key</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->aws_id }}</td>
            <td>{{ $account->arn }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->name }}</td>
            <td>{{ $account->status }}</td>
            <td>{{ $account->joined_method }}</td>
            <td>{{ $account->joined_at }}</td>
            <td>{{ $account->aws_access_key_id }}</td>
            <td>{{ $account->aws_secret_access_key }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['accounts.destroy', $account->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('accounts.show', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('accounts.edit', [$account->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
