@props(['name'])

@switch($name)
    @case('dashboard')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 4h6v6H4V4Zm10 0h6v10h-6V4ZM4 14h6v6H4v-6Zm10 4h6v2h-6v-2Z"/></svg>@break
    @case('inquiries')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M7 3h10l3 3v15H4V3h3Zm2 5h6m-6 4h7m-7 4h5"/><path d="M16 3v4h4"/></svg>@break
    @case('shipments')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M3 7h11v10H3V7Zm11 3h4l3 3v4h-7v-7ZM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 0 4Z"/></svg>@break
    @case('financials')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 7h16v12H4V7Zm0 4h16M8 16h3"/><path d="m6 7 2-3h8l2 3"/></svg>@break
    @case('profile')<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg>@break
    @case('logout')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M14 8V4H4v16h10v-4m-3-4h10m-3-3 3 3-3 3"/></svg>@break
    @case('menu')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg>@break
    @case('close')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="m5 5 14 14M19 5 5 19"/></svg>@break
    @case('bell')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg>@break
    @case('search')<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>@break
    @case('arrow-left')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg>@break
    @case('chevron-left')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="m14 6-6 6 6 6"/></svg>@break
    @case('calendar')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 5h16v16H4V5Zm0 5h16M8 3v4m8-4v4"/></svg>@break
    @case('route')<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="6" cy="18" r="2"/><circle cx="18" cy="6" r="2"/><path d="M8 18h3a2 2 0 0 0 2-2V8a2 2 0 0 1 2-2h1"/></svg>@break
    @case('box')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="m4 7 8-4 8 4v10l-8 4-8-4V7Zm0 0 8 4 8-4m-8 4v10"/></svg>@break
    @case('check')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="m6 12 4 4 8-9"/></svg>@break
    @case('clock')<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>@break
    @case('location')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg>@break
    @case('support')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z"/></svg>@break
    @case('empty')<svg {{ $attributes }} viewBox="0 0 24 24"><path d="M4 7h16v13H4V7Zm4-3h8l2 3M8 12h8m-6 4h4"/></svg>@break
    @case('money')<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M15 8.5c-.7-.4-1.7-.7-2.7-.7-1.5 0-2.8.7-2.8 2s1.1 1.7 2.8 2.1 2.8.9 2.8 2.2-1.3 2.1-2.9 2.1c-1.2 0-2.3-.4-3.1-.9M12 6v12"/></svg>@break
    @default<svg {{ $attributes }} viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/></svg>
@endswitch
