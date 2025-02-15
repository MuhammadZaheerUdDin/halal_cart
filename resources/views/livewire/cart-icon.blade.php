{{-- 🛒 --}}
{{-- <div> --}}
    <a href="{{ route('cart') }}" id="openMenuBtn">
        <i class="fas fa-shopping-cart">
         <span style="font-size: 12px; margin-left:-4px;" >
            @if(Auth::id())
                <small><italic> {{ $cart_count }}</italic></small>
            @endif
         </span>
        </i>
    </a>

    