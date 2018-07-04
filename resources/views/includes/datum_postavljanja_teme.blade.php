<span class="text-muted">
        @if($tema->created_at->isToday())
            Danas u {{$tema->created_at->format('H:i')}}
        @elseif($tema->created_at->isYesterday())
            Jučer u {{$tema->created_at->format('H:i')}}
        @else
            {{$tema->created_at->day}}.
            @switch($tema->created_at->month)
            @case(1)
            Siječanja
            @break
            @case(2)
            Veljače
            @break
            @case(3)
            Ožujka
            @break
            @case(4)
            Travnja
            @break
            @case(5)
            Svibnja
            @break
            @case(6)
            Lipnja
            @break
            @case(7)
            Srpnja
            @break
            @case(8)
            Kolovoza
            @break
            @case(9)
            Rujna
            @break
            @case(10)
            Listopada
            @break
            @case(11)
            Studenog
            @break
            @case(12)
            Prosinca
            @break
            @endswitch
        @if($tema->created_at->isCurrentYear())
            {{$tema->created_at->format(' \u H:i')}}
        @else
            {{$tema->created_at->format('Y. \u H:i')}}
        @endif
        @endif
    </span>            