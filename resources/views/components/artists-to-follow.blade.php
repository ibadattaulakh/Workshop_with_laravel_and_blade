<!-- resources/views/components/artists-to-follow.blade.php -->
<div class="border-pixl-light/10 mt-10 border p-4">
  <h2 class="text-pixl-light/60 text-sm">Artists to follow</h2>

  <ol class="mt-4 flex flex-col gap-4">
    @foreach($profiles as $profile)
      <li class="flex items-center justify-between gap-4">
        <div class="flex items-center gap-2.5">
          <a href="{{ route('profiles.show', $profile->handle) }}">
            <img src="{{ $profile->avatar_url }}" alt="{{ $profile->display_name }}" class="size-8 object-cover" />
          </a>
          <div class="text-sm">
            <div class="font-medium">
              <a href="{{ route('profiles.show', $profile->handle) }}">{{ $profile->display_name }}</a>
            </div>
            <div class="text-xs text-pixl-light/60">{!! '@' !!}{{ $profile->handle }}</div>
          </div>
        </div>

        <button
          class="bg-pixl-dark/50 hover:bg-pixl-dark/60 active:bg-pixl-dark/75 border-pixl/50 hover:border-pixl/60 active:border-pixl/75 text-pixl border px-2 py-1 text-sm"
        >
          Follow
        </button>
      </li>
    @endforeach
  </ol>
  <a href="#" class="text-pixl-light/60 mt-4 inline-block text-sm"
    >Show more</a
  >
</div>

