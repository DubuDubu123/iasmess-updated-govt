<div class="box-body no-padding">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>@lang('view_pages.s_no')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.name')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.email')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.role')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.created_by')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.updated_by')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.status')<span style="float: right;"></span></th>
                    <th>@lang('view_pages.action')<span style="float: right;"></span></th>
                </tr>
            </thead>
            <tbody>
    @if(count($results) < 1)
        <tr>
            <td colspan="8">
                <p id="no_data" class="lead no-data text-center">
                    <img src="{{ asset('assets/img/dark-data.svg') }}" style="width:150px;margin-top:25px;margin-bottom:25px;" alt="">
                    <h4 class="text-center" style="color:#333;font-size:25px;">@lang('view_pages.no_data_found')</h4>
                </p>
            </td>
        </tr>
    @else
        @php $i = $results->firstItem(); @endphp
        @foreach($results as $key => $result)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ ucfirst($result->name) }}</td>
                <td>{{ $result->email }}</td>
                <td>{{ $result->role_name ?? __('view_pages.no_role_assigned') }}</td>
                <td>{{ $result->created_by_name ?? 'Admin' }}</td>
                <td>{{ $result->updated_by_name ?? 'Admin' }}</td>
                <td>
                    <button class="btn btn-sm {{ $result->active ? 'btn-success' : 'btn-danger' }}">
                        @lang($result->active ? 'view_pages.active' : 'view_pages.inactive')
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('view_pages.action')</button>
                    <div class="dropdown-menu">
                        @if(auth()->user()->can('edit-admin'))
                            <a class="dropdown-item" href="{{ url('admins/edit', $result->id) }}">
                                <i class="fa fa-pencil"></i>@lang('view_pages.edit')
                            </a>
                        @endif
                        @if(auth()->user()->can('delete-admin') && $result->user)
                            <a class="dropdown-item sweet-delete" href="#" data-url="{{ url('admins/delete', $result->id) }}">
                                <i class="fa fa-trash-o"></i>@lang('view_pages.delete')
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    @endif
</tbody>


        </table>

        <div class="text-right">
            <span style="float:right">
                {{ $results->links() }}
            </span>
        </div>
    </div>
</div>

<style>
.btn-success {
    background-color: #008000;
    border-color: #008000;
}

.btn-danger {
    background-color: #ff0000;
    border-color: #ff0000;
}
</style>
