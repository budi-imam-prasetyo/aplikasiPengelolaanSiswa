<!DOCTYPE html>
   <html lang="en">
   <head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
       <title>Register</title>
   </head>
   <body>
       <div class="container">
           <h2 class="mt-4">Register</h2>
           <form action="{{ route('register') }}" method="POST">
               @csrf
               <div class="form-group">
                   <label for="name">Name</label>
                   <input type="text" class="form-control" name="name" id="name" required>
               </div>
               <div class="form-group">
                   <label for="email">Email</label>
                   <input type="email" class="form-control" name="email" id="email" required>
               </div>
               <div class="form-group">
                   <label for="password">Password</label>
                   <input type="password" class="form-control" name="password" id="password" required>
               </div>
               <div class="form-group">
                   <label for="password_confirmation">Confirm Password</label>
                   <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
               </div>
               <button type="submit" class="btn btn-primary">Register</button>
               <a href="{{ route('login') }}" class="btn btn-secondary">Login</a>
               <a href="{{ url('/welcome') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Kembali</a>
        </form>
           </form>
       </div>
       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   </body>
   </html>
