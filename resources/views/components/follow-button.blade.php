@auth
  <form action="{{ $isFollowing ? route('profiles.unfollow', $profile) : route('profiles.follow', $profile) }}" method="POST" class="inline">
    @csrf
    <button
      type="submit"
      class="bg-pixl-dark/50 hover:bg-pixl-dark/60 active:bg-pixl-dark/75 border-pixl/50 hover:border-pixl/60 active:border-pixl/75 text-pixl border px-2 py-1 text-sm"
      dusk="follow-button"
    >
      {{ $isFollowing ? 'Unfollow' : 'Follow' }}
    </button>
  </form>
@endauth
