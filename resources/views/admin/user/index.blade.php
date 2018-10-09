@extends('admin.layouts.iframe')

@section('css')
    <link rel="stylesheet" href="/vendor/adminlte/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('js')
    <script src="/vendor/adminlte/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/adminlte/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection

@section('script')
    <script>
        var $table = $('#J_users').DataTable({
            'processing': true,
            'serverSide': true,
            'ajax': {
                url: '/api/user',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            },
            'columnDefs': [
                {'orderable': false, 'targets': -1}
            ],
            'columns': [
                {data: 'id'},
                {data: 'mobile'},
                {data: 'roles'},
                {data: 'created_at'},
                {data: 'actions', orderable: false, searchable: false}
            ]
        });

        $table.on('click', '.J_delete', function () {
            var $this = $(this);
            if (confirm('您确定删除此行？')) {
                $$.ajax({
                    url: '/api/user/' + $this.data('id'),
                    type: 'DELETE',
                    success: function () {
                        $$.toast({
                            type: 'info',
                            title: '已成功删除此行数据'
                        });
                        $table.draw();
                    }
                });
            } else {
                $$.toast({
                    type: 'warning',
                    title: '未删除任何数据，请放心'
                });
            }
        });
    </script>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-primary" ma-tab="创建用户"><i class="fa fa-plus"></i>
                            新用户</a>
                    </div>
                    <div class="box-body">
                        <table id="J_users" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mobile</th>
                                <th>Roles</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Mobile</th>
                                <th>Roles</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection