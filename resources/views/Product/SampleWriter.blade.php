@extends('templates.app')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<div>
    <form method="post" action="/">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <select name="details_id">

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="description_s">
                        Description
                    </label>
                    <textarea id="description_s" name="description_s">
                    </textarea>
                    <button type="submit">
                        Click me to update
                    </button>
                    <script>
                        $(document).ready(function() {
                            $('#description_s').summernote({
                                placeholder: 'Type here...',
                                height: 350,
                                tabsize: 2
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        
    </form>
</div>
@endsection
