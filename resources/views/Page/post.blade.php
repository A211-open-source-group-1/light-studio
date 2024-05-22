@extends('templates.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
            <div class="col-12 col-lg-10 col-xl-8">
                {{ Breadcrumbs::render('posts') }}
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
                    @foreach ($posts as $post)
                        <a href="{{ route('post', $post['id']) }}" class="text-dark">
                            <div class="row border p-3 rounded">
                                <div class="col-3">
                                    <img src="/image/{{ $post['thumbnail'] }}" class="rounded"
                                        style="height: 200px; width: 200px">
                                </div>
                                <div class="col-9">
                                    <h4 class="text-truncate-xl">{{ $post['title'] }}</h4>
                                    <p class="fst-italic m-0 p-0"> - {{ $post['name'] }}</p>
                                    <p class="fst-italic m-0 p-0">
                                        {{ date('d-m-Y', strtotime($post['created_at'])) }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-0 col-lg-1 col-xl-2">

            </div>
            <div class="col-12 text-center">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
@endsection
