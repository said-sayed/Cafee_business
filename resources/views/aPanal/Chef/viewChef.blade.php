@extends('aPanal._Layout')
@section('title', 'register')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Chef</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Chef</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- general form elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">All Chef</h3>
    </div>

    <!-- Errorrs -->
    <div class="card-body ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom mb-5">
                        <div>
                            <h3>All Items</h3>
                        </div>

                    </div>


                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">index</th>
                                <th scope="col">Name</th>
                                <th scope="col">Job Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Socail</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach ($chefs as $chef)

                            <tr>
                                <td class="">{{$index}}</td>
                                <td class="">{{$chef->name}}</td>
                                <td class="">{{$chef->job_title}}</td>
                                
                                <td class=""><img style="width:60px;height:50px" src="{{asset("Images/Chef/$chef->image")}}" alt=""></td>
                                <td><a href='{{url("/dashboard/chef/social/$chef->id")}}'><button class="btn btn-success">to Social</button></a></td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button class="btn btn-primary " ><a class="text-white" href="{{url("/dashboard/chef/$chef->id/edit")}}">Edit</a>  </button>
                                        </div>
                                        <div class="col-md-3">
                                            <form action="{{url("/dashboard/chef/$chef->id")}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('do you really want to delete post?')">delete </button>
                                            </form>
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