@forelse ($categories as $category)
        <div class="item-menu">
            <span>
                @for ($i = 0 ; $i < $level; $i++)
                --
                @endfor
                {{ $category->name }}
            </span>
            <div class="category-fix">
                <a class="btn-category btn-primary" href="/admin/categories/{{$category->id}}/edit">
                <i class="fa fa-edit"></i></a>
                <a class="btn-category btn-danger btn-destroy" href="/admin/categories/{{$category->id}}"><i class="fas fa-times"></i></i></a>

                </div>
                </div>

@includeWhen($category->sub->count() ,'admin.categories.row',
['categories' => $category->sub,  'level' => $level + 1])

 @empty {{--Xảy ra khi categories = NULL (Thành phần của forelse) --}}
<span>Không tìm thấy bản ghi</span>
@endforelse  {{-- Kết hợp của if và foreach --}}

