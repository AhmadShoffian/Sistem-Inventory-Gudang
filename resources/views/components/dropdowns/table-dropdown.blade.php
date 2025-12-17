<div x-data="{ open: false }" class="relative">
  <a href="#" @click.prevent="open = !open"
     class="text-blueGray-500 py-1 px-3">
    <i class="fas fa-ellipsis-v"></i>
  </a>

  <div x-show="open" @click.away="open = false"
       class="absolute left-0 z-50 bg-white text-base float-left py-2 list-none text-left rounded shadow-lg min-w-48">
    <a href="#" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
      Action
    </a>
    <a href="#" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
      Another action
    </a>
    <a href="#" class="text-sm py-2 px-4 block text-blueGray-700 hover:bg-blueGray-100" @click.prevent>
      Something else here
    </a>
  </div>
</div>