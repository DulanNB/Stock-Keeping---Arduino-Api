
@extends('layouts.admin')

@section('main-content')

    <div id="content-wrapper" class="d-flex flex-column">

        <section class="content-header">
            <h1>

                Users Management
                <small></small>
            </h1>


        </section>


        <!-- Main content -->
        <div id="content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">User Management</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-lg-12 margin-tb">

                                <div class="fa-pull-right mb-3">
                                    @can('user-create')
                                        <a class="btn btn-success" href="{{ route('admin.user.create') }}"> Create New
                                            User</a>
                                    @endcan
                                </div>
                            </div>


                            @if ($message = Session::get('success'))
                                <div class="alert alert-success" style="margin-top: 50px">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif


                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="280px">Action</th>
                                </tr>
                                @foreach ($dataa as $key => $user)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <label class="badge badge-success">{{ $v }}</label>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-info"
                                               href="{{ route('admin.user.show',$user->id) }}">Show</a>
                                            @can('user-edit')
                                                <a class="btn btn-primary"
                                                   href="{{ route('admin.user.edit',$user->id) }}">Edit</a>
                                            @endcan
                                            @can('user-delete')
                                                {!! Form::open(['method' => 'DELETE','route' => ['admin.user.destroy', $user->id],'style'=>'display:inline']) !!}
                                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                        {!! $dataa->render() !!}



                        <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>

                </div>

            </div>

        </div>
    </div>



@endsection
