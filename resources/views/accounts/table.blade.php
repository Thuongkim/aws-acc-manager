<div class="table-responsive">
    <table class="table" id="accounts-table">
        <thead>
        <tr>
            <th>AWS ID</th>
        <th>Email</th>
        <th>Name</th>
        <th>Status</th>
        <th>Joined Method</th>
        <th>Type</th>
        <th>Joined At</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account->aws_id }}</td>
            <td>{{ $account->email }}</td>
            <td>{{ $account->name }}</td>
            <td>{{ $account->status }}</td>
            <td>{{ $account->joined_method }}</td>
            <td>{{ $account->type == 1 ? 'Personal' : 'Project' }}</td>
            <td>{{ $account->joined_at }}</td>
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
                        <a href="{{ route('accounts.removeAWSResource', [$account->id]) }}"
                            class='btn btn-danger btn-xs' onclick="return confirm('Are you sure?')">
                             <i class="far fa-trash-alt"></i>
                         </a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
