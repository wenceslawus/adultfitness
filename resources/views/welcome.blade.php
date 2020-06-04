@extends('layouts.app')

@section('ssr')
  @if(isset($ssr))
    {!! $ssr !!}
  @endif
@endsection
