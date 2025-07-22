@php
    $links = [
        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-gauge',
            'route' => route('dashboard'),
            'active' => request()->routeIs('dashboard'),
        ],
        [
            'header' => 'Panel de CPE',
            'icon' => 'fa-solid fa-file-invoice',
        ],
        /* [
            'name' => 'Ventas',
            'icon' => 'fa-solid fa-cash-register',
            'active' => request()->routeIs([
                'vouchers.*',
                'clients.*',
            ]),
            "submenu" => [
                [
                    'name' => 'Comprobantes',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('vouchers.index'),
                    'active' => request()->routeIs('vouchers.*'),
                ],
                [
                    'name' => 'Clientes',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('clients.index'),
                    'active' => request()->routeIs('clients.*'),
                ]
            ]
        ], */
        [
            'name' => 'Comprobantes',
            'icon' => 'fa-solid fa-cash-register',
            'route' => route('vouchers.index'),
            'active' => request()->routeIs('vouchers.*'),
        ],
        [
            'name' => 'Anulaciones',
            'icon' => 'fa-solid fa-ban',
            'route' => route('voideds.index'),
            'active' => request()->routeIs('voideds.*'),
        ],
        [
            'name' => 'Guías',
            'icon' => 'fa-solid fa-truck',
            'active' => request()->routeIs('despatchs*'),
            'route' => route('despatchs.index'),
            /* 'submenu' => [
                [
                    'name' => 'Lista de guías',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('despatchs.index'),
                    'active' => request()->routeIs('despatchs.index'),
                ],
                [
                    'name' => 'Nueva guía',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('despatchs.create'),
                    'active' => request()->routeIs('despatchs.create'),
                ],
            ] */
        ],
        [
            'header' => 'Maestras',
            'icon' => 'fa-solid fa-cogs',
        ],
        [
            'name' => 'Clientes',
            'icon' => 'fa-solid fa-users',
            'route' => route('clients.index'),
            'active' => request()->routeIs('clients.*'),
        ],
        [
            'name' => 'Códigos Inspección',
            'icon' => 'fa-solid fa-magnifying-glass',
            'active' => request()->routeIs(['damages.*', 'components.*', 'methods.*', 'locations.*']),
            'submenu' => [
                [
                    'name' => 'Daños',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('damages.index'),
                    'active' => request()->routeIs('damages.*'),
                ],
                [
                    'name' => 'Componentes',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('components.index'),
                    'active' => request()->routeIs('components.*'),
                ],
                [
                    'name' => 'Métodos',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('methods.index'),
                    'active' => request()->routeIs('methods.*'),
                ],
                [
                    'name' => 'Ubicaciones',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('locations.index'),
                    'active' => request()->routeIs('locations.*'),
                ],
            ],
        ],
        [
            'name' => 'Admisión',
            'icon' => 'fa-solid fa-ship',
            'active' => request()->routeIs([
                'lines.*',
                'line.*',
                'ports.*',
                'container-types.*',
                'reefer-technologies.*',
            ]),
            'submenu' => [
                [
                    'name' => 'Líneas',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('lines.index'),
                    'active' => request()->routeIs(['lines.*','line.*']),
                ],
                [
                    'name' => 'Puertos',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('ports.index'),
                    'active' => request()->routeIs('ports.*'),
                ],
                [
                    'name' => 'Tipos contenedor',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('container-types.index'),
                    'active' => request()->routeIs('container-types.*'),
                ],
                [
                    'name' => 'Tecnologías',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('reefer-technologies.index'),
                    'active' => request()->routeIs('reefer-technologies.*'),
                ],
            ],
        ],

        /* [
            'name' => 'Inventario',
            'icon' => 'fa-solid fa-boxes',
            'active' => request()->routeIs([
                'products.*',
            ]),
            "submenu" => [
                [
                    'name' => 'Productos',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('products.index'),
                    'active' => request()->routeIs('products.*'),
                ],
            ]
        ], */

        [
            'name' => 'Productos',
            'icon' => 'fa-solid fa-boxes',
            'route' => route('products.index'),
            'active' => request()->routeIs('products.*'),
        ],
        [
            'name' => 'Usuarios',
            'icon' => 'fa-solid fa-users-gear',
            'route' => route('users.index'),
            'active' => request()->routeIs('users.*'),
        ],
        [
            'header' => 'Panel de Configuración',
            'icon' => 'fa-solid fa-building',
        ],
        [
            'name' => 'Sucursales',
            'icon' => 'fa-solid fa-store',
            'route' => route('branches.index'),
            'active' => request()->routeIs('branches.*'),
        ],
        [
            'name' => 'Empresa',
            'icon' => 'fas fa-fw fa-building',
            'active' => request()->routeIs([
                'companies.*',
                /* 'branches.*', */
                /* 'users.*', */
            ]),
            'submenu' => [
                [
                    'name' => 'Datos de la empresa',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('companies.edit'),
                    'active' => request()->routeIs('companies.edit'),
                ],
                [
                    'name' => 'API Token',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('companies.api-token'),
                    'active' => request()->routeIs('companies.api-token'),
                ],
                /* [
                    'name' => 'Sucursales',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('branches.index'),
                    'active' => request()->routeIs('branches.*'),
                ], */
                /* [
                    'name' => 'Usuarios',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('users.index'),
                    'active' => request()->routeIs('users.*'),
                ] */
            ],
        ],
    ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-[100dvh] pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700 -translate-x-full"
    :class="{
        'transform-none': open,
        '-translate-x-full': !open
    }" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                @canany($link['can'] ?? [null])
                    <li>
                        @isset($link['header'])
                            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div
                                    class="flex items-center gap-2 px-4 py-2 text-[11px] font-semibold tracking-wide uppercase text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-800 rounded">
                                    @if (!empty($link['icon']))
                                        <i class="{{ $link['icon'] }} text-gray-400 text-sm"></i>
                                    @endif
                                    {{ $link['header'] }}
                                </div>
                            </div>
                        @else
                            @isset($link['submenu'])
                                <div x-data="{ open: {{ $link['active'] ? 'true' : 'false' }} }">

                                    <button type="button" x-on:click="open = !open"
                                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-blue-500 hover:text-white dark:text-white dark:hover:bg-gray-700 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-blue-500 hover:text-white' }}"
                                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">

                                        <span class="inline-flex w-6 h-6 justify-center items-center">
                                            <i class="{{ $link['icon'] }} text-gray-500 group-hover:text-white"></i>
                                        </span>
                                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>
                                            {{ $link['name'] }}
                                        </span>

                                        <i class="fa-solid fa-angle-down"
                                            :class="{
                                                'fa-angle-down': !open,
                                                'fa-angle-up': open,
                                            }"></i>

                                    </button>

                                    <ul class="hidden py-2 space-y-2"
                                        :class="{
                                            'hidden': !open,
                                        }">
                                        @foreach ($link['submenu'] as $link)
                                            <li>

                                                <a href="{{ $link['route'] }}"
                                                    class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-4 group hover:bg-blue-500 hover:text-white dark:text-white dark:hover:bg-gray-700 {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-blue-500 hover:text-white' }}">

                                                    @isset($link['icon'])
                                                        <span class="inline-flex w-6 h-6 justify-center items-center mr-2">
                                                            <i class="{{ $link['icon'] }} text-gray-500 group-hover:text-white"></i>
                                                        </span>
                                                    @endisset

                                                    <span>
                                                        {{ $link['name'] }}
                                                    </span>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            @else
                                <a href="{{ $link['route'] ?? '#' }}"
                                    class="flex items-center p-2 group text-gray-900 rounded-lg dark:text-white hover:bg-blue-500 hover:text-white {{ $link['active'] ? 'bg-gray-100' : 'hover:bg-blue-500 hover:text-white' }}">

                                    <span class="inline-flex w-6 h-6 justify-center items-center">
                                        <i class="{{ $link['icon'] }} text-gray-500 group-hover:text-white"></i>
                                    </span>

                                    <span class="ml-3">
                                        {{ $link['name'] }}
                                    </span>
                                </a>
                            @endisset
                        @endisset
                    </li>
                @endcanany
            @endforeach

        </ul>
    </div>
</aside>
