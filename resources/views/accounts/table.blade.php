<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
        <th>Id</th>
        <th>Account Name</th>
        <th>Email</th>
{{--        <th>Role Name</th>--}}
        <th>Status</th>
{{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <td>{{ $account['Id'] }}</td>
            <td>{{ $account['Name'] }}</td>
            <td>{{ $account['Email'] }}</td>
{{--            <td>{{ $account['password'] }}</td>--}}
            <td>{{ $account['Status'] }}</td>
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['users.destroy', $account['Id']], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('users.show', [$account['Id']]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('users.edit', [$account['Id']]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
