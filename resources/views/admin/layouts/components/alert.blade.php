<div class="alert bg-{{ $type }}" role="alert">
    <svg class="glyph stroked {{ $stroke }}">
        <use xlink:href="#stroked-{{ $stroke }}"></use>
    </svg> {{ $slot }}
    <a href="#" class="pull-right">
        <span class="glyphicon glyphicon-remove"></span>
    </a>
</div>
