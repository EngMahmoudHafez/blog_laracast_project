@props(['posts'])
@if($posts ->count())
    <x-post-featured-card :post="$posts[0]"></x-post-featured-card>
    @if($posts->count() >1)
        <div class="lg:grid lg:grid-cols-6">
            @foreach ($posts->skip(1) as $post)
                <x-post-card :post="$post" class="{{$loop->iteration<3?'col-span-3':'col-span-2'}}"></x-post-card>
            @endforeach

        </div>
        {!! $posts->links() !!}
    @endif
@else
    <p class="text-center"> NO Posts yet , please check later .</p>
@endif
