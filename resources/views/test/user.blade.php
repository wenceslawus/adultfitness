@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ action('SiteController@counter', ['column' => 'dislikes', 'id' => 2]) }}" >

                    <!--  <form method="POST" action="{{ action('SubscriptionsController@store') }}" enctype="multipart/form-data"> -->
                    <!--<input type="text" name="_method" value="DELETE">-->
                    <input type="text" name="api_token" value="admin_token">
                   <!-- <input type="number" name="id_videos" value="2">
                        @include('test.form-block', ['title' => 'Comment', 'name' => 'comments', 'type' => 'text'])-->
                   

                        

                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('SEND') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
