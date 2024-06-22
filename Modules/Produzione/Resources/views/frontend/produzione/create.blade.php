@extends('frontend.layouts.frontend_app')

@section('title')
    {{ __($module_title) }}
@endsection

@section('content')
<x-frontend.layouts.produzione.produzione_create :module_name="$module_name" :module_path="$module_path" :module_title="$module_title" :module_icon="$module_icon" :module_action="$module_action" :products="$products" :users="$users" :progressivo="$progressivo" />
@endsection