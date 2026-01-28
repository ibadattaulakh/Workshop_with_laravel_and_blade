<li class="flex items-start gap-4 not-first:pt-2.5" dusk="post-feed-item">
  <a href="{{ route('profiles.show', $post->profile->handle) }}" class="shrink-0">
    <img
      src="{{ $post->profile->avatar_url }}"
      alt="{{ $post->profile->display_name }}"
      class="size-10 object-cover"
    />
  </a>
  <div class="grow pt-1.5">
    <div class="border-pixl-light/10 border-b pb-5">
      <!-- User meta -->
      <div class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-2.5">
          <p><a class="hover:underline" href="{{ route('profiles.show', $post->profile->handle) }}">{{ $post->profile->display_name }}</a></p>
          <p class="text-pixl-light/40 text-xs">
            <a href="{{ route('posts.show', ['profile' => $post->profile->handle, 'post' => $post]) }}" class="hover:underline" dusk="visit-post-link">
              {{ $post->created_at->diffForHumans() }}
            </a>
          </p>
          <p>
            <a
              class="text-pixl-light/40 hover:text-pixl-light/60 text-xs"
              href="{{ route('profiles.show', $post->profile->handle) }}"
              >{!! '@' !!}{{ $post->profile->handle }}</a
            >
          </p>
        </div>
        <button
          class="group flex gap-[3px] py-2"
          aria-label="Post options"
        >
          <span
            class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
          ></span>
          <span
            class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
          ></span>
          <span
            class="bg-pixl-light/40 group-hover:bg-pixl-light/60 size-1"
          ></span>
        </button>
      </div>
      
      <!-- Post content -->
      <div class="mt-4 flex flex-col gap-3 text-sm">
        @if ($original->isRepost() && $original->content)
          {{-- quote repost: show the quote content and a nested quoted post --}}
          <p>{!! $original->content !!}</p>
          <ul class="mt-3">
            <li>
              <x-post :item="$post" :showEngagement="false" :showReplies="false" />
            </li>
          </ul>
        @else
          <p>{!! $post->content !!}</p>
        @endif
      </div>
      
      @if($showEngagement)
        <!-- Action buttons -->
        <div class="mt-6 flex items-center justify-between gap-4">
          <div class="flex items-center gap-8">
            <x-like-button :post="$post" />
            <x-reply-button :post="$post" />
            <x-repost-button :post="$post" />
          </div>
          <div class="flex items-center gap-3">
            <!-- Save -->
            <div class="flex items-center gap-1">
              <button aria-label="Save" class="hover:text-pixl">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  class="h-[17px]"
                  viewBox="0 0 14 17"
                >
                  <g fill="currentColor" clip-path="url(#a)">
                    <path
                      d="M1.545 7.727H0v1.546h1.545V7.727Zm0 1.546H0v1.545h1.545V9.273Zm0 1.545H0v1.546h1.545v-1.546Zm0 1.546H0v1.545h1.545v-1.545Zm0 1.546H0v1.545h1.545v-1.546Zm1.545 1.544H1.546V17h1.546v-1.546Z"
                    />
                    <path d="M4.636 15.454H3.091V17h1.545v-1.546Z" />
                    <path
                      d="M4.636 13.91H3.091v1.545h1.545v-1.546Zm1.546 0H4.636v1.545h1.546v-1.546Zm0-1.546H4.636v1.545h1.546v-1.545Zm1.545 0H6.182v1.545h1.545v-1.545Zm1.546 0H7.727v1.545h1.546v-1.545Zm0 1.546H7.727v1.545h1.546v-1.546Zm1.545 0H9.273v1.545h1.545v-1.546Zm1.546 1.544h-1.546V17h1.546v-1.546Z"
                    />
                    <path
                      d="M10.818 15.454H9.273V17h1.545v-1.546Zm3.092-1.544h-1.546v1.545h1.545v-1.546Zm0-1.546h-1.546v1.545h1.545v-1.545Zm0-1.546h-1.546v1.546h1.545v-1.546Zm0-1.545h-1.546v1.545h1.545V9.273Zm0-1.546h-1.546v1.546h1.545V7.727ZM4.636 0H3.091v1.545h1.545V0Zm1.546 0H4.636v1.545h1.546V0Zm1.545 0H6.182v1.545h1.545V0Zm1.546 0H7.727v1.545h1.546V0Zm1.545 0H9.273v1.545h1.545V0ZM3.09 1.545H1.546v1.546h1.546V1.545Zm9.274 0h-1.546v1.546h1.546V1.545ZM1.545 3.09H0v1.546h1.545V3.091Z"
                    />
                    <path
                      d="M3.09 3.09H1.546v1.546h1.546V3.091Zm9.274 0h-1.546v1.546h1.546V3.091Zm1.546 0h-1.546v1.546h1.545V3.091ZM1.545 4.636H0v1.546h1.545V4.636Zm12.365 0h-1.546v1.546h1.545V4.636Zm0 1.546h-1.546v1.545h1.545V6.182Zm-12.365 0H0v1.545h1.545V6.182Z"
                    />
                  </g>
                  <defs>
                    <clipPath id="a">
                      <path fill="#fff" d="M0 0h14v17H0z" />
                    </clipPath>
                  </defs>
                </svg>
              </button>
              <span class="text-pixl-light/40 text-sm">Save</span>
            </div>
            <!-- Share -->
            <div class="flex items-center gap-1">
              <button aria-label="Share" class="hover:text-pixl">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  class="h-[17px]"
                  viewBox="0 0 19 17"
                >
                  <g fill="currentColor" clip-path="url(#a)">
                    <path d="M2.125 6.375H0V8.5h2.125V6.375Z" />
                    <path
                      d="M4.25 6.375H2.123V8.5H4.25V6.375Zm0-2.125H2.123v2.125H4.25V4.25Z"
                    />
                    <path
                      d="M6.373 4.25H4.248v2.125h2.125V4.25Zm0-2.125H4.248V4.25h2.125V2.125Zm2.127 0H6.375V4.25H8.5V2.125ZM8.5 0H6.375v2.125H8.5V0Z"
                    />
                    <path
                      d="M10.624 0H8.499v2.125h2.125V0Zm2.126 0h-2.124v2.125h2.125V0Zm2.125 2.125H12.75V4.25h2.125V2.125Z"
                    />
                    <path
                      d="M12.75 2.125h-2.124V4.25h2.125V2.125Zm2.125 2.125H12.75v2.125h2.125V4.25Z"
                    />
                    <path
                      d="M16.999 4.25h-2.125v2.125h2.125V4.25Zm0 2.125h-2.125V8.5h2.125V6.375Zm2.126 0H17V8.5h2.125V6.375Zm-8.501-4.25H8.499V4.25h2.125V2.125Zm0 2.125H8.499v2.125h2.125V4.25Zm0 2.125H8.499V8.5h2.125V6.375Zm0 2.125H8.499v2.124h2.125V8.5Zm0 2.125H8.499v2.125h2.125v-2.125Zm0 2.125H8.499v2.125h2.125V12.75Zm0 2.125H8.499V17h2.125v-2.125Zm-6.374 0H2.123V17H4.25v-2.125Z"
                    />
                    <path
                      d="M6.373 14.875H4.248V17h2.125v-2.125Zm2.127 0H6.375V17H8.5v-2.125Zm4.25 0h-2.124V17h2.125v-2.125Z"
                    />
                    <path d="M14.875 14.875H12.75V17h2.125v-2.125Z" />
                    <path
                      d="M16.999 14.875h-2.125V17h2.125v-2.125ZM2.125 12.75H0v2.125h2.125V12.75Zm0 2.125H0V17h2.125v-2.125Zm17-2.125H17v2.125h2.125V12.75Zm0 2.125H17V17h2.125v-2.125Z"
                    />
                  </g>
                  <defs>
                    <clipPath id="a">
                      <path fill="#fff" d="M0 0h19v17H0z" />
                    </clipPath>
                  </defs>
                </svg>
              </button>
            </div>
          </div>
        </div>
      @endif

      @auth
        <x-reply-form :post="$post" />
      @endauth

      @if($showReplies && $post->relationLoaded('replies') && $post->replies->isNotEmpty())
        <div class="threaded-replies mt-4">
          <ol>
            @foreach($post->replies as $reply)
              <x-reply :post="$reply" :showReplies="$showReplies" :showEngagement="$showEngagement" />
            @endforeach
          </ol>
        </div>
      @endif
    </div>
</div>
</li>
