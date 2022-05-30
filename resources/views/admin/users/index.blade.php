@extends('layouts.app')
@section('title', 'users')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="left">{{ __('All users') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($users->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>email</th>
                                    <th>Purchases</th>
                                    <th>Topups</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{route('client.transactions', $user->id)}}">
                                                <span>{{$user->transactions->count()}}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('client.topups.list', $user->id)}}">
                                                <span>{{optional(optional($user->account)->topups)->count()}}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{route('client.transactions', $user->id)}}" class="btn btn-outline-info"> View Purchases</a>
                                            <a href="{{route('client.topups.list', $user->id)}}" class="btn btn-outline-secondary"> Show Topups</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$users->links()}}
                        @else
                            <div class="alert alert-info">
                                No Product Added Yet!
                            </div>
                        @endif

                    </div>
                </div>
                <form method="post" id="delete-form" class="hide">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).on('click', '.btn-delete', function(e){
            e.preventDefault();
            let btn = $(this);
            let link = btn.attr('href');
            swal.fire({
                title:'are you sure?',
                text : 'This Product Will Be delete. No Revert!',
                icon: 'warning',
                showConfirmButton:true,
                showCancelButton:true
            }).then((result) =>{
                if(result.isConfirmed)
                {
                    // submit delete form
                    let form = $('#delete-form');
                    form.attr('action', link);
                    form.submit();

                }
            })
        })
    </script>

@endsection
