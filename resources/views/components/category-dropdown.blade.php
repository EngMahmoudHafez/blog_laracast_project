<x-dropdown>
    <x-slot name="trigger">

        <button
            class="py-2 pl-3 pr-9 text-sm font-semibold flex w-32">
            {{isset($current_category)?ucwords($current_category->name) :'Categories'}}
            <svg class="transform -rotate-90 absolute pointer-events-none" style="right: 12px;" width="22"--}}
                 height="22" viewBox="0 0 22 22">
                <g fill="none" fill-rule="evenodd">
                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                    </path>
                    <path fill="#222"
                          d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z"></path>
                </g>
            </svg>
        </button>
    </x-slot>

    <x-dropdown-item href="/?{{http_build_query(request()->except('category','page'))}}">
        All
    </x-dropdown-item>
    @foreach($categories as $category)
        <x-dropdown-item href="/?category={{$category->slug}}&{{http_build_query(request()->except('category','page'))}}" class="{{isset($current_category) && $current_category->is($category) ? 'bg-blue-500 text-white': ''}}">
            {{ucwords($category->name)}}</a></x-dropdown-item>

    @endforeach
</x-dropdown>
