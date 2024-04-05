@extends('templates.app')
@section('content')
<div>
    <form method="post" action="{{route('sampleWrite')}}">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <label for="phone_id">Detail ID:</label>
                    <select id="phone_id" name="phone_id">
                        @foreach ($phones as $row)
                            <option value="{{$row->phone_id}}">{{$row->phone_id}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="description">
                        Description
                    </label>
                    <textarea id="description" name="description">

                    </textarea>
                    <button type="submit" class="btn btn-primary">
                        Click me to update
                    </button>
                    <script>
                        $(document).ready(function() {
                            $('#description').summernote({
                                placeholder: 'Type here...',
                                tabsize: 2,
                                height: 350
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
        var noteBar = $('.note-toolbar');
        noteBar.find('[data-toggle]').each(function() {
            $(this).attr('data-bs-toggle', $(this).attr('data-toggle')).removeAttr('data-toggle');
        });
    });
</script>
@endsection
