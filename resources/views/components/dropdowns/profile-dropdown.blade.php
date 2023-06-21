<div class="relative " x-data="{ isOpen: false }">
    <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
        class="flex items-center">
        <div>
            @if (Auth::user()->profile_photo_path == null)
            <img src = "{{ Auth::user()->avatar }}" class="w-6 h-6 object-cover rounded-full" />
            @else
            <img src = "{{ getPhoto(Auth::user()->profile_photo_path, 'profilePhoto') }}" id="profilePhoto" class="w-6 h-6 object-cover rounded-full" />
            @endif
        </div>
    </button>
    <ul x-show="isOpen" @click.away="isOpen = false" x-cloak
        class="absolute font-normal bg-BackdropBg backdrop-filter shadow overflow-hidden rounded w-36 border border-SeparateBorder mt-2 py-3 left-0 z-40 text-sm">
        <li class="flex  items-start">
            <a href="{{ route('profile.index',['workspace_name' =>  $currentWorkspace->name,'email' => Auth::user()->email]) }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2 ">
                <p>View Profile</p>
            </a>
        </li>

        <li class="flex  items-start">
            <a href="{{ route('setting') }}" class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2 ">
                <p>Setting</p>
            </a>
        </li>
        <hr class="w-full border-SeparateBorder my-2"/>
        <li class="flexitems-start">
            <form action="{{ route('logout') }}" method="POST" >
                @csrf
                <button class="flex gap-x-3 items-center w-full hover:bg-HoverBg capitalize transition pl-5 pr-2 py-2 ">
                    <p>logout</p>
                </button>
            </form>
        </li>

    </ul>
</div>
{{--
@push('js')
<script>
var imgElement = document.getElementById('profilePhoto');

// Set the attributes of the <img> element
imgElement.setAttribute('id', 'photo');
imgElement.setAttribute('src', getPhotoURL());
imgElement.setAttribute('class', 'w-6 h-6 object-cover rounded-full');

// Get the container element where you want to append the <img> element
var container = document.getElementById('photoContainer');

// Append the <img> element to the container
container.appendChild(imgElement);


function getPhotoURL() {
// Logic to retrieve the photo URL from your database or other source
var photoURL = "{{ getPhoto(Auth::user()->profile_photo_path, 'profilePhoto') }}";

return photoURL;
}
</script>

@endpush --}}
