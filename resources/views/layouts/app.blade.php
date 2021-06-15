
<!--This template is based on: https://dribbble.com/shots/6531694-Marketing-Dashboard by Gregoire Vella -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Starter Template - Minimal Admin Template: Tailwind Toolbox</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">

    <script src="{{ mix('js/app.js') }}" defer></script>

    <style>
        .nunito {
            font-family: 'nunito', font-sans;
        }

        .border-b-1 {
            border-bottom-width: 1px;
        }

        .border-l-1 {
            border-left-width: 1px;
        }

        hover\:border-none:hover {
            border-style: none;
        }

        #sidebar {
            transition: ease-in-out all .3s;
            z-index: 9999;
        }

        #sidebar span {
            opacity: 0;
            position: absolute;
            transition: ease-in-out all .1s;
        }

        #sidebar:hover {
            width: 150px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            /*shadow-2xl*/
        }

        #sidebar:hover span {
            opacity: 1;
        }
    </style>

</head>

<body class="flex h-screen bg-red-50 font-sans">

<x-jet-banner />
<!-- Side bar-->
<div id="sidebar" class="h-screen w-16 menu bg-red-50 text-white px-4 flex items-center nunito static fixed shadow">
    @livewire('navigation-menu')

</div>

<div class="bg-red-50 flex-row flex-wrap flex-1 flex-grow content-start pl-16">

    <div class="h-40 lg:h-20 w-full flex flex-wrap">
        <nav id="header1" class="bg-red-50 w-auto flex-1 border-b-1 border-gray-300 order-1 lg:order-2">

            <div class="flex h-full justify-between items-center">
                @if (isset($header))
                    <div class="flex-none pl-4 sm:pl-6 xl:pl-8 flex items-center border-b border-gray-200 lg:border-b-0 lg:w-60 xl:w-72">

                    {{ $header }}
                        </div>
                @endif
                <!--Menu-->

                <div class="flex relative inline-block pr-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-16">
                            <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <!-- Teams Dropdown -->
                                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                    <div class="ml-3 relative">
                                        <x-jet-dropdown align="right" width="60">
                                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                        {{ Auth::user()->currentTeam->name }}
                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                            </x-slot>

                                            <x-slot name="content">
                                                <div class="w-60">
                                                    <!-- Team Management -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Manage Team') }}
                                                    </div>

                                                    <!-- Team Settings -->
                                                    <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                                        {{ __('Team Settings') }}
                                                    </x-jet-dropdown-link>

                                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                                            {{ __('Create New Team') }}
                                                        </x-jet-dropdown-link>
                                                    @endcan

                                                    <div class="border-t border-gray-100"></div>

                                                    <!-- Team Switcher -->
                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        {{ __('Switch Teams') }}
                                                    </div>

                                                    @foreach (Auth::user()->allTeams() as $team)
                                                        <x-jet-switchable-team :team="$team" />
                                                    @endforeach
                                                </div>
                                            </x-slot>
                                        </x-jet-dropdown>
                                    </div>
                            @endif

                            <!-- Settings Dropdown -->
                                <div class="ml-3 relative">
                                    <x-jet-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                                </button>
                                            @else
                                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                                            @endif
                                        </x-slot>

                                        <x-slot name="content">
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                {{ __('Manage Account') }}
                                            </div>

                                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                                {{ __('Profile') }}
                                            </x-jet-dropdown-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                                    {{ __('API Tokens') }}
                                                </x-jet-dropdown-link>
                                            @endif

                                            <div class="border-t border-gray-100"></div>

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf

                                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                    {{ __('Log Out') }}
                                                </x-jet-dropdown-link>
                                            </form>
                                        </x-slot>
                                    </x-jet-dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center sm:hidden">
                                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- / Menu -->

            </div>

        </nav>
    </div>

    <!--Dash Content -->
    <div  class="bg-white py-2 lg:py-0 w-full  flex flex-wrap content-start">
        {{ $slot }}
    </div>

    <!--Graph Content -->

</div>

<script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
<script>
    /* Refer to https://gionkunz.github.io/chartist-js/examples.html for setting up the graphs */

    var mainChart = new Chartist.Line('#chart1', {
        labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        series: [
            [1, 5, 2, 5, 4, 3],
            [2, 3, 4, 8, 1, 2],
            [5, 4, 3, 2, 1, 0.5]
        ]
    }, {
        low: 0,
        showArea: true,
        showPoint: false,
        fullWidth: true
    });

    mainChart.on('draw', function(data) {
        if (data.type === 'line' || data.type === 'area') {
            data.element.animate({
                d: {
                    begin: 1000 * data.index,
                    dur: 1000,
                    from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                    to: data.path.clone().stringify(),
                    easing: Chartist.Svg.Easing.easeOutQuint
                }
            });
        }
    });

    var chartScatter = new Chartist.Line('#chart2', {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        series: [
            [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
            [4, 5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
            [5, 3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
            [3, 4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
        ]
    }, {
        low: 0
    });

    chartScatter.on('draw', function(data) {
        if (data.type === 'line' || data.type === 'area') {
            data.element.animate({
                d: {
                    begin: 500 * data.index,
                    dur: 1000,
                    from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                    to: data.path.clone().stringify(),
                    easing: Chartist.Svg.Easing.easeOutQuint
                }
            });
        }
    });

    var chartBar = new Chartist.Bar('#chart3', {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        series: [
            [800000, 1200000, 1400000, 1300000],
            [200000, 400000, 500000, 300000],
            [100000, 200000, 400000, 600000]
        ]
    }, {
        stackBars: true,
        axisY: {
            labelInterpolationFnc: function(value) {
                return (value / 1000) + 'k';
            }
        }
    })

    chartBar.on('draw', function(data) {
        if (data.type === 'bar') {
            data.element.attr({
                style: 'stroke-width: 30px'
            }),
                data.element.animate({
                    y2: {
                        dur: '0.5s',
                        from: data.y1,
                        to: data.y2
                    }
                });
        }
    });

    var chartPie = new Chartist.Pie('#chart4', {
        series: [10, 20, 50, 20, 5, 50, 15],
        labels: [1, 2, 3, 4, 5, 6, 7]
    }, {
        donut: true,
        showLabel: true
    });

    chartPie.on('draw', function(data) {
        if (data.type === 'slice') {
            var pathLength = data.element._node.getTotalLength();
            data.element.attr({
                'stroke-dasharray': pathLength + 'px ' + pathLength + 'px'
            });

            var animationDefinition = {
                'stroke-dashoffset': {
                    id: 'anim' + data.index,
                    dur: 200,
                    from: -pathLength + 'px',
                    to: '0px',
                    easing: Chartist.Svg.Easing.easeOutQuint,
                    fill: 'freeze'
                }
            };

            if (data.index !== 0) {
                animationDefinition['stroke-dashoffset'].begin = 'anim' + (data.index - 1) + '.end';
            }

            data.element.attr({
                'stroke-dashoffset': -pathLength + 'px'
            });

            data.element.animate(animationDefinition, false);
        }
    });
</script>

<script>
    /*Toggle dropdown list*/
    /*https://gist.github.com/slavapas/593e8e50cf4cc16ac972afcbad4f70c8*/

    var userMenuDiv = document.getElementById("userMenu");
    var userMenu = document.getElementById("userButton");

    document.onclick = check;

    function check(e) {
        var target = (e && e.target) || (event && event.srcElement);

        //User Menu
        if (!checkParent(target, userMenuDiv)) {
            // click NOT on the menu
            if (checkParent(target, userMenu)) {
                // click on the link
                if (userMenuDiv.classList.contains("invisible")) {
                    userMenuDiv.classList.remove("invisible");
                } else {
                    userMenuDiv.classList.add("invisible");
                }
            } else {
                // click both outside link and outside menu, hide menu
                userMenuDiv.classList.add("invisible");
            }
        }

    }

    function checkParent(t, elm) {
        while (t.parentNode) {
            if (t == elm) {
                return true;
            }
            t = t.parentNode;
        }
        return false;
    }
</script>
@stack('modals')

@livewireScripts
</body>

</html>