<div class="table-responsive">
    <table class="table" id="users-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Content</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($systemSettings as $setting)
            <tr>
                <td>{{ $setting->name }}</td>
                <td>{{ $setting->content }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <a href="{{ route('system_settings.edit', [$setting->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
