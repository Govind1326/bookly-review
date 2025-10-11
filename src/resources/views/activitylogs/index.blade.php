@extends('layouts.app')
@section('title')
Activity Logs
@endsection
@section('main')
    <div class="m-4">
        <div class="row my-5">
            @include('layouts.sidebar')
            <div class="col-md-9">
                @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Activity logs
                    </div>
                    <div class="card-body pb-0">    
                        <div class="table-responsive">
                        <table class="table table-striped mt-3" id="dataTablde">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Time</th>
                                    <th>IP</th>
                                    <th>User</th>
                                    <th>URL</th>
                                    <th>Device</th>
                                    <th>Platform</th>
                                    <th>Browser</th>
                                    <th>Method</th>
                                    <th>Timestamp</th>
                                </tr>
                                <tbody>
                                    @if($logs->isNotEmpty())
                                    @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log->created_at->diffForHumans() }}</td> 
                                        <td>{{ $log->ip }}</td>
                                        <td>{{ $log->user_id }}</td>
                                        <td>{{ $log->url }}</td>
                                        <td>{{ $log->device }}</td>
                                        <td>{{ $log->platform }}</td>
                                        <td>{{ $log->browser }}</td>
                                        <td>{{ $log->method }}</td>
                                        <td>{{ $log->created_at->toFormattedDateString() }}</td> <!-- Display formatted timestamp -->
                                    </tr>
                                @endforeach
                                    @else
                                    <tr>
                                        <td colspan="6">No books found</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </thead>
                        </table>
                    </div>      
                        <nav aria-label="Page navigation " >
                            {{$logs->links()}}
                          </nav>    
                    </div>
                </div>                
            </div>
        </div>       
    </div>
    @endsection
    @section('script')
    
    @endsection