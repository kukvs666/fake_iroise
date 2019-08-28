@extends('layout-mjml')

@section('titre')
    test bdd
@endsection

@section('content')
    <add-product-component in-data="{{ $data }}"></add-product-component>
@endsection
