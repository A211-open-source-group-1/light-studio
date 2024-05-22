@extends('templates.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
            <div class="col-12 col-lg-10 col-xl-8">
                {{ Breadcrumbs::render('post', $post->id) }}
            </div>
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
            <div class="col-12 col-lg-10 col-xl-8 border-top border-start border-end">
                <div class="container-fluid m-1 p-1">
                    <div class="row">
                        <div class="col-12 border-bottom">
                            <h2>{{ $post->title }}</h2>
                            <p class="fst-italic"> Tác giả: {{ $post->name }} - Ngày đăng:
                                {{ date('d-m-Y', strtotime($post->created_at)) }}</p>
                        </div>
                        <div class="col-12 border-bottom">
                            <div class="w-100" id="post_content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#post_content').html({!! json_encode($post->content) !!});
        })
    </script>
@endsection
