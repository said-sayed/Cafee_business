@extends('aPanal._Layout')
@section('title', 'register')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Admins</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- general form elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">All Admins</h3>
    </div>

    <!-- Errorrs -->
    <div class="card-body ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom mb-5">
                        <div>
                            <h3>All Admins</h3>
                        </div>
                    </div>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">index</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach ($admins as $admin)

                            <tr>
                                <td class="">{{$index}}</td>
                                <td class="">{{$admin->name}}</td>
                                <td class="">{{$admin->email}}</td>
                                
                                <td>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <button class="btn btn-primary " ><a class="text-white" href='{{url("/dashboard/admin/$admin->id/edit")}}'>Edit</a>  </button>
                                        </div>
                                        @if($admin->id != 1)
                                        <div class="col-md-3">
                                            <form action='{{url("/dashboard/admin/$admin->id")}}' method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('do you really want to delete post?')">delete </button>
                                            </form>
                                        </div>
                                        @endif
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