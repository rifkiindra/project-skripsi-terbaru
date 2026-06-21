@extends('layouts.tim')

@section('title', 'Dashboard Tim')
@section('page-title', 'Dashboard Tim')

@section('content')

<div class="row">

    <div class="col-lg-6 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $activeProjects ?? 0 }}</h3>
                <p>Project Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-folder-open"></i>
            </div>
            <a href="{{ route('tim.artworks.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-6 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $completedProjects ?? 0 }}</h3>
                <p>Sudah Dikerjakan</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <a href="{{ route('tim.project.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>

@endsection