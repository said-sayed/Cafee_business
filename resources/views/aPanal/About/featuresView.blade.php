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
        <div class="container-fluid pt-4">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="d-flex justify-content-between border-bottom mb-5">
                        <div>
                            <h3>All Features</h3>
                        </div>
                        @include('aPanal.About.featureAdd')
                    </div>
                    @if(session()->get('add_success'))
                    <div class="alert alert-success">{{session()->get('add_success')}}</div>
                    @endif
                    @if(session()->get('update_success'))
                    <div class="alert alert-success">{{session()->get('update_success')}}</div>
                    @endif
                    
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
                                <td class="w-75">{{$feature->feature}}</td>


                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalEdit{{$feature->id}}">
                                                Edit
                                            </button>
                                            @include('aPanal.About.featureEdit')
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{url("/dashboard/about/feature/$feature->id")}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('do you really want to delete post?')">delete </button>
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