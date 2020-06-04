@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 text-center">
            <img src="{{ asset('storage/images/98/17/77/42928.jpg') }}" width="90px;">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <!--<form method="POST" action="{{ action('CategoriesController@update', ['id' => '4']) }}" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">-->

                      <form method="POST" action="{{ action('PagesController@update', ['id' => 2]) }}" enctype="multipart/form-data"> 
                        <input type="hidden" name="_method" value="PUT">

                    <input type="text" name="api_token" value="admin_token">
                    <input type="text" name="type" value="blog">
                        @include('test.form-block', ['title' => 'Заголовок', 'name' => 'title', 'type' => 'text', 'lang' => true])

                        @include('test.form-block', ['title' => 'Picture', 'name' => 'preview', 'type' => 'file'])

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
