@extends('products.layout')
     
@section('content')
    @php
        $i = 0;
    @endphp
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Disabled</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </div>
              </nav>
              <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                  @if  ( $role=='1')
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500 btn btn-info">Create New User</a>
                  @endif
                </div>
            </div>
            
            <div class="pull-right" style="text-align: right">
                <h2 style="color:royalblue">King Imtiaj Crud Project</h2>
            </div>
            @if  ( $role=='1')
            <div class="pull-left">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
            @endif
        </div>
    </div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Image</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td><img src="/image/{{ $product->image }}" width="100px"></td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            
            @if ( $role=='1')
            <td>
              <form action="{{ route('products.destroy',$product->id) }}" method="POST">
   
                  <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
    
                  <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
   
                  @csrf
                  @method('DELETE')
      
                  <button type="submit" class="btn btn-danger">Delete</button>
              </form>
          </td>
          @else
          <td>lewra</td>
            @endif
          
        </tr>
        @endforeach
    </table>
    
    {!! $products->links() !!}
        
@endsection