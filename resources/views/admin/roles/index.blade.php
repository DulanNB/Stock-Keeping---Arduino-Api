@extends('layouts.admin')

@section('main-content')
    <div id="content-wrapper" class="d-flex flex-column">
        <section class="content-header">
            <h1>

                Role Management

                <small></small>
            </h1>


        </section>

        <div id="content">
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="fa-pull-right mb-3" >
                                        @can('role-create')
                                            <a class="btn btn-success" href="{{ route('admin.role.create') }}"> Create
                                                New Role</a>
                                        @endcan
                                    </div>


                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success" style="margin-top: 50px">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif


                                    <table class="table table-bordered">
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th width="280px">Action</th>
                                        </tr>
                                        @foreach ($roles as $key => $role)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>
                                                    <a class="btn btn-info"
                                                       href="{{ route('admin.role.show',$role->id) }}">Show</a>
                                                    @can('role-edit')
                                                        <a class="btn btn-primary"
                                                           href="{{ route('admin.role.edit',$role->id) }}">Edit</a>
                                                    @endcan
                                                    @can('role-delete')
                                                        {!! Form::open(['method' => 'DELETE','route' => ['admin.role.destroy', $role->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            {!! $roles->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
