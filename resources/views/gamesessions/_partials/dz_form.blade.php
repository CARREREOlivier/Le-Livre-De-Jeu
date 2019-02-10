<form method="post" action="{{ url('/files-save') }}"
      enctype="multipart/form-data" class="dropzone" id="my-dropzone">
    {{ csrf_field() }}
    <input type="hidden" name="category" value={{$category}}>
    <input type="hidden" name="entity_id" value={{$id}}>
    <div class="dz-message">
        <div class="col-xs-8">
            <div class="message">
                <p>{{$text}}</p>
            </div>
        </div>
    </div>
    <div class="fallback">
        <input type="file" name="file" multiple>
    </div>
</form>