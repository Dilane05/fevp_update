 @auth
 <div class=" d-flex align-items-center mb-4">
     <div class="d-flex align-items-end justify-content-end text-gray-500 mt-n1 mx-1">
         <a class="{{ \App::isLocale('fr') ? ' text-success' : ''}} mx-2" href="{{route('language-switcher',['locale'=>'fr'])}}" wire:navigate> <img src="{{asset('img/brand/lang_french_icon.png')}}" alt='' class="icon icon-xxs"></a>
         <a class="{{ \App::isLocale('en') ? ' text-success' : ''}} " href="{{route('language-switcher',['locale'=>'en'])}}" wire:navigate> <img src="{{asset('img/brand/lang_english_icon.png')}}" alt='' class="icon icon-xxs"></a>
         <!-- <a class=" {{ \App::isLocale('fr') ? ' text-success' : ''}} px-1" href=" {{route('language-switcher',['locale'=>'fr'])}}" wire:nagivate>{{__('FR')}}</a> |
         <a class="{{ \App::isLocale('en') ? ' text-success' : ''}} px-1" href="{{route('language-switcher',['locale'=>'en'])}}" wire:nagivate>{{__('EN')}}</a> -->
     </div>
     <!-- <div class="nav-item dropdown text-dark">
         <a class="nav-link dropdown-toggle text-gray-700" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
             Dropdown link
         </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
    </div> -->
     <div>
         <a href='' class="mx-2">
             <svg class="icon icon-sm me-1 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                 <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
             </svg>
         </a>
     </div>
     <a href='{{route("client.profile")}}' wire:nagivate class='text-gray-500'>
         <svg class="icon icon-sm me-1 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
         </svg>
     </a>
     <a class="mx-2" href="{{route('logout')}}" wire:nagivate>
         <svg class="icon icon-sm me-1 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
         </svg>
     </a>
 </div>
 @endauth