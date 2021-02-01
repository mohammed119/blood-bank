@inject('permissions','App\Permission)
<div class="form-group">
    <label for="name">Name</label>
    {!!Form::text('name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="display_name">display name</label>
    {!!Form::text('display_name',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="description">description</label>
    {!!Form::textarea('description',null,['class'=>'form-control'])!!}
</div>
<div class="form-group">
    <label for="permission">permissions</label>
    <br>
    <input id="selectAll" type="checkbox"><label for='selectAll'>Select All</label>
    <br>
    <div class="row">
        @foreach($permissions->all() as $permission)
            <div class="col-sm-3">
                <label>
                    <input type="checkbox" name="permissions_list[]" value="{{$permission->id}}"

                    @if($model->hasPermission($permission->name))
                        checked
                    @endif
                    >
                    {{$permission->display_name}}
                </label>
            </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
{!!Form::close() !!}


@push('scripts')
    <script>
        $("#selectAll").click(function(){
            $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        });
    </script>
@endpush