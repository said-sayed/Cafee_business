@extends('aPanal._Layout')
@section('title', 'register')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>All Bookings</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">All Bookings</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- general form elements disabled -->
<div class="card card-warning w-75 m-auto">
    <div class="card-header">
        <h3 class="card-title">All Bookings</h3>
    </div>

    <!-- Errorrs -->
    <div class="card-body ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between border-bottom mb-5">
                        <div>
                            <h3>All Bookings</h3>
                        </div>
                    </div>
                    <table class="table ">
                        <thead>
                            <tr>
                                <th scope="col">index</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone</th>
                                <th scope="col">#ofPeople</th>
                                <th scope="col">Start Time</th>
                                <th scope="col">Table</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1 ?>
                            @foreach ($bookings as $booking)
                            

                            <tr class="@if($booking->new == 'new') text-danger @endif ">
                                <td class="">{{$index}}</td>
                                <td class="">{{$booking->email}}</td>
                                <td class="">{{$booking->phone}}</td>
                                <td style="width:100px" class="">{{$booking->ofPeople}}</td>
                                <td class="">{{substr($booking->startDateTime, 11)}}</td>
                                <td class="">{{$booking->tables->name}}</td>
                                
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button class="btn btn-primary " ><a class="text-white" href='{{url("dashboard/booking/$booking->id/show")}}'>show</a>  </button>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <form action='{{url("/dashboard/booking/$booking->id")}}' method="post">
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