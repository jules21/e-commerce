@extends('layouts.app')
@section('title', 'products')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="left">{{ __('Account Topups') }}</span>
                        <a href="{{route('client.topups.from')}}" class="btn btn-primary align-self-end ml-10 right">Add Topup</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="div">
                            <p class="font-weight-bold">Total Amount :${{auth()->user()->account->amount}}</p>
                        </div>

                        @if($topups->count() > 0)
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Amount</th>
                                    <th>Creation Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topups as $topup)
                                    <tr>
                                        <td>{{$topup->account->account_number}}</td>
                                        <td>{{$topup->amount}}</td>
                                        <td>{{$topup->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="alert alert-info">
                                No Topup Done Yet!
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
