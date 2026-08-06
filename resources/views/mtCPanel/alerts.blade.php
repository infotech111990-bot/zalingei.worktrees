<script>
    @if(isset($parent))
        @if($data->count() == 0)
            Swal.fire({
                icon: 'warning',
                title: 'عفواً، لا يوجد بيانات حالياً',
                html: '<a href="{{ mtGetRoute('create','mtCPanel.'.$page, $parent->id) }}" class="btn btn-md btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a>',
                showConfirmButton: false,
            })
        @endif
        @if(old('added'))
            Swal.fire({
                icon: 'success',
                title: 'تمت إضافة البيانات بنحاج',
                html: '<a href="{{ mtGetRoute('create','mtCPanel.'.$page, $parent->id) }}" class="btn btn-md btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a>',
            })
        @endif
    @endif
    @if(!isset($parent))
        @if($data->count() == 0)
            Swal.fire({
                icon: 'warning',
                title: 'عفواً، لا يوجد بيانات حالياً',
                html: '<a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-md btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a>',
                showConfirmButton: false,
            })
        @endif
        @if(old('added'))
            Swal.fire({
                icon: 'success',
                title: 'تمت إضافة البيانات بنحاج',
                html: '<a href="{{ mtGetRoute('create','mtCPanel.'.$page) }}" class="btn btn-md btn-primary"> <i class="fa fa-plus" aria-hidden="true"></i> @lang('admin.addNewItem') </a>',
            })
        @endif
    @endif
    @if(old('updated'))
        Swal.fire({
            icon: 'success',
            title: 'تم التعديل بنجاح',
            showConfirmButton: false,
            timer: 3000
        })
    @endif
    @if(old('deleted'))
        Swal.fire({
            icon: 'success',
            title: 'تم الحذف بنجاح',
            showConfirmButton: false,
            timer: 3000
        })
    @endif
</script>