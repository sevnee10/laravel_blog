<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="meta_data" data-token="{{csrf_token()}}" data-user="{{auth()->check() ? auth()->id() : 0}}">
        
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Scripts -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.6.0.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{asset('frontend/css/vendor.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/styles.css')}}">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{asset('login_register/css/style.css')}}">

    <!-- script
    ================================================== -->
    <script src="{{asset('frontend/js/modernizr.js')}}"></script>
    <script src="{{asset('frontend/js/fontawesome/all.min.js')}}"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
    <body id=top>
        <div id="app">
            @include('layouts.inc.client.navbar')
            @yield('content')
            @include('layouts.inc.client.footer')
        </div>
        <!-- Java Script
        ================================================== -->
        <script src="{{asset('frontend/js/jquery-3.5.0.min.js')}}"></script>
        <script src="{{asset('frontend/js/plugins.js')}}"></script>
        <script src="{{asset('frontend/js/main.js')}}"></script>
        <script src="{{asset('login_register/js/jquery.min.js')}}"></script>
        <script src="{{asset('login_register/js/popper.js')}}"></script>
        <script src="{{asset('login_register/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('login_register/js/main.js')}}"></script><script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
        <script>
            //Define an adapter to upload the files
            class MyUploadAdapter {
               constructor(loader) {
                  this.loader = loader;
                  this.url = '{{ route('client-images.store') }}';
    
               }

               upload() {
                  return this.loader.file.then(
                     (file) =>
                        new Promise((resolve, reject) => {
                           this._initRequest();
                           this._initListeners(resolve, reject, file);
                           this._sendRequest(file);
                        })
                  );
               }

               abort() {
                  if (this.xhr) {
                     this.xhr.abort();
                  }
               }

               _initRequest() {
                  const xhr = (this.xhr = new XMLHttpRequest());
                  xhr.open("POST", this.url, true);
                  xhr.setRequestHeader("x-csrf-token", "{{ csrf_token() }}");
                  xhr.responseType = "json";
               }
 
               _initListeners(resolve, reject, file) {
                  const xhr = this.xhr;
                  const loader = this.loader;
                  const genericErrorText = `Couldn't upload file: ${file.name}.`;
                  xhr.addEventListener("error", () => reject(genericErrorText));
                  xhr.addEventListener("abort", () => reject());
                  xhr.addEventListener("load", () => {
                     const response = xhr.response;

                     if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                     }

                     resolve({
                        default: response.url,
                     });
                  });

                  if (xhr.upload) {
                     xhr.upload.addEventListener("progress", (evt) => {
                        if (evt.lengthComputable) {
                           loader.uploadTotal = evt.total;
                           loader.uploaded = evt.loaded;
                        }
                     });
                  }
               }

               _sendRequest(file) {
                  const data = new FormData();
                  data.append("upload", file);
                  this.xhr.send(data);
               }
               // ...
            }
        
            function SimpleUploadAdapterPlugin(editor) {
               editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
                  // Configure the URL to the upload script in your back-end here!
                  return new MyUploadAdapter(loader);
               };
            }
        
            //Initialize the ckeditor
            ClassicEditor.create(document.querySelector("#content"), {
               extraPlugins: [SimpleUploadAdapterPlugin],
            }).catch((error) => {
               
            });
        
        </script>
         @stack('script')
         {{-- <script>
            $(document).ready(function(){
                $.ajaxSetup({
                  headers: { 'csrftoken' : '{{ csrf_token() }}' }
                });
                
                $(document).ready(function () {
                  $('#search').on('keyup', function(){
                     var value = $(this).val();
                     $.ajax({
                        type: "get",
                        url: "/search-post",
                        data: {'search':value},
                        success: function (data) {
                           $('#article').html(data);
                        }
                     });
                  });
               });
            });
        </script> --}}
        <script>
         var meta_data = $('meta[name="meta_data"]');    
            $('.press').click(function () {
               if(meta_data.data('user') == 0){
                  toastr.error('Please Login!');
                  return;
               }
               var elem = $(this).parents('.s-content__entry');
               var data = {};
               data.post_id = elem.data('post');
               $.ajax({
                     url : '/save-liked',
                     data,
                     success : function (data) {
                        elem.find('.press').text(data.likes);
                        if(elem.find('.press').hasClass('heart')){
                           elem.find('.press').removeClass('heart');
                        }else{
                           elem.find('.press').addClass('heart');
                        }
                     }
               });
            });
        </script>
        <script> 
            $('#btn-login').click(function(e){
               e.preventDefault();
               var _token = '{{ csrf_token() }}';
               var _loginUrl = '{{route("ajax-login.ajax_login")}}';
               var email = $('#email').val();
               var password = $('#password').val();
               $.ajax({
                  url:_loginUrl,
                  type:"POST",
                  data:{
                     email:email,
                     password:password,
                     _token:_token,
                  },
                  success:function(response){
                     if(response.error){
                        let _error = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                        for(let er of response.error){
                           _error+= `<li>${er}</li>`;
                        }
                        _error +='</div>';
                        $('#error').html(_error);
                     }else{

                        location.reload();
                     }
                  }
               });
            });
         </script>
         @yield('js_post')
    </body>
</html>
