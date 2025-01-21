<ul>
    @foreach ($header_menu_items as $header)
        <li><a href="{{ route('categories.show', Crypt::encrypt($header['slug'])) }}">{{ $header['name'] }}</a></li>        
    @endforeach

</ul>
