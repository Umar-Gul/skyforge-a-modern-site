@extends('layouts.app')

@section('title', 'Skyforge Aviation | Engineered to Rise')

@section('content')
    @include('sections.hero')
    @include('sections.aircraft')
    @include('sections.stats')
    @include('sections.statement')
    @include('sections.solutions')
    @include('sections.capabilities')
    @include('sections.news')
    @include('sections.cta')
@endsection
