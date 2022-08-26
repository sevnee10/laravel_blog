<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Scripts -->
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-3.6.0.js')}}"></script>
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
               console.error(error);
            });
        
        </script>
         @stack('script')
    </body>
</html>
