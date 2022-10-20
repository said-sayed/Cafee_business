@extends('aPanal._Layout')
@section('title', 'register')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>View Feature</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">View Feature</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- View Feature elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">View Feature</h3>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
        {{$error}}
        @endforeach
    </div>
    @endif
    <!-- Errorrs -->
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12  ">
                    <div class="d-flex justify-content-between border-bottom mb-5">
                        <div>
                            <h3>All Features</h3>
                        </div>
                        <div>
                            <a href="{{url('/dashboard/feature/create')}}" class="btn btn-sm btn-success">Add new Feature</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">index</th>
                                <th scope="col">Feature</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach ($features as $feature)

                            <tr>
                                <td class="">{{$index}}</td>
                                <td class="w-75">{{$feature->title}}</td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <a  href="{{url("/dashboard/feature/$feature->id")}}" class="btn btn-sm btn-primary p-2">Show</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{url("/dashboard/feature/$feature->id/edit")}}" class="btn btn-sm btn-warning p-2 mx-1">Edit</a>
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{url("/dashboard/feature/$feature->id")}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger p-2" onclick="return confirm('do you really want to delete post?')">delete </button>
                                            </form>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            <?php $index++ ?>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection