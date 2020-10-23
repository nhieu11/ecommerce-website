@forelse ($categories as $category)
    <option value='{{$category->id}}' >
        @for ($i = 0 ; $i < $level; $i++)
        --
        @endfor
        {{$category->name}}
    </option>

    @includeWhen($category->sub->count() ,'admin.products.row_product',
    ['categories' => $category->sub,  'level' => $level + 1])

@empty {{--Xảy ra khi categories = NULL (Thành phần của forelse) --}}
<span>Không tìm thấy bản ghi</span>
@endforelse  {{-- Kết hợp của if và foreach --}}

