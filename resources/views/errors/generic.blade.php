@extends('layouts.error')

@section('title')
    {{ isset($title) ? $title : __('Whoops, looks like something went wrong. Check your kartsnms.log.') }}
@endsection

@section('content')
    {{ isset($content) ? $content : '' }}
@endsection
