@extends('admin.master')
@section('title', 'Admin Control Panel')
@section('content')
    <div id="app">
        <main id="home-buttons" class="container-fluid">
            <h1>maguttiCms Admin</h1>
            <dashboard-component></dashboard-component>
        </main>
    </div>
@endsection
