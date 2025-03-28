{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand text-light fw-bold" href="{{ route('products.index') }}">&#x1F4E6; Product Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light me-2" href="{{ route('products.index') }}">&#x1F4CB; All Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-success" href="{{ route('products.create') }}">&#x2795; Add Product</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

 --}}


 <!DOCTYPE html> 
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Product Management</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> 
 </head>
 <body>
     
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
         <div class="container">
             <a class="navbar-brand text-light fw-bold" href="{{ route('products.index') }}">&#x1F4E6; Product Management</a>
             <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                 <span class="navbar-toggler-icon"></span>
             </button>
             <div class="collapse navbar-collapse" id="navbarNav">
                 <ul class="navbar-nav ms-auto">
                     <li class="nav-item">
                         <a class="nav-link btn btn-outline-light me-2" href="{{ route('products.index') }}">&#x1F4CB; All Products</a>
                     </li>
                     <li class="nav-item">
                         <a class="nav-link btn btn-outline-success me-2" href="{{ route('products.create') }}">&#x2795; Add Product</a>
                     </li>
 
                     @auth
                        
                         <li class="nav-item">
                             <a class="nav-link btn btn-outline-warning me-2" href="{{ route('cart.index') }}">&#x1F6D2; My Cart</a>
                         </li>
 
                        
                         <li class="nav-item">
                             <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                 @csrf
                                 <button type="submit" class="btn btn-outline-danger"> &#x1F6AA; Logout</button>
                             </form>
                         </li>
                     @else
                         <li class="nav-item">
                             <a class="nav-link btn btn-outline-primary me-2" href="{{ route('login') }}">&#x1F511; Login</a>
                         </li>
                         <li class="nav-item">
                             <a class="nav-link btn btn-outline-secondary" href="{{ route('register') }}">&#x1F4DD; Register</a>
                         </li>
                     @endauth
 
                 </ul>
             </div>
         </div>
     </nav>
     
     <div class="container mt-4">
         @yield('content')
     </div>
 
     <!-- Bootstrap Script -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 </body>
 </html>
 


