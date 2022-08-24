<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('backend/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('backend/images/favicon.png')}}" />
    @livewireStyles
</head>
    <body>
        <div class="container-scroller">
            @include('layouts.inc.admin.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('layouts.inc.admin.sidebar') 
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>           
                </div>
            </div>           
            @include('layouts.inc.admin.footer')  
        </div>    
        <!-- Scripts -->
        <!-- plugins:js -->
        <script src="{{asset('backend/vendors/base/vendor.bundle.base.js')}}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <script src="{{asset('backend/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('backend/vendors/datatables.net/jquery.dataTables.js')}}"></script>
        <script src="{{asset('backend/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{asset('backend/js/off-canvas.js')}}"></script>
        <script src="{{asset('backend/js/hoverable-collapse.js')}}"></script>
        <script src="{{asset('backend/js/template.js')}}"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="{{asset('backend/js/dashboard.js')}}"></script>
        <script src="{{asset('backend/js/data-table.js')}}"></script>
        <script src="{{asset('backend/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('backend/js/dataTables.bootstrap4.js')}}"></script>
        <!-- End custom js for this page-->
        <script src="{{asset('backend/js/jquery.cookie.js')}}" type="text/javascript"></script>
        @livewireScripts
        @stack('script')
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
        <script>
            //Define an adapter to upload the files
            class MyUploadAdapter {
               constructor(loader) {
                  this.loader = loader;
                  this.url = '{{ route('images.store') }}';
    
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
    </body>
</html>