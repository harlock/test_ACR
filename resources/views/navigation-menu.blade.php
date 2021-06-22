<ul class="list-reset ">
    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
        {{ __('Dashboard') }}
    </x-jet-nav-link>

    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('projecttypes') }}" :active="request()->routeIs('projecttypes')">
            {{ __('Tipo de proyectos') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('projects') }}" :active="request()->routeIs('projects')">
            {{ __('Proyectos') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('projectreferences') }}" :active="request()->routeIs('projectreferences')">
            {{ __('Referencias') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('Video') }}" :active="request()->routeIs('Video')">
            {{ __('Videos') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('socialNetwork') }}" :active="request()->routeIs('socialNetwork')">
            {{ __('Redes Sociales') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('socialnetworktype') }}" :active="request()->routeIs('socialnetworktype')">
            {{ __('Tipos De Redes sociales') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('image') }}" :active="request()->routeIs('image')">
            {{ __('Imagenes') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('imagesauthors') }}" :active="request()->routeIs('imagesauthors')">
            {{ __('Autores de las imagenes') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('allies') }}" :active="request()->routeIs('allies')">
            {{ __('Aliados') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('awards') }}" :active="request()->routeIs('awards')">
            {{ __('Premios') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('content') }}" :active="request()->routeIs('content')">
            {{ __('Contenidos') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('authors') }}" :active="request()->routeIs('authors')">
            {{ __('Autores') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">
        <x-jet-nav-link href="{{ route('project_awards') }}" :active="request()->routeIs('project_awards')">
            {{ __('Premios de proyectos') }}
        </x-jet-nav-link>
    </li>
    <li class="my-2 md:my-0">

    </li>
</ul>


{{--<ul class="list-reset ">--}}
{{--    <li class="my-2 md:my-0">--}}
{{--        <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">--}}
{{--            <i class="fas fa-home fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Home</span>--}}
{{--        </a>--}}
{{--    </li>--}}

{{--</ul>--}}
