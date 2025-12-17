<div x-data="{ open: false }" class="relative">
    <a href="#" @click.prevent="open = !open"
       class="text-blueGray-500 block py-1 px-3">
        <i class="fas fa-bell"></i>
    </a>

    <div x-show="open" @click.away="open = false"
         class="absolute z-50 mt-1 bg-white text-base float-left py-2 list-none text-left rounded shadow-lg min-w-48">
        <a href="#" class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
            Action
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
            Another action
        </a>
        <a href="#" class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
            Something else here
        </a>
        <div class="h-px my-2 bg-blueGray-100"></div>
        <a href="#" class="block px-4 py-2 text-sm text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
            Separated link
        </a>
    </div>
</div>
